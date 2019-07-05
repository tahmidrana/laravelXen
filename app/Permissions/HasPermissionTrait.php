<?php
namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionTrait {

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'role_user');
	}

	public function hasRole(... $roles)
	{
		foreach ($roles as $role) {
			if($this->roles->contains('slug', $role)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function hasPermissionTo($permission)
	{
		return $this->hasPermissionThroughRole($permission);
	}

	public function hasPermissionThroughRole($permission)
	{
		$permission = Permission::where('slug', $permission);
		if($permission->count() > 0) {
			$permission = $permission->first();
			foreach($permission->roles as $role) {
				if($this->roles->contains($role)) {
					return TRUE;
				}
			}
			return FALSE;	
		}
		return FALSE;		
	}

}