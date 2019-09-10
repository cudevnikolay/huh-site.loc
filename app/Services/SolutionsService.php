<?php

namespace App\Services;

use App\Models\Solution\Solution;
use App\Helpers\{
    ImageHelper, ImageSizeHelper
};
use App\Models\Solution\Translation;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Filesystem\Filesystem;

class SolutionsService
{
    /**
     * Get all Solutions
     *
     * @return Solution
     */
    public function getAll()
    {
        return Solution::all();
    }
    
    /**
     * Get all active Solutions
     *
     * @return Solution
     */
    public function getAllActive()
    {
        return Solution::enabled()->get();
    }
    
    /**
     * Get all active Solutions
     *
     * @param $count
     *
     * @return Solution
     */
    public function getActiveByLimit($count)
    {
        return Solution::enabled()->limit($count)->get();
    }
    
    /**
     * Get by all fields
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id):Solution
    {
        return Solution::findOrFail($id);
    }
    
    /**
     * The method prepares the array. Array to show in DataTTables.
     * Return an array. Array keys are keys for DataTables
     *
     * @param $limit
     * @param $start
     * @param $order
     * @param $dir
     * @param $search
     * @param $draw
     * @return array
     */
    public function getDataTableData($limit, $start, $order, $dir, $search, $draw):array
    {
        $columns = [
            0 => 'id',
            1 => 'enabled',
            2 => 'image',
            3 => 'title',
            4 => 'text',
            5 => 'type',
        ];
        
        $data = [];
        
        # Total number of records in the array
        $totalFiltered = $totalData = Solution::count();

        $limit = $limit == -1 ? $totalData : $limit;
        
        $order = $columns[$order];
        
        # Get all the entries
        if(empty($search))
        {
            $solutions = Solution::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        } else {
            $solutions =  Solution::where('title', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        
            $totalFiltered = Solution::where('title', 'LIKE', "%{$search}%")
                ->count();
        }
    
        $solutionTypes = $this->getSolutionTypes();
        foreach ($solutions as $key => $item)
        {
            $nestedData['index']   =  $key + 1;
            $nestedData['title']   =  $item->title;
            $nestedData['text']    =  $item->text ?? '';
            $nestedData['id']      =  $item->id;
            $nestedData['image']   =  ImageHelper::getUrl($item->image, 'solution');
            $nestedData['edit']    =  route('solutions.edit', ['id' => $item->id]);
            $nestedData['delete']  =  route('solutions.delete', ['id' => $item->id]);
            $nestedData['enabled'] =  $item->enabled;
            $nestedData['type']    =  $item->type;
            $nestedData['typeName']    =  $solutionTypes[$item->type];
            
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
    public function switchStatus(int $id):Solution
    {
        $solution = Solution::findOrFail($id);
        $solution->enabled = !$solution['enabled'];
    
        $solution->save();
        
        return $solution;
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
            $solution = Solution::createSolution($data);
            
            # These methods must be performed
            # in the order in which they are written
            $solution ->save();
            
            $this->createName($solution, $data);
            
            $this->resizeImage($image, $solution->image);

            if (!empty($data['translation'])) {
                foreach ($data['translation'] as $locale => $localData) {
                    Translation::updateOrCreate([
                        'locale' => $locale,
                        'solution_id' => $solution->id,
                    ], [
                        'title' => $localData['title'],
                        'text' => $localData['text']
                    ]);
                }
            }

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
        //try {
            DB::beginTransaction();
    
            $solution = $this->getById($data['id']);
            
            $oldName = $solution->image;
            $solution->editSolution($data);
            
            if ($data['image'] !== null) {
                
                # These methods must be performed
                # in the order in which they are written
                
                # first - create a new name and save all data
                $this->createName($solution, $data);
                
                # second
                $this->resizeImage($image, $solution->image);
            }
            
            # If the user does not change the picture
            # when loading - i save the name of the
            # picture as it was before
            if ($data['image'] == null) {
                $solution->image = $oldName;
                $solution->save();
            }

            if (!empty($data['translation'])) {
                foreach ($data['translation'] as $locale => $localData) {
                    Translation::updateOrCreate([
                        'locale' => $locale,
                        'solution_id' => $solution->id,
                    ], [
                        'title' => $localData['title'],
                        'text' => $localData['text']
                    ]);
                }
            }

            DB::commit();
            
            return true;
            
        /*} catch(\Exception $e) {
            
            DB::rollback();
            
            return false;
        }*/
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
        $solution = $this->getById($id);
        
        if ($solution->image) {
            ImageHelper::deleteLocalImage(config('filepath.image.solution') . DIRECTORY_SEPARATOR . $solution->image);
        }
    
        $solution->delete();
    }

    /**
     * @param Solution $solution
     * @param array $data
     * @return bool
     *
     * Create new name for picture and save new name
     */
    public function createName(Solution $solution, array $data)
    {
        # Receiving a file type
        $type = pathinfo($data['image'], PATHINFO_EXTENSION);
        
        # Record a new name
        $solution->image = $solution->id . '.' . $type;
        
        # Save a new name
        $solution ->save();
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
        $iconPath = config('filepath.image.solution') . DIRECTORY_SEPARATOR . $imageName;
        $path = public_path($iconPath);
        
        $file = new Filesystem();
        # path for checking the existence of a directory
        $pathDir = public_path() . config('filepath.image.solution');
        
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
            if (!ImageSizeHelper::compareSize($image, 350, 425)) {
                $resize = [350, 425];
            }
            ImageHelper::createImage($image, $iconPath, $resize);
            
            return true;
        } catch(\Exception $e) {
            return 'Error while saving: ' . $e->getMessage();
        }
    }
    
    /**
     * Get solution's types

     * @return array
     */
    public function getSolutionTypes()
    {
        return array_map(function($item) {
            return Ucfirst(str_replace('_', ' ', $item));
        }, Solution::getTypesById());
    }

    /**
     * Get solutions by types
     *
     * @return array
     */
    public function getByTypes()
    {
        return [
            'global' => Solution::byType(Solution::TYPE_GLOBAL)->enabled()->get(),
            'industries' => Solution::byType(Solution::TYPE_INDUSTRIES)->enabled()->get(),
            'languages' => Solution::byType(Solution::TYPE_LANGUAGES)->enabled()->get(),
        ];
    }
}