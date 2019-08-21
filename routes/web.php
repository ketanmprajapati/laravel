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


// Direct Call 

Route::get('/', 'Admin\Home@index');
Route::get('/GetProductdata', 'Admin\Home@GetProductdata');
Route::post('/Getdetail', 'Admin\Home@Getdetail');
Route::post('/AddData', 'Admin\Home@AddData');
Route::post('/UpdateData', 'Admin\Home@UpdateData');




// With Prefix

Route::group(['prefix' => 'adminportal'], function () {

    Route::get('/', 'Admin\Home@index');
    Route::post('/login', 'adminportal\Main@CheckLogin');
   
});