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
// frontend route
//Route::get('/','Frontend\PagesController@index')->name('index');
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/products','Frontend\PagesController@products')->name('products');
// user token 
Route::get('/token/{token}','Frontend\VerificationsController@verified')->name('user.verification');
Route::get('/contacts','Frontend\PagesController@contacts')->name('contact');
Route::post('/contacts/store','Frontend\PagesController@store')->name('contact.store');

Route::get('/product/{id}','Frontend\PagesController@product_show')->name('product.show');
Route::get('/product/category/{id}','Frontend\PagesController@Category')->name('product.category');
Route::get('/search','Frontend\PagesController@search')->name('search');



// // admin login
 	Route::get('/admin/login','Auth\admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/admin/login','Auth\admin\LoginController@login')->name('admin.login.submit');



Route::group(['prefix'=>'admin'],function(){
	Route::get('/','backend\PagesController@index')->name('admin.dashboard');
	Route::get('/restuarant','backend\PagesController@Restuarant')->name('admin.restuarant');
	Route::get('/restuarant/block/{id}','backend\PagesController@Block');
	Route::get('/restuarant/delete/{id}','backend\PagesController@delete');

	//category route
	 Route::get('category/','backend\CategoryController@index')->name('admin.category.index');
	 Route::post('/category/store','backend\CategoryController@store');
	 Route::get('/category/edit/{id}','backend\CategoryController@edit');
	 Route::post('/category/update','backend\CategoryController@update');
	 Route::get('/category/delete/{id}','backend\CategoryController@destroy');

	 //product name route
	 Route::get('pro_name/','backend\ProductsController@index')->name('admin.pro_name.index');
	 Route::post('/pro_name/store','backend\ProductsController@store');
	 Route::get('/pro_name/edit/{id}','backend\ProductsController@edit');
	 Route::post('/pro_name/update','backend\ProductsController@update');
	 Route::get('/pro_name/delete/{id}','backend\ProductsController@destroy');

		

	//district route
	 Route::get('district/','backend\DistrictController@index')->name('admin.district.index');
	 Route::get('district/create','backend\DistrictController@create');
	 Route::post('district/store','backend\DistrictController@store');
	 Route::get('district/edit/{id}','backend\DistrictController@edit');
	 Route::post('district/update','backend\DistrictController@update');
	 Route::get('district/delete/{id}','backend\DistrictController@destroy');
	
	//Thanas route
	 Route::get('thana/','backend\ThanaController@index')->name('admin.thana.index');
	 Route::get('thana/create','backend\ThanaController@create');
	 Route::post('thana/store','backend\ThanaController@store');
	 Route::get('thana/edit/{id}','backend\ThanaController@edit');
	 Route::post('thana/update','backend\ThanaController@update');
	 Route::get('thana/delete/{id}','backend\ThanaController@destroy');


	//Orders route
	 Route::get('order/','backend\OrdersController@index')->name('admin.order.index');
	 Route::get('order/delete/{id}','backend\OrdersController@destroy');
	 Route::get('order/seen/{id}','backend\OrdersController@Seen');
	 Route::get('order/paid/{id}','backend\OrdersController@Paid');
	 Route::get('order/complete/{id}','backend\OrdersController@Complete');
	 Route::get('order/cancel/{id}','backend\OrdersController@Cancel');
	 Route::get('order/view/{id}','backend\OrdersController@View')->name('view.order');


	 Route::get('/contact','backend\PagesController@Contact')->name('admin.contact');
	 Route::get('contact/delete/{id}','backend\PagesController@destroy');
	
	
});





	//cart route
	Route::group(['prefix'=>'cart'],function(){
	 Route::get('/','frontend\CartsController@index')->name('carts');
	 Route::post('/store','frontend\CartsController@store')->name('cart.store');
	 Route::post('/update/{id}','frontend\CartsController@update')->name('cart.update');
	 Route::get('/delete/{id}','frontend\CartsController@destroy');
	});
	 Route::get('cart/plus/{id}','frontend\CartsController@Plus');
	 Route::get('cart/minus/{id}','frontend\CartsController@Minus');


	//checkout route
	Route::group(['prefix'=>'/checkouts'],function(){
	 Route::get('/','frontend\CheckoutsController@index')->name('checkouts');
	 Route::post('/store','frontend\CheckoutsController@store')->name('checkout.store');
	});

	Route::group(['prefix'=>'users'],function(){
	 Route::get('/','frontend\UsersController@index')->name('user.dashboard');
	 Route::get('/profile','frontend\UsersController@profile')->name('user.profile');
	 Route::get('/history','frontend\UsersController@history')->name('user.order.history');
	 Route::post('/update/{id}','frontend\UsersController@update')->name('user.update');
	});

	
	Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register/thana/{id}','Auth\RegisterController@Thana');
Route::get('/update/thana/{id}','frontend\UsersController@Thana');



Route::group(['prefix'=>'restuarant'],function(){
	 Route::get('/product','frontend\FooditemsController@index')->name('restuarant.product.index');
	 Route::post('/product/store','frontend\FooditemsController@store');
	 Route::get('/product/edit/{id}','frontend\FooditemsController@edit');
	 Route::post('/product/update','frontend\FooditemsController@update');
	 Route::get('/product/delete/{id}','frontend\FooditemsController@destroy');
	 Route::get('/product/block/{id}','frontend\FooditemsController@Block');

});