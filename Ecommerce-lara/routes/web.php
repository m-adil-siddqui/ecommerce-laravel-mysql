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

Route::get('/', 'ProductController@show')->name('all');
Route::get('/products-all', 'ProductController@showAll');
Route::resource('checkout', 'OrderController');
Route::resource('contactus', 'ContactUsController');
 
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products/search', 'ProductController@search');
//Route::get('/contact-us', '')->name('contact-us');

Route::group(['as' => 'products.', 'prefix' => 'products'], function(){
  Route::get('/', 'ProductController@show')->name('all');
  Route::get('/category/{cat}', 'ProductController@productRelatedCat2');
  Route::get('/{product}', 'ProductController@single')->name('single');
  Route::get('/addToCart/{id}', 'ProductController@addToCart')->name('addToCart');
  Route::get('/cat/{category}', 'ProductController@productRelatedCat')->name('cat');
});

Route::group(['as' => 'cart.', 'prefix' => 'cart'], function(){
	Route::get('/', 'ProductController@cart')->name('all');
	Route::post('/remove/{id}', 'ProductController@removeProduct')->name('remove');
	Route::post('/update/{id}', 'ProductController@updateProduct')->name('update');

});

Route::get('cote/{id}', 'ProductController@productRelatedCat');

Route::group(['as'=>'admin.','middleware'=>['auth','admin'],'prefix'=>'admin'], function(){
	
Route::get('category/{category}/remove', 'CategoryController@remove')->name('category.remove');
Route::get('category/trash', 'CategoryController@trash')->name('category.trash');
Route::get('category/recover/{id}', 'CategoryController@recoverCat')->name('category.recover');
Route::get('cat/{id}', 'CategoryController@deleteTrashCat');

Route::get('product/{product}/remove', 'ProductController@remove')->name('product.remove');    
Route::get('product/recover/{id}', 'ProductController@recoverProduct')->name('product.recover');
Route::get('product/trash', 'ProductController@trash')->name('product.trash');

Route::get('profile/{profile}/remove', 'ProfileController@remove')->name('profile.remove');
Route::get('profile/trash', 'ProfileController@trash')->name('profile.trash');
Route::get('profile/state/{id?}', 'ProfileController@getStates')->name('profile.state');
Route::get('profile/city/{id?}', 'ProfileController@getCities')->name('profile.city');
Route::get('profile/recover/{id}', 'ProfileController@recover')->name('profile.recover');


Route::get('/dashboard', 'AdminController@dashBoard')->name('dashboard');

	Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
   Route::resource('profile','ProfileController');
});

	



