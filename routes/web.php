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
   if (Auth::user())
    return redirect('/home');
   else
    return view('welcome');
});
Route::get('/about', function () { 
  return view('about'); 
}); 

Route::get('users/all','\App\Http\Controllers\UserController@index');
Route::get('users/unactivated','\App\Http\Controllers\UserController@showUnactivated');
Route::get('users/admins','\App\Http\Controllers\UserController@showAdmins');
Route::get('users/regular','\App\Http\Controllers\UserController@showUsers');
Route::get('listing/all','\App\Http\Controllers\ListingController@index');
Route::get('listing/draft','\App\Http\Controllers\ListingController@index_draft');
Route::get('listing/pending','\App\Http\Controllers\ListingController@index_pending');
Route::get('listing/prepared','\App\Http\Controllers\ListingController@index_prepared');
Route::get('listing/released','\App\Http\Controllers\ListingController@index_released');
Route::get('listing/completed','\App\Http\Controllers\ListingController@index_completed');
Route::get('transaction/{id}/release','\App\Http\Controllers\TransactionController@release');
Route::get('transaction/{id}/prepare','\App\Http\Controllers\TransactionController@prepare');
Route::get('transaction/{id}/complete','\App\Http\Controllers\TransactionController@complete');
Route::get('transaction/{id}/confirm_complete','\App\Http\Controllers\TransactionController@confirm_complete');
Route::get('transaction/{id}/undo_submission','\App\Http\Controllers\TransactionController@undo_submission');
Route::get('transaction/{id}/undo_release','\App\Http\Controllers\TransactionController@undo_release');
Route::get('transaction/{id}/undo_prepare','\App\Http\Controllers\TransactionController@undo_prepare');
Route::get('transaction/{id}/undo_complete','\App\Http\Controllers\TransactionController@undo_complete');
Route::get('transaction/user/active','\App\Http\Controllers\TransactionController@user_active');
Route::get('accountability/user/accountabilities','\App\Http\Controllers\AccountabilityController@user_accountabilities');
Route::get('accountability/all','\App\Http\Controllers\AccountabilityController@index');
Route::get('accountability/unpaid','\App\Http\Controllers\AccountabilityController@index_unpaid');
Route::get('accountability/paid','\App\Http\Controllers\AccountabilityController@index_paid');
Route::get('accountability/{id}/payItem','\App\Http\Controllers\AccountabilityController@payItem');

//analytics
Route::get('analytics/borroweditems','\App\Http\Controllers\AnalyticsController@most_borrowed');

//user Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('users', '\App\Http\Controllers\UserController');
  Route::post('users/store/','\App\Http\Controllers\UserController@store');
  Route::post('users/update/','\App\Http\Controllers\UserController@update');
  Route::get('users/{id}/activate','\App\Http\Controllers\UserController@activate');
  Route::get('users/{id}/deactivate','\App\Http\Controllers\UserController@deactivate');
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

//listing Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('listing','\App\Http\Controllers\ListingController');
  Route::post('listing/{id}/update','\App\Http\Controllers\ListingController@update');
  Route::get('listing/{id}/delete','\App\Http\Controllers\ListingController@destroy');
  Route::get('listing/{id}/deleteMsg','\App\Http\Controllers\ListingController@DeleteMsg');
  Route::get('listing/addItem/process','\App\Http\Controllers\ListingController@addItem');
  Route::get('listing/add/{id}/addItemMsg','\App\Http\Controllers\ListingController@addItemMsg');
  Route::get('listing/{id}/addToCart/process','\App\Http\Controllers\ListingController@addToCart');
});

//listing_item Routes
Route::group(['middleware'=> 'web'],function(){
  Route::post('listing_item/{id}/update','\App\Http\Controllers\listing_itemController@update');
  Route::get('listing_item/{id}/delete','\App\Http\Controllers\listing_itemController@destroy');
  Route::get('listing_item/{id}/deleteMsg','\App\Http\Controllers\listing_itemController@DeleteMsg');
});

//cart_item Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('cart_item','\App\Http\Controllers\Cart_itemController');
  Route::post('cart_item/{id}/update','\App\Http\Controllers\Cart_itemController@update');
  Route::get('cart_item/{id}/delete','\App\Http\Controllers\Cart_itemController@destroy');
  Route::get('cart_item/{id}/deleteMsg','\App\Http\Controllers\Cart_itemController@DeleteMsg');
});

//transaction Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('transaction','\App\Http\Controllers\TransactionController');
  Route::get('transaction/{id}/show', '\App\Http\Controllers\TransactionController@show');
  Route::post('transaction/{id}/update','\App\Http\Controllers\TransactionController@update');
  Route::get('transaction/{id}/delete','\App\Http\Controllers\TransactionController@destroy');
  Route::get('transaction/{id}/deleteMsg','\App\Http\Controllers\TransactionController@DeleteMsg');
  Route::get('transaction/user/history','\App\Http\Controllers\TransactionController@user_history'); //okay
});

//Accountabilities Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('accountability','\App\Http\Controllers\AccountabilityController');
  Route::get('accountability/{id}/show', '\App\Http\Controllers\AccountabilityController@show');
  Route::post('accountability/{id}/update','\App\Http\Controllers\AccountabilityController@update');
  Route::get('accountability/{id}/delete','\App\Http\Controllers\AccountabilityController@destroy');
  Route::get('accountability/{id}/deleteMsg','\App\Http\Controllers\AccountabilityController@DeleteMsg');
  Route::post('accountability/{id}/paidCart','\App\Http\Controllers\AccountabilityController@paidCart');
  Route::post('accountability/{id}/recordCart','\App\Http\Controllers\AccountabilityController@recordCart');
  Route::get('accountability/{id}/undo_payment','\App\Http\Controllers\AccountabilityController@undo_payment');
  Route::post('accountability/{id}/paidCart','\App\Http\Controllers\AccountabilityController@paidCart');
  Route::post('accountability/{id}/recordBill','\App\Http\Controllers\AccountabilityController@recordBill');
});