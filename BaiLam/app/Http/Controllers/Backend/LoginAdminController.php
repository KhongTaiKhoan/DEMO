<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Hash;
class LoginAdminController extends Controller
{
   public function getLogin (){
      

        return view ('backend.login');
   }
   public function postLogin(Request $request){
    $arr = [
      'tenTaiKhoan'=>$request->get('username'),
      'password' => $request->get('pass')
  ];

    
      if(Auth::guard('admin')->attempt($arr) ){
            \dd("cong");
      }else{
        \dd('bai');
      }
   }
}
