<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PhieuMuon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang = DB::table('phieumuons')->join('docgias','phieumuons.ID_DocGia','=','docgias.id')
                   ->join('nhanviens','phieumuons.ID_NhanVien','=','nhanviens.id')
                   ->select(['phieumuons.id','phieumuons.ngayMuon','phieumuons.ngayHenTra','nhanviens.hoTen as tenNhanVien','docgias.hoTen as tenDocGia'])->paginate(5);
        return \view('backend.pages.phieumuon.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docgia =  DB::table('docgias')->select('id', 'hoTen')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        return \view('backend.pages.phieumuon.create',['nhanvien'=>$nhanvien, 'itemdocgia'=>$docgia, 'itemnhanvien'=>$nhanvien]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phieumuon = new \App\Model\phieumuon();
        $phieumuon->ngayMuon = $request->ngayMuon;
        $phieumuon->ngayHenTra = $request->ngayHenTra;
        $phieumuon->ID_DocGia = $request->ID_DocGia;
        $phieumuon->ID_NhanVien = $request->ID_NhanVien;
        $phieumuon->save();
        return \response()->json(
            [
                'yes'=>true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $phieumuon=\App\Model\phieumuon::find($id);
        if($phieumuon != null){
            return \response()->json(['yes'=>true],200);
        }
        else return \response()->json(['yes'=>fasle],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phieumuon =  \App\Model\phieumuon::find($id);
        $docgia =  DB::table('docgias')->select('id', 'hoTen')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        return view('backend.pages.phieumuon.edit')->with(['item'=>$phieumuon, 'itemdocgia'=>$docgia, 'itemnhanvien'=>$nhanvien]);
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
        $phieumuon =  \App\Model\phieumuon::find($id);
        $phieumuon->ngayMuon = $request->ngayMuon;
        $phieumuon->ngayHenTra = $request->ngayHenTra;
        $phieumuon->ID_DocGia = $request->ID_DocGia;
        $phieumuon->ID_NhanVien = $request->ID_NhanVien;
        $phieumuon->save();
        
       return \response()->json(['yes'=>true],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Model\phieumuon::destroy($id);
        return \response()->json(['size'=>\App\Model\phieumuon::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('phieumuons')->paginate(5);
           
          return  
          view('backend.pages.phieumuon.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
