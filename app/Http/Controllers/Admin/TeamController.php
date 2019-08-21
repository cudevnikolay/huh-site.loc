<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamFormCreateGeneral;
use App\Services\TeamService;

class TeamController extends Controller
{
    private $teamService;

    protected const DS = DIRECTORY_SEPARATOR;
    
    /**
     * TeamController constructor.
     *
     * @param TeamService $teamService
     */
    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }
    
    /**
     * Show all team members
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.team.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
    }
    
    /**
     * @param TeamFormCreateGeneral $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamFormCreateGeneral $request)
    {
        #Preparation of all data
        $dataAll = $request->all();
        
        # Object the image downloading picture
        $img = $request->file('image');

        # This is a object. Object is not needed
        unset($dataAll['image']);
        
        # get correct file name
        $dataAll['image'] = $img ? $img->getClientOriginalName() : '';
        
        # save and redirect
        if (!$this->teamService->store($dataAll, $img)) {
            return redirect()->route('team.create')
                ->withInput()
                ->with('notifications', ['type' => 'error', 'message' => 'Team save error']);
        } else {
            return redirect()->route('team.index')
                ->with('notifications', ['type' => 'success', 'message' => 'Team has been saved']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        # get object
        $team = $this->teamService->getById($id);
        
        return view('admin.team.edit', compact('team'));
    }
    
    /**
     * Update info and save
     *
     * @param int $id
     * @param TeamFormCreateGeneral $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, TeamFormCreateGeneral $request)
    {
        # Object the image downloading picture
        $img = $request->file('image');
        
        # Preparation of all data
        $dataAll = $request->all();
        
        # Get correct filename pr return null
        $dataAll['image'] = isset($dataAll['image']) ? $img->getClientOriginalName() : null;
        
        # Check enabled/not enabled
        $dataAll['enabled'] = isset($dataAll['enabled']) ? 1 : 0;

        # Save and redirect
        if (!$this->teamService->edit($dataAll, $img)) {
            return redirect()->route('team.edit', ['id' => $id])
                ->withInput()
                ->with('notifications', ['type' => 'error', 'message' => 'Team save error']);
        } else {
            return redirect()->route('team.index')
                ->with('notifications', ['type' => 'success', 'message' => 'Team has been saved']);
        }
    }
    
    /**
     * @param $id
     *
     * Delete this field
     */
    public function destroy($id)
    {
        $this->teamService->delete($id);
    }
}