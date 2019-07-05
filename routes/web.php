<?php

//Auth
Route::get('/login', 'Auth\LoginController@get_login')->name('login');
Route::post('/login', 'Auth\LoginController@post_login');


Route::group(['middleware'=> 'auth'], function(){
	Route::get('/', 'HomeController@index');

	//Menu
	Route::resource('/menu', 'MenuController');

	//Role
	Route::resource('/role', 'RoleController');
	Route::get('/role/{role}/config', 'RoleController@role_config');
	Route::post('/role/{role}/update_role_menu', 'RoleController@update_role_menu');
	Route::post('/role/{role}/update_role_permission', 'RoleController@update_role_permission');

	//Role
	Route::resource('/permission', 'PermissionController');	    


	//Logout User
	Route::get('/logout', 'Auth\LoginController@logout');
});