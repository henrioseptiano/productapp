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

Route::get('/login', 'Main\UserController@login');
Route::post('/loginprocess', 'Main\UserController@loginprocess');
Route::get('/logoutprocess', 'Main\UserController@logoutprocess');
Route::get('/', 'Main\ProductController@index');
Route::post('/search', 'Main\ProductController@searchs');
Route::get('/addproduct', 'Main\ProductController@addproduct');
Route::get('/editproduct/{id}', 'Main\ProductController@editproduct');
Route::get('/detailproduct/{id}', 'Main\ProductController@detailproduct');
