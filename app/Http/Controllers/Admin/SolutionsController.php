<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SolutionRequest;
use App\Services\SolutionsService;

class SolutionsController extends Controller
{
    private $solutionService;

    protected const DS = DIRECTORY_SEPARATOR;
    
    /**
     * SolutionsController constructor.
     *
     * @param SolutionsService $solutionService
     */
    public function __construct(SolutionsService $solutionService)
    {
        $this->solutionService = $solutionService;
    }
    
    /**
     * Show all Solutions
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.solutions.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solutionTypes = $this->solutionService->getSolutionTypes();
        return view('admin.solutions.create', compact('solutionTypes'));
    }
    
    /**
     * @param SolutionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SolutionRequest $request)
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
        if (!$this->solutionService->store($dataAll, $img)) {
            return redirect()->route('solutions.create')
                ->withInput()
                ->with('notifications', ['type' => 'error', 'message' => 'Solution save error']);
        } else {
            return redirect()->route('solutions.index')
                ->with('notifications', ['type' => 'success', 'message' => 'Solution has been saved']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        # get object
        $solution = $this->solutionService->getById($id);
        $solutionTypes = $this->solutionService->getSolutionTypes();

        return view('admin.solutions.edit', compact('solution', 'solutionTypes'));
    }
    
    /**
     * Update info and save
     *
     * @param int $id
     * @param SolutionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, SolutionRequest $request)
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
        if (!$this->solutionService->edit($dataAll, $img)) {
            return redirect()->route('solutions.edit', ['id' => $id])
                ->withInput()
                ->with('notifications', ['type' => 'error', 'message' => 'Solution save error']);
        } else {
            return redirect()->route('solutions.index')
                ->with('notifications', ['type' => 'success', 'message' => 'Solution has been saved']);
        }
    }
    
    /**
     * @param $id
     *
     * Delete this field
     */
    public function destroy($id)
    {
        $this->solutionService->delete($id);
    }
}