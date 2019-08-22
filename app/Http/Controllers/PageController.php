<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use App\Services\SolutionsService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }
    
    /**
     * Show the platform page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function platform()
    {
        return view('pages.platform');
    }

    /**
     * Show the team page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function team()
    {
        $teamService = new TeamService();
        $team = $teamService->getAllActive();

        return view('pages.team', [
            'team' => $team,
        ]);
    }

    /**
     * Show the solution page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function solution()
    {
        $solutionsService = new SolutionsService();
        $solutions = $solutionsService->getByTypes();

        return view('pages.solution', [
            'solutions' => $solutions,
        ]);
    }
    
    /**
     * Show the training page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function training()
    {
        return view('pages.training');
    }

    /**
     * Show the ia Solution page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function iaSolution()
    {
        return view('pages.iaSolution');
    }

    /**
     * Show the contact page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('pages.contact');
    }
}
