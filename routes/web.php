<?php

//Auth
Route::get('/login', 'Auth\LoginController@get_login')->name('login');
Route::post('/login', 'Auth\LoginController@post_login');


Route::group(['middleware'=> 'auth'], function(){
	Route::get('/', 'HomeController@index');

	Route::group(['prefix' => 'admin-console'], function(){
		//Menu
		Route::resource('/menu', 'MenuController');
		Route::get('/menu/menu_status_update/{menu}/{status}', 'MenuController@menu_status_update');

		//Role
		Route::resource('/role', 'RoleController');
		Route::get('/role/{role}/config', 'RoleController@role_config');
		Route::post('/role/{role}/update_role_menu', 'RoleController@update_role_menu');
		Route::post('/role/{role}/update_role_permission', 'RoleController@update_role_permission');

		//Role
		Route::resource('/permission', 'PermissionController');

		// User
		Route::resource('/user','UserController');
	});

	//Logout User
	Route::get('/logout', 'Auth\LoginController@logout');

	Route::get('/session', function(){
		dd(Request::session());
	});
});