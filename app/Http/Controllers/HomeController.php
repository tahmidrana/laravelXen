<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function __construct()
    {
        View::share('main_menu', 'home');
    }

    public function index()
    {
        return view('home.index');
    }


}
