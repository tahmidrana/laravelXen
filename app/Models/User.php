<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function getFullName()
    {
    	return $this->first_name.' '.$this->last_name;
    }
}
