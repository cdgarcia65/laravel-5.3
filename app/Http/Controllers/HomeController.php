<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
// use Illuminate\View\Factory;
// use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Factory $view)
    {
        // return view('home');
        // return \View::make('home');
        // return $view->make('home');
        // return app('view')->make('home');
        return view()->make('home');
    }
}
