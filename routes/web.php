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
	//Dashbord route
	Route::get('/dashboard','AdminController@dashboard')->name('dashboard');
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
	//Customize Route
	Route::get('category/{category}/remove','CategoryController@remove')->name('category.remove');
	Route::get('category/trash','CategoryController@trash')->name('category.trash');
	Route::get('category/recover/{id}','CategoryController@recoverCat')->name('category.recover');
	Route::view('product/extras','backend_pages.extras.extraoption')->name('product.extras');
	//Resource Route
	Route::resource('product','ProductController');
	Route::resource('category','CategoryController');
	

});
