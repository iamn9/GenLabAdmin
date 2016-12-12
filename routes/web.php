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
Route::resource('users', 'ScaffoldInterface\UserController');
Route::post('users/store/','ScaffoldInterface\UserController@store');
Route::post('users/update/','ScaffoldInterface\UserController@update');
Route::get('users/edit/{id}','ScaffoldInterface\UserController@edit');
Route::get('users/delete/{id}','ScaffoldInterface\UserController@destroy');

//item Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('item','\App\Http\Controllers\ItemController');
  Route::post('item/{id}/update','\App\Http\Controllers\ItemController@update');
  Route::get('item/{id}/delete','\App\Http\Controllers\ItemController@destroy');
  Route::get('item/{id}/deleteMsg','\App\Http\Controllers\ItemController@DeleteMsg');
});
