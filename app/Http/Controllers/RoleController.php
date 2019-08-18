<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Menu;

class RoleController extends Controller
{
    public function __construct() 
    {
        $this->middleware('is_superuser');
        View::share('main_menu', 'admin console');
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
            return redirect('role')->with('success', 'Role Saved Successfully');
        } else {
            return redirect('role')->with('error', 'Role Save Failed');
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
            return redirect('role')->with('success', 'Role Updated Successfully');
        } else {
            return redirect('role')->with('error', 'Role Update Failed');
        }
    }

    public function destroy(Role $role)
    {
        if($role->delete()) {
            return redirect('role')->with('success', 'Role Deleted Successfully');
        } else {
            return redirect("role")->with('error', 'Role Delete Failed');
        }
    }

    public function role_config(Role $role)
    {
    	//$menu_list = DB::select("SELECT a.*, b.role_id FROM menus a LEFT JOIN menu_role b ON a.id=b.menu_id AND b.role_id=?", [$role->id]);
    	$menu_list = DB::select("SELECT a.id, a.title, a.menu_url, a.menu_icon, a.description, a.menu_order, a.parent_menu, b.role_id, c.title as parent_menu_title FROM menus a LEFT JOIN menu_role b ON a.id=b.menu_id AND b.role_id=? LEFT JOIN menus c ON a.parent_menu=c.id", [$role->id]);
        $perm_list = DB::select("SELECT a.*, b.role_id FROM permissions a LEFT JOIN permission_role b ON a.id=b.permission_id AND b.role_id=?", [$role->id]);
        $data = [
            'role_data' => $role,
            'menu_list' => $menu_list,
            'perm_list' => $perm_list
        ];
        return view('admin_console.role.role_config', $data);
    }

    public function update_role_menu(Request $request, Role $role)
    {
        DB::transaction(function () use ($request, $role) {
            $del = DB::table('menu_role')->where('role_id', $role->id)->delete();

            $menus = $request->group_menu_list;

            if($menus) {
                foreach ($menus as $menu) {
                    $menu_val = Menu::find($menu);
                    if(!$menu_val->parent_menu || in_array($menu_val->parent_menu, $menus)) {
                        $ins = DB::table('menu_role')->insert([
                            'menu_id' => $menu,
                            'role_id' => $role->id
                        ]);
                    }                    
                }
            }
        });
        return redirect("/role/{$role->id}/config")->with('success', 'Saved Successfully');
    }

    public function update_role_permission(Request $request, Role $role)
    {
        DB::transaction(function () use ($request, $role) {
            $del = DB::table('permission_role')->where('role_id', $role->id)->delete();

            $perms = $request->group_permission_list;

            if($perms) {
                foreach ($perms as $perm) {
                    $ins = DB::table('permission_role')->insert([
                        'permission_id' => $perm,
                        'role_id' => $role->id
                    ]);
                }
            }
        });
        return redirect("/role/{$role->id}/config")->with('success', 'Saved Successfully');
    }
}
