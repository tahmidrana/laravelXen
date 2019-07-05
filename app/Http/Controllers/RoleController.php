<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;

class RoleController extends Controller
{
    public function __construct() 
    {
        //
    }

    public function index()
    {
        //session(['main_menu' => 'admin console', 'sub_menu' => 'menu']);
        //$menu_list = Menu::with('main_menu')->orderBy('id', 'desc')->get();
        $role_list = Role::all();
        return view('admin_console.role.role', ['roles'=> $role_list]);
    }

    public function store(Request $request)
    {
    	$dataValidate = $request->validate([
            'name' => 'required|max:30',
            'description'=> 'max:150'
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->slug = Str::slug($request->name);        
        $role->description = $request->description;

        if($role->save()) {
            return redirect('/admin_console/role')->with('success', 'Role Saved Successfully');
        } else {
            return redirect('/admin_console/role')->with('error', 'Role Save Failed');
        }
    }

    public function update(Request $request, Role $role)
    {
    	$dataValidate = $request->validate([
            'name' => 'required|max:30',
            'description'=> 'max:150'
        ]);

        $role->name = $request->name;
        $role->slug = Str::slug($request->name);        
        $role->description = $request->description;

        if($role->save()) {
            return redirect('/admin_console/role')->with('success', 'Role Updated Successfully');
        } else {
            return redirect('/admin_console/role')->with('error', 'Role Update Failed');
        }
    }

    public function destroy(Role $role)
    {
        if($role->delete()) {
            return redirect('admin_console/role')->with('success', 'Role Deleted Successfully');
        } else {
            return redirect("admin_console/role")->with('error', 'Role Delete Failed');
        }
    }
}
