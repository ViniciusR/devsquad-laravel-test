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

use Illuminate\Http\Request;

Route::view('/', 'home');

Route::post('/products/uploadCSV', 'ProductController@uploadCSV')->name('products.uploadCSV');
Route::resource('/products', 'ProductController');

Auth::routes();

Route::get('/myaccount', 'UserController@myaccount')->name('myaccount');
Route::put('/user/update/{id}', 'UserController@update')->name('users.update');
