<?php

namespace App\Http\Controllers;

use App\Services\{SolutionsService, QuotesService};

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
        $solutionsService = new SolutionsService();
        $solutions = $solutionsService->getActiveByLimit(4);
    
        $quotesService = new QuotesService();
        $quotes = $quotesService->getAllActiveByLocale(config('app.locale'));

        return view('pages.home', [
            'solutions' => $solutions,
            'quotes' => $quotes,
        ]);
    }
}
