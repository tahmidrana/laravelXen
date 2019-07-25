<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permissions\HasPermissionTrait;
use App\Models\Role;

class User extends Authenticatable
{
	use Notifiable, HasPermissionTrait, HasApiTokens;
	
	protected $fillable = [
        'first_name', 'last_name', 'email', 'userid', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullName()
    {
    	return $this->first_name.' '.$this->last_name;
    }

    public function is_superuser()
    {
    	return $this->is_superuser ? TRUE : FALSE;
    }

    public function findForPassport($username)
    {
        return $this->where('userid', $username)->first();
    }
}
