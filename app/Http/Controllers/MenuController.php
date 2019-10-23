<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function __construct() 
    {
        $this->middleware('is_superuser');
    }

    public function index()
    {
        $menu_list = DB::table('menus AS a')
                        ->select('a.*', 'b.title as parent_menu_title')
                        ->leftJoin('menus AS b', 'a.parent_menu', '=', 'b.id')                        
                        ->orderBy('id', 'desc')
                        ->get();
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
            return redirect()->back()->with('success', 'Menu Saved Successfully');
        } else {
            return redirect()->back()->with('error', 'Menu Save Failed');
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
            Helpers::addToLog('update_menu',json_encode(array('id'=>$menu->getAttribute('id'))));
            return redirect()->back()->with('success', 'Menu Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Menu Updated Failed');
        }
    }

    public function destroy(Menu $menu)
    {
        if($menu->delete()) {
            return redirect('/menu')->with('success', 'Menu Deleted Successfully');
        } else {
            return redirect("/menu")->with('error', 'Menu Delete Failed');
        }
    }

    public function menu_status_update(Menu $menu, $status)
    {
        $menu->is_active = $status;
        if($menu->save()) {
            return redirect()->back()->with('success', 'Menu Status Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Menu Status Updated Failed');
        }
    }
}
