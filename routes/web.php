<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Users
Route::resource('admin/users', 'ScaffoldInterface\UserController');
Route::post('admin/users/store/','ScaffoldInterface\UserController@store');
Route::post('admin/users/update/','ScaffoldInterface\UserController@update');
Route::get('admin/users/edit/{id}','ScaffoldInterface\UserController@edit');
Route::get('admin/users/delete/{id}','ScaffoldInterface\UserController@destroy');

//item Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('item','\App\Http\Controllers\ItemController');
  Route::post('item/{id}/update','\App\Http\Controllers\ItemController@update');
  Route::get('item/{id}/delete','\App\Http\Controllers\ItemController@destroy');
  Route::get('item/{id}/deleteMsg','\App\Http\Controllers\ItemController@DeleteMsg');
});
