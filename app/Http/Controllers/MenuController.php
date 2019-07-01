<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Exception;

class MenuController extends Controller
{
    public function __construct() 
    {
        //
    }

    public function index()
    {
        //session(['main_menu' => 'admin console', 'sub_menu' => 'menu']);
        //$menu_list = Menu::with('main_menu')->orderBy('id', 'desc')->get();
        $menu_list = Menu::all();
        return view('admin_console.menu.menu', ['menu_list'=> $menu_list]);
    }

    public function store(Request $request)
    {
    	$dataValidate = $request->validate([
            'title' => 'required|max:60',
            'menu_order'=> 'numeric',
            'description'=> 'max:150'
        ]);

        $menu = new Menu;
        $menu->title = $request->title;
        $menu->menu_url = $request->menu_url;
        $menu->parent_menu = $request->parent_menu;
        $menu->menu_order = $request->menu_order;
        $menu->menu_icon = $request->menu_icon;
        $menu->description = $request->description;

        if($menu->save()) {
            return redirect('/admin_console/menu')->with('success', 'Menu Saved Successfully');
        } else {
            return redirect('/admin_console/menu')->with('error', 'Menu Save Failed');
        }
    }

    public function update(Request $request, Menu $menu)
    {
    	$dataValidate = $request->validate([
            'title' => 'required|max:60',
            'menu_order'=> 'numeric',
            'description'=> 'max:150'
        ]);

        //$menu = Menu::find();
        $menu->title = $request->title;
        $menu->menu_url = $request->menu_url;
        $menu->parent_menu = $request->parent_menu;
        $menu->menu_order = $request->menu_order;
        $menu->menu_icon = $request->menu_icon;
        $menu->description = $request->description;

        if($menu->save()) {
            return redirect('/admin_console/menu')->with('success', 'Menu Updated Successfully');
        } else {
            return redirect('/admin_console/menu')->with('error', 'Menu Updated Failed');
        }
    }

    public function destroy(Menu $menu)
    {
        if($menu->delete()) {
            return redirect('admin_console/menu')->with('success', 'Menu Deleted Successfully');
        } else {
            return redirect("admin_console/menu")->with('error', 'Menu Delete Failed');
        }
    }
}
