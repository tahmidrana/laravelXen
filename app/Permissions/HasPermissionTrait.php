<?php
/* For one user can have just one role */
namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionTrait {

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id');
	}

	public function is_admin()
	{
		return $this->role->slug === 'admin';
	}

	/*
	** Role Permission Check
	*/ 
	public function hasPermissionToNormal($permission)
	{
		$user_permissions = $this->role->permissions;
		if($user_permissions->count()) {
			foreach($user_permissions as $perm) {
				if(strtolower($perm->slug) === strtolower($permission) || strtolower($perm->name) === strtolower($permission)) {
					return TRUE;
				}
			}
			return FALSE;			
		}
		return FALSE;
	}

	/*
	** Role Permission Check (Session based)
	*/ 
	public function hasPermissionTo($permission)
	{
		$user_permissions = session('user_data')['user_perms'];
		foreach($user_permissions as $row) {
			if(strtolower($row->name) == strtolower($permission) || strtolower($row->slug) == strtolower($permission)) {
				return TRUE;
			}
		}
		return FALSE;		
	}
}