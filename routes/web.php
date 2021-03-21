<?php

use Illuminate\Support\Facades\Route;

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

// Auth
Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@request_Login')->name('login.post');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::post('/sendCode', 'AuthController@sendConfirmationCode')->name('sendCode');
Route::get('/confirmar', 'RegisterController@showConfirmForm')->name('register.confirm');
Route::post('/confirmar', 'RegisterController@confirmCode')->name('register.code.confirm');
Route::get('/restore', 'AuthController@showRestoreForm')->name('password.restore');
Route::post('/restore/save', 'AuthController@changePass')->name('restore.save');
Route::resource('registro', 'RegisterController');

Route::get('/recovery', 'AuthController@showRecoveryForm')->name('recovery');
Route::view('/registroProveedores', 'system.templates.webforms.provider')->name('proveedores');
Route::resource('comercios', 'CommerceController');
//distribuidor
Route::resource('distribuidor', 'DistributorController');

// Home
Route::get('/','HomeController@index')->name('home');
Route::view('/redirect/error', 'system.templates.home.redirectError');

Route::get('prueba', function () {
    dd(session('dir') );
});

// un Restaurante y todos los resturantes
Route::get('/restaurantes/{id?}/{cat?}','HomeController@show')->name('restaurantes');
Route::get('/restaurante/{id?}/{cat?}', 'ListCommerceController@show')->name('restaurante');

// Supermercado muchos y uno
Route::get('/supermercados/{id?}/{cat?}', 'HomeController@show')->name('supermercados');
Route::get('/supermercado/{id?}/{cat?}', 'ListCommerceController@show')->name('supermercado');

// carrito
Route::resource('carrito', 'CartController');
Route::get('cart/delete','CartController@destroyer')->name('destroyCart');
Route::get('cart/delete2','CartController@destroyer2')->name('destroyCart');
Route::post('pagar', 'CartController@checkout')->middleware('authUser')->name('pagar');

Route::get('buscador/{commerceType?}','ProductsController@show')->name('buscador');


Route::group(['middleware' => ['authUser']], function () {
  // User
  Route::get('/perfil', 'ProfileController@index')->name('perfil');
  Route::post('/perfil/address/add', 'ProfileController@addAddress');
  Route::post('/perfil/address/edit', 'ProfileController@editAddress');
  Route::post('/perfil/address/update', 'ProfileController@updateAddress');
  Route::post('/perfil/address/delete', 'ProfileController@deleteAddress');
  Route::get('checkout', 'CartController@index')->name('checkout');
  Route::put('/perfil','ProfileController@update')->name('profile.update');
  Route::get('/order/{id?}','OrderController@show');
  Route::get('/replay/cart/{id}','CartController@replay');
});
Route::view('/detallePedido', 'system.templates.user.pedido')->name('pedido');

//routas para de fetch desde javascript
Route::get('product/{id}','ListCommerceController@showProduct');
Route::post('/selectD',  'ProfileController@selectDirection');
Route::post('getHours','CartController@getShippingHour');
Route::post('addDir','ProfileController@addDir');
Route::post('coupons','CartController@getCoupon');
Route::post('distributor', 'CartController@getDistributor');




