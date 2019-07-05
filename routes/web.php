<?php

//Auth
Route::get('/login', 'Auth\LoginController@get_login')->name('login');
Route::post('/login', 'Auth\LoginController@post_login');


Route::group(['middleware'=> 'auth'], function(){
	Route::get('/', 'HomeController@index');

	Route::prefix('admin_console')->group(function () {
		//Menu
		Route::resource('/menu', 'MenuController');

		//Role
		Route::resource('/role', 'RoleController');	

		//Role
		Route::resource('/permission', 'PermissionController');	    
	});


	//Logout User
	Route::get('/logout', 'Auth\LoginController@logout');
});