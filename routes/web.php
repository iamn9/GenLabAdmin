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
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () { 
  return view('about'); 
}); 

Route::get('users/all','\App\Http\Controllers\UserController@index');
Route::get('users/unactivated','\App\Http\Controllers\UserController@showUnactivated');
Route::get('users/admins','\App\Http\Controllers\UserController@showAdmins');
Route::get('users/regular','\App\Http\Controllers\UserController@showUsers');
Route::get('cart/all','\App\Http\Controllers\CartController@index');
Route::get('cart/draft','\App\Http\Controllers\CartController@index_draft');
Route::get('cart/pending','\App\Http\Controllers\CartController@index_pending');
Route::get('cart/prepared','\App\Http\Controllers\CartController@index_prepared');
Route::get('cart/released','\App\Http\Controllers\CartController@index_released');
Route::get('cart/completed','\App\Http\Controllers\CartController@index_completed');
Route::get('transaction/all','\App\Http\Controllers\TransactionController@index');
Route::get('transaction/pending','\App\Http\Controllers\TransactionController@index_pending');
Route::get('transaction/prepared','\App\Http\Controllers\TransactionController@index_prepared');
Route::get('transaction/released','\App\Http\Controllers\TransactionController@index_released');
Route::get('transaction/completed','\App\Http\Controllers\TransactionController@index_completed');
Route::get('transaction/{id}/release','\App\Http\Controllers\TransactionController@release');
Route::get('transaction/{id}/prepare','\App\Http\Controllers\TransactionController@prepare');
Route::get('transaction/{id}/complete','\App\Http\Controllers\TransactionController@complete');
Route::get('transaction/{id}/undo_submission','\App\Http\Controllers\TransactionController@undo_submission');
Route::get('transaction/{id}/undo_release','\App\Http\Controllers\TransactionController@undo_release');
Route::get('transaction/{id}/undo_prepare','\App\Http\Controllers\TransactionController@undo_prepare');
Route::get('transaction/{id}/undo_complete','\App\Http\Controllers\TransactionController@undo_complete');
Route::get('transaction/user/active','\App\Http\Controllers\TransactionController@user_active');
Route::get('accountability/user/accountabilities','\App\Http\Controllers\AccountabilityController@user_accountabilities');
Route::get('accountability/all','\App\Http\Controllers\AccountabilityController@index');
Route::get('accountability/pending','\App\Http\Controllers\AccountabilityController@index_pending');
Route::get('accountability/completed','\App\Http\Controllers\AccountabilityController@index_completed');
Route::get('accountability/{id}/show', '\App\Http\Controllers\AccountabilityController@accountability_info');
Route::get('accountability/{id}/user_show', '\App\Http\Controllers\AccountabilityController@user_accountability_info');

//user Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('users', '\App\Http\Controllers\UserController');
  Route::post('users/store/','\App\Http\Controllers\UserController@store');
  Route::post('users/update/','\App\Http\Controllers\UserController@update');
  Route::get('users/edit/{id}','\App\Http\Controllers\UserController@edit');
  Route::get('users/delete/{id}','\App\Http\Controllers\UserController@destroy');
  Route::get('users/{id}/deleteMsg','\App\Http\Controllers\UserController@DeleteMsg');
});

//item Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('item','\App\Http\Controllers\ItemController');
  Route::post('item/{id}/update','\App\Http\Controllers\ItemController@update');
  Route::get('item/{id}/delete','\App\Http\Controllers\ItemController@destroy');
  Route::get('item/{id}/deleteMsg','\App\Http\Controllers\ItemController@DeleteMsg');
  Route::get('item/{id}/uploadMsg','\App\Http\Controllers\ItemController@UploadMsg');
  Route::get('item/{id}/showModal','\App\Http\Controllers\ItemController@showModal');
});

//news Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('news','\App\Http\Controllers\NewsController');
  Route::post('news/{id}/update','\App\Http\Controllers\NewsController@update');
  Route::get('news/{id}/delete','\App\Http\Controllers\NewsController@destroy');
  Route::get('news/{id}/deleteMsg','\App\Http\Controllers\NewsController@DeleteMsg');
  Route::get('news/{id}/showModal','\App\Http\Controllers\NewsController@showModal');
});

//cart Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('cart','\App\Http\Controllers\CartController');
  Route::post('cart/{id}/update','\App\Http\Controllers\CartController@update');
  Route::get('cart/{id}/delete','\App\Http\Controllers\CartController@destroy');
  Route::get('cart/{id}/deleteMsg','\App\Http\Controllers\CartController@DeleteMsg');
  Route::get('cart/add/{id}','\App\Http\Controllers\CartController@addItem');
  Route::get('cart/add/{id}/addItemMsg','\App\Http\Controllers\CartController@addItemMsg');
  Route::post('cart/{id}/checkout','\App\Http\Controllers\CartController@checkout');
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
  Route::get('transaction/{id}/show', '\App\Http\Controllers\TransactionController@show');
  Route::post('transaction/{id}/update','\App\Http\Controllers\TransactionController@update');
  Route::get('transaction/{id}/delete','\App\Http\Controllers\TransactionController@destroy');
  Route::get('transaction/{id}/deleteMsg','\App\Http\Controllers\TransactionController@DeleteMsg');
  Route::get('transaction/user/history','\App\Http\Controllers\TransactionController@user_history');
});

