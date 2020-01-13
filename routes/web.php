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

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/',function(){
	return view('front_pages.login');
});*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.','middleware'=>['auth','is_admin'],'prefix' => 'admin'],function(){
	Route::get('/dashboard','AdminController@dashboard')->name('dashboard');
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
	Route::resource('product','ProductController');
	Route::resource('category','CategoryController');
	

});
