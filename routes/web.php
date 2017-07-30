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

Route::get('/about', function () {
    return view('about');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Users
Route::get('users/unactivated','\App\Http\Controllers\UserController@showUnactivated');
Route::get('users/admins','\App\Http\Controllers\UserController@showAdmins');
Route::get('users/regular','\App\Http\Controllers\UserController@showUsers');
Route::resource('users', '\App\Http\Controllers\UserController');
Route::post('users/store/','\App\Http\Controllers\UserController@store');
Route::post('users/update/','\App\Http\Controllers\UserController@update');
Route::get('users/edit/{id}','\App\Http\Controllers\UserController@edit');
Route::get('users/delete/{id}','\App\Http\Controllers\UserController@destroy');

Route::get('transaction/pending','\App\Http\Controllers\TransactionController@index_pending');
Route::get('transaction/prepared','\App\Http\Controllers\TransactionController@index_prepared');
Route::get('transaction/released','\App\Http\Controllers\TransactionController@index_released');
Route::get('transaction/completed','\App\Http\Controllers\TransactionController@index_completed');
Route::get('transaction/rejected','\App\Http\Controllers\TransactionController@index_rejected');
Route::get('transaction/{id}/release','\App\Http\Controllers\TransactionController@release');
Route::post('transaction/{id}/prepare','\App\Http\Controllers\TransactionController@prepare');
Route::get('transaction/{id}/complete','\App\Http\Controllers\TransactionController@complete');
Route::get('transaction/{id}/undo_submission','\App\Http\Controllers\TransactionController@undo_submission');
Route::get('transaction/{id}/undo_release','\App\Http\Controllers\TransactionController@undo_release');
Route::get('transaction/{id}/undo_prepare','\App\Http\Controllers\TransactionController@undo_prepare');
Route::get('transaction/{id}/undo_complete','\App\Http\Controllers\TransactionController@undo_complete');
Route::get('transaction/user/active','\App\Http\Controllers\TransactionController@user_active');
//Route::get('transaction/user/history','\App\Http\Controllers\TransactionController@user_history');

//item Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('item','\App\Http\Controllers\ItemController');
  Route::post('item/{id}/update','\App\Http\Controllers\ItemController@update');
  Route::get('item/{id}/delete','\App\Http\Controllers\ItemController@destroy');
  Route::get('item/{id}/deleteMsg','\App\Http\Controllers\ItemController@DeleteMsg');
  Route::get('item/{id}/showModal','\App\Http\Controllers\ItemController@showModal');
});

//cart Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('cart','\App\Http\Controllers\CartController');
  Route::post('cart/{id}/update','\App\Http\Controllers\CartController@update');
  Route::get('cart/{id}/delete','\App\Http\Controllers\CartController@destroy');
  Route::get('cart/{id}/deleteMsg','\App\Http\Controllers\CartController@DeleteMsg');
  Route::get('cart/add/{id}','\App\Http\Controllers\CartController@addItem');
  Route::get('cart/add/{id}/addItemMsg','\App\Http\Controllers\CartController@addItemMsg');
  Route::get('cart/{id}/checkout','\App\Http\Controllers\CartController@checkout');
  Route::get('cart/{id}/reject', '\App\Http\Controllers\CartController@reject');
});

//cart_item Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('cart_item','\App\Http\Controllers\Cart_itemController');
  Route::post('cart_item/{id}/update','\App\Http\Controllers\Cart_itemController@update');
  Route::get('cart_item/{id}/delete','\App\Http\Controllers\Cart_itemController@destroy');
  Route::get('cart_item/{id}/deleteMsg','\App\Http\Controllers\Cart_itemController@DeleteMsg');
  Route::get('cart_item/{id}/edit','\App\Http\Controllers\Cart_itemController@edit');
});

//transaction Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('transaction','\App\Http\Controllers\TransactionController');
  Route::get('transaction/{id}/show', '\App\Http\Controllers\TransactionController@user_history_info');
  Route::post('transaction/{id}/update','\App\Http\Controllers\TransactionController@update');
  Route::get('transaction/{id}/delete','\App\Http\Controllers\TransactionController@destroy');
  Route::get('transaction/{id}/deleteMsg','\App\Http\Controllers\TransactionController@DeleteMsg');
  Route::get('transaction/user/history','\App\Http\Controllers\TransactionController@user_history');
});
