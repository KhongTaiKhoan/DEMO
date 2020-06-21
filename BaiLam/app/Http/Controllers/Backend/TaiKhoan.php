<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use File;
class TaiKhoan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr =  DB::table('admins')->join('nhanviens','admins.ID_NhanVien','nhanviens.id')->select(['admins.*','nhanviens.hoTen'])->paginate(5);
        // $nhanvien = \App\Model\nhanvien::all()

      
        
        return view('backend.pages.taikhoan.index',['arr'=>$arr,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhanviens = \App\Model\nhanvien::all();
      return view ('backend.register')->with(['nhanvien'=>$nhanviens]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $data = \DB::table('admins')->join('nhanviens','nhanviens.id','admins.ID_NhanVien')
        //            ->where('admins.id',$id)->select('admins.*','nhanviens.*')->first();
        // $data->ngayLap = Carbon::parse($data->ngayLap);         
        $data = \App\Admin::find($id);
        $data->ngayLap = Carbon::parse($data->ngayLap);   
       // $chucvu = $data->chucvus()->get();
        
       
        
        
        return view('backend.pages.taikhoan.show')->with(['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        $data = \App\Admin::find($id);

        $data->ngayLap = Carbon::parse($data->ngayLap);   
        return view('backend.pages.taikhoan.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //// cac ham xu ly khac
    protected  $duongDanAnhDaiDien = "img/avatar/admin";
    public function thayDoiAnhDaiDien(Request $request, $id){
        
        $avatar = $request->file('avatar'); 
        $admin = \App\Admin::find($id);
        // return redirect(\route('test',['data'=>$request]));
      
        if($avatar){
            $name = $avatar->getClientOriginalName();
            $name_ = explode('.',$name)[0]; 
            $_name = explode('.',$name)[1];
            $name = $name_ . \rand(0,100).$_name;
            if(File::exists($this->duongDanAnhDaiDien  .'/' . $admin->avatar) && $admin->avatar != "blank.png")
                File::delete($this->duongDanAnhDaiDien.'/' . $admin->avatar);
            $avatar->move($this->duongDanAnhDaiDien,$name);
            $admin->avatar = $name;
            $admin->save();    
            return \response()->json(['yes'=>true],200);
        }
        return \response()->json(['yes'=>false],200);
    }


    public function nhanVien ($id){
        $nhanvien=\App\Model\nhanvien::find($id);
         return \redirect()->route('nhanvien.show',['nhanvien'=>$nhanvien]);  
    }
}
