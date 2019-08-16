<?php

namespace App\Http\Controllers;

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
     */
    public function platform()
    {
        return view('pages.platform');
    }

    /**
     * Show the team page
     *
     */
    public function team()
    {
        return view('pages.team');
    }

    /**
     * Show the solution page
     *
     */
    public function solution()
    {
        return view('pages.solution');
    }
    
    /**
     * Show the training page
     *
     */
    public function training()
    {
        return view('pages.training');
    }

    /**
     * Show the ia Solution page
     *
     */
    public function iaSolution()
    {
        return view('pages.iaSolution');
    }

    /**
     * Show the contact page
     *
     */
    public function contact()
    {
        return view('pages.contact');
    }
}
