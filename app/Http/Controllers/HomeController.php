<?php

namespace App\Http\Controllers;

use App\Services\{
    TeamService, QuotesService
};

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $teamService = new TeamService();
        $team = $teamService->getActiveByLimit(4);
    
        $quotesService = new QuotesService();
        $quotes = $quotesService->getAllActive();

        return view('pages.home', [
            'team' => $team,
            'quotes' => $quotes,
        ]);
    }
}
