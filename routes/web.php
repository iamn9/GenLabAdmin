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

//cart Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('cart','\App\Http\Controllers\CartController');
  Route::post('cart/{id}/update','\App\Http\Controllers\CartController@update');
  Route::get('cart/{id}/delete','\App\Http\Controllers\CartController@destroy');
  Route::get('cart/{id}/deleteMsg','\App\Http\Controllers\CartController@DeleteMsg');
  Route::get('cart/add/{id}','\App\Http\Controllers\CartController@addItem');
});

//cart_item Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('cart_item','\App\Http\Controllers\Cart_itemController');
  Route::post('cart_item/{id}/update','\App\Http\Controllers\Cart_itemController@update');
  Route::get('cart_item/{id}/delete','\App\Http\Controllers\Cart_itemController@destroy');
  Route::get('cart_item/{id}/deleteMsg','\App\Http\Controllers\Cart_itemController@DeleteMsg');
});
