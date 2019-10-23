<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function __construct() 
    {
        $this->middleware('is_superuser');
    }

    public function index()
    {
        $permission_list = Permission::all();
        return view('admin_console.permission.permission', ['permissions'=> $permission_list]);
    }

    public function store(Request $request)
    {
    	$dataValidate = $request->validate([
            'name' => 'required|max:30',
            'description'=> 'max:150'
        ]);

        $permission = new Permission;
        $permission->name = $request->name;
        $permission->slug = Str::slug($request->name);        
        $permission->description = $request->description;

        if($permission->save()) {
            return redirect()->back()->with('success', 'Permission Saved Successfully');
        } else {
            return redirect()->back()->with('error', 'Permission Save Failed');
        }
    }

    public function update(Request $request, Permission $permission)
    {
    	$dataValidate = $request->validate([
            'name' => 'required|max:30',
            'description'=> 'max:150'
        ]);

        $permission->name = $request->name;
        $permission->slug = Str::slug($request->name);        
        $permission->description = $request->description;

        if($permission->save()) {
            return redirect()->back()->with('success', 'Permission Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Permission Update Failed');
        }
    }

    public function destroy(Permission $permission)
    {
        if($permission->delete()) {
            return redirect()->back()->with('success', 'Permission Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Permission Delete Failed');
        }
    }
}
