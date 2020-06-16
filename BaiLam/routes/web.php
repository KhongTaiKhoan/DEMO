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
       Route::post('/postRegister','LoginAdminController@postRegister')->name('admin.postRegister');
       Route::get('/register','LoginAdminController@getRegister')->name('admin.register');
       Route::post('/valid','LoginAdminController@valid')->name('admin.validAdmin');
       
       Route::group(['prefix'=>'danhmuc','middleware'=>'authadmin'], function(){
             Route::get('/list','LoginAdminController@index')->name('admin.index');
            

             Route::group(['prefix'=>'theloai'],function(){
                 Route::get('phantrang','TheLoai@pagination')->name('theloai-chuyen');
               }
            );
             Route::group(['prefix'=>'tacgia'],function(){
                Route::get('phantrang','TacGia@pagination')->name('tacgia-chuyen');
              }
            );
            Route::resource('theloai','TheLoai');
           
            Route::resource('tacgia','TacGia');
            
        }
    );
   }
);


