
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
  Route::post('transaction/{id}/update','\App\Http\Controllers\TransactionController@update');
  Route::get('transaction/{id}/delete','\App\Http\Controllers\TransactionController@destroy');
  Route::get('transaction/{id}/deleteMsg','\App\Http\Controllers\TransactionController@DeleteMsg');
});
