<?php

namespace App\Services;

use App\Models\Team;
use App\Helpers\{
    ImageHelper, ImageSizeHelper
};
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Filesystem\Filesystem;

class TeamService
{
    /**
     * Get all team members
     *
     * @return Team
     */
    public function getAll()
    {
        return Team::all();
    }
    
    /**
     * Get all active team members
     *
     * @return Team
     */
    public function getAllActive()
    {
        return Team::enabled()->get();
    }
    
    /**
     * Get all active team members
     *
     * @param $count
     *
     * @return Team
     */
    public function getActiveByLimit($count)
    {
        return Team::enabled()->limit($count)->get();
    }
    
    /**
     * Get by all fields
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id):Team
    {
        return Team::findOrFail($id);
    }
    
    /**
     * The method prepares the array. Array to show in DataTTables.
     * Return an array. Array keys are keys for DataTables
     *
     * @param $limit
     * @param $start
     * @param $order
     * @param $dir
     * @param $draw
     * @return array
     */
    public function getDataTableData($limit, $start, $order, $dir, $draw):array
    {
        $columns = [
            0 => 'id',
            1 => 'enabled',
            2 => 'image',
            3 => 'name',
            4 => 'position'
        ];
        
        $data = [];
        
        # Total number of records in the array
        $totalFiltered = $totalData = Team::count();
        
        $limit = $limit == -1 ? $totalData : $limit;
        
        $order = $columns[$order];
        
        # Get all the entries
        $team = Team::offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();
        
        foreach ($team as $key => $item)
        {
            $nestedData['index']   =  $key + 1;
            $nestedData['name']    =  $item->name;
            $nestedData['position']=  $item->position;
            $nestedData['id']      =  $item->id;
            $nestedData['image']   =  ImageHelper::getUrl($item->image, 'team');
            $nestedData['edit']    =  route('team.edit', ['id' => $item->id]);
            $nestedData['delete']  =  route('team.delete', ['id' => $item->id]);
            $nestedData['enabled']  =  $item->enabled;
            
            $data[] = $nestedData;
        }
        
        $result = [
            'draw'            => intval($draw),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            'data'            => $data
        ];
        return $result;
    }
    
    /**
     * Update and save value in a field "enabled"
     *
     * @param int $id
     * @return mixed
     */
    public function switchStatus(int $id):Team
    {
        $team = Team::findOrFail($id);
        $team->enabled = !$team['enabled'];
    
        $team->save();
        
        return $team;
    }
    
    /**
     * @param array $data
     * @param UploadedFile $image
     * @return bool
     *
     * The method saves the image, checks the size, moves it to the correct folder
     */
    public function store(array $data, UploadedFile $image):bool
    {
        DB::beginTransaction();
        
        try {
            $team = Team::createTeam($data);
            
            # These methods must be performed
            # in the order in which they are written
            $team ->save();
            
            $this->createName($team, $data);
            
            $this->resizeImage($image, $team->image);
            
            DB::commit();
            
            return true;
            
        } catch(\Exception $e) {
            
            DB::rollback();
            
            return false;
        }
    }
    
    /**
     * @param array $data
     * @param $image
     * @return bool
     *
     * The method updating the image, checks the size, moves it to the correct folder
     */
    public function edit(array $data, $image):bool
    {
        try {
            DB::beginTransaction();
            
            $team = $this->getById($data['id']);
            
            $oldName = $team->image;
            $team->editTeam($data);
            
            if ($data['image'] !== null) {
                
                # These methods must be performed
                # in the order in which they are written
                
                # first - create a new name and save all data
                $this->createName($team, $data);
                
                # second
                $this->resizeImage($image, $team->image);
            }
            
            # If the user does not change the picture
            # when loading - i save the name of the
            # picture as it was before
            if ($data['image'] == null) {
                $team->image = $oldName;
                $team->save();
            }
            
            DB::commit();
            
            return true;
            
        } catch(\Exception $e) {
            
            DB::rollback();
            
            return false;
        }
    }
    
    /**
     * Delete image in a tables and directory
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $team = $this->getById($id);
        
        if ($team->image) {
            ImageHelper::deleteLocalImage(config('filepath.image.team') . DIRECTORY_SEPARATOR . $team->image);
        }
        
        $team->delete();
    }

    /**
     * @param Team $team
     * @param array $data
     * @return bool
     *
     * Create new name for picture and save new name
     */
    public function createName(Team $team, array $data)
    {
        # Receiving a file type
        $type = pathinfo($data['image'], PATHINFO_EXTENSION);
        
        # Record a new name
        $team->image = $team->id . '.' . $type;
        
        # Save a new name
        $team ->save();
    }
    
    /**
     * @param UploadedFile $image
     * @param $imageName
     * @return bool|string
     *
     * he method checks the size of the loaded image and,
     * if necessary, resizes. The path is also created with
     * a new file name to save
     */
    public function resizeImage(UploadedFile $image, string $imageName)
    {
        # Create path for save
        $iconPath = config('filepath.image.team') . DIRECTORY_SEPARATOR . $imageName;
        $path = public_path($iconPath);
        
        $file = new Filesystem();
        # path for checking the existence of a directory
        $pathDir = public_path() . config('filepath.image.team');
        
        try {
            # If there is no directory, create a directory
            if (!file_exists($pathDir)) {
                mkdir($pathDir);
            }
            
            # If the directory can not be read - set access
            if (!$file->isWritable($pathDir)) {
                $file->chmod($pathDir, 0777);
            }
            
            # Checking size of the image and save it
            $resize = [];
            if (!ImageSizeHelper::compareSize($image)) {
                $resize = [263, 320];
            }
            ImageHelper::createImage($image, $iconPath, $resize);
            
            return true;
        } catch(\Exception $e) {
            return 'Error while saving: ' . $e->getMessage();
        }
    }
}