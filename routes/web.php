<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth
Route::get('/login', 'Auth\LoginController@get_login')->name('login');
Route::post('/login', 'Auth\LoginController@post_login');


Route::group(['middleware'=> 'auth'], function(){
	Route::get('/', 'HomeController@index');

	Route::prefix('admin_console')->group(function () {
		//Menu
		Route::resource('/menu', 'MenuController');	    
	});


	//Logout User
	Route::get('/logout', 'Auth\LoginController@logout');
});