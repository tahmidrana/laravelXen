<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() 
    {
        //session(['main_menu' => 'home']);
    }

    public function index()
    {
        return view('home.index');
    }
}
