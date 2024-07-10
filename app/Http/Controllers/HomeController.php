<?php

namespace App\Http\Controllers;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use Illuminate\Http\Request;
use Artisan;
use Session;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Artisan::call('config:cache');
        // Artisan::call('cache:clear');
        // // Artisan::call('queue:work');
        // dd('Cache Clear'); 

        // $visitor = Tracker::pageViews(60 * 24 * 30);
        // dd( $visitor );
        return view('home');
    }
}
