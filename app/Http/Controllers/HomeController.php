<?php

namespace App\Http\Controllers;

use App\Internship;
use Carbon\Carbon;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $internships = Internship::where('end', '>=', Carbon::now())->orderBy('created_at', 'desc')->get();
        return view('home', compact('internships'));
    }
}
