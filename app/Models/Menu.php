<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	public function child_menus()
    {
    	return $this->hasMany(Menu::class, 'parent_menu', 'id');
    }

    public function main_menu()
    {
    	return $this->belongsTo(Menu::class, 'parent_menu', 'id');
    }
}
