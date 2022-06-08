<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::get('/','frontend\PagesController@indexsliderapi');
Route::get('/category','frontend\PagesController@indexcategoryapi');
Route::get('/product','frontend\PagesController@indexproductapi');
Route::get('/details/{id}','frontend\PagesController@product_showapi');
Route::get('/category/{id}','frontend\PagesController@product_category');
Route::post('/name','frontend\PagesController@product_name');
Route::get('/orders/{id}','frontend\PagesController@OrdersList');
Route::post('/loginuser','Auth\LoginController@loginuser');
Route::post('/register','Auth\RegisterController@registeruser');
Route::post('/checkout/store','frontend\CheckoutsController@storecart');
Route::post('/cart/store','frontend\CartsController@sCart');
// Route::get('/districts','frontend\PagesController@District');
// Route::get('/thanas','frontend\PagesController@Thana');
// Route::get('/category/{id}','frontend\PagesController@CategoryID');
// Route::get('/orders/{id}','frontend\PagesController@Order');
