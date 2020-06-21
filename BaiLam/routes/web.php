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

Route::get('test/{data}',function($data){
  return \view('test')->with(['html'=>$data]);
})->name('test');

Route::group(
   ['prefix'=>'admin', 'namespace'=>'Backend'],
   function(){
       Route::get('/','LoginAdminController@getLogin')->name('admin.login');
       Route::post('/postLogin','LoginAdminController@postLogin')->name('admin.postLogin');
       Route::post('/postRegister','LoginAdminController@postRegister')->name('admin.postRegister');
      //  Route::get('/register','LoginAdminController@getRegister')->name('admin.register');
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
            Route::group(['prefix'=>'nxb'],function(){
              Route::get('phantrang','NXB@pagination')->name('nxb-chuyen');}
            );
           
            Route::group(['prefix'=>'docgia'],function(){
              Route::get('phantrang','DocGia@pagination')->name('docgia-chuyen');}
            );
            Route::group(['prefix'=>'nhanvien'],function(){
              Route::get('phantrang','NhanVien@pagination')->name('nhanvien-chuyen');}
            );
           
            Route::group(['prefix'=>'sach'],function(){
              Route::get('phantrang','Sach@pagination')->name('sach-chuyen');
              Route::get('review/{id}','Sach@review')->name('sach.review');
              Route::post('write/{id}','Sach@write')->name('sach.write');
            
            }
            );
            Route::group(['prefix'=>'taikhoan'],function(){
              Route::post('avatar/{id}','TaiKhoan@thayDoiAnhDaiDien')->name('taikhoan.avatar');
              Route::get('nhanvien/{id}','TaiKhoan@nhanvien')->name('taikhoan.nhanvien');
            
            }
            );

            Route::resource('sach','Sach');
            Route::resource('theloai','TheLoai');
            Route::resource('nxb','NXB');
           
            Route::resource('tacgia','TacGia');
            Route::resource('docgia','DocGia');
            Route::resource('nhanvien','NhanVien');
            Route::resource('taikhoan','TaiKhoan');
            
        }
    );
   }
);


// Route::get('chucvu-quyen',function(){
//    $data=  \App\Admin::find(1)->chucvus()->get();
//    foreach($data as $dat){
//         $out = $dat->quyens()->get()->toArray();
//         echo "<pre>";
//         print_r($out);
//         echo "</pre>";
//     }
  
// });


