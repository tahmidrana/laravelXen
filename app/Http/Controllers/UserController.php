<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;

class UserController extends Controller
{
    public function __construct()
    {
        View::share('main_menu', 'user');
    }

    public function index()
    {
        //session(['sub_menu' => 'Manage Users']);
        return view('users.users');
    }
    
}
