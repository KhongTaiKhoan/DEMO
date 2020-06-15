<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Admin;
use Hash;
use Validator;
class LoginAdminController extends Controller
{
   public function getLogin (){
      

        return view ('backend.login');
   }
   public function postLogin(Request $request){
    $arr = [
      'tenTaiKhoan'=>$request->get('tenTaiKhoan'),
      'password' => $request->get('pass')
    ];

    
      if(Auth::guard('admin')->attempt($arr) ){
        return \redirect(route('admin.index'));
      }else{
        \dd( $request->get('pass'));
      }
   }
   

   public function getRegister(){
      return view ('backend.register');
   }

   public function postRegister(Request $request){
      $admin = new Admin();
      $admin->tenTaiKhoan = $request->tenTaiKhoan;
      $admin->email = $request->email;
      $admin->password = bcrypt($request->pass);
      $admin->save();

      Auth::guard('admin')->login($admin);

      
      return \redirect(route('admin.index'));

      // dd($request);
   }

   public function index(){
       dd("Day la trang quan tri");
   }

   public function valid(Request $request){
        
       $validate = Validator::make(
         $request->all(),
         [
            'tenTaiKhoan' => 'unique:admins',
            'email' =>'unique:admins'     
         ],
         [
             'unique'=>':attribute đã tồn tại'
         ],
         [
            'tenTaiKhoan' => 'Tên tài khoản',
            'email' => 'Email'
         ]
       );
       
        return \response()->json([
            'isValid'=>$validate->fails(),
        ],200
        );

   }
}