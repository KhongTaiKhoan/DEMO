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

Route::group(
   ['prefix'=>'admin', 'namespace'=>'Backend'],
   function(){
       Route::get('/','LoginAdminController@getLogin')->name('admin.login');
       Route::post('/postLogin','LoginAdminController@postLogin')->name('admin.postLogin');
   }
);
