<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PhieuTra extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang = DB::table('phieutras')->join('phieumuons','phieutras.ID_PhieuMuon','=','phieumuons.id')
                   ->join('nhanviens','phieutras.ID_NhanVien','=','nhanviens.id')
                   ->select(['phieutras.id','phieutras.ngayTra','phieumuons.id as idphieumuon','nhanviens.hoTen as tenNhanVien',])->paginate(5);
        return \view('backend.pages.phieutra.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phieumuon =  DB::table('phieumuons')->select('id')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        return \view('backend.pages.phieutra.create',['itemphieumuon'=>$phieumuon, 'itemnhanvien'=>$nhanvien]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phieutra = new \App\Model\phieutra();
        $phieutra->ngayTra = $request->ngayTra;
        $phieutra->ID_PhieuMuon = $request->ID_PhieuMuon;
        $phieutra->ID_NhanVien = $request->ID_NhanVien;
        $phieutra->save();
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
    {   $phieutra=\App\Model\phieutra::find($id);
        if($phieutra != null){
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
        $phieutra =  \App\Model\phieutra::find($id);
        $phieumuon =  DB::table('phieumuons')->select('id')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        return view('backend.pages.phieutra.edit')->with(['item'=>$phieutra, 'itemphieumuon'=>$phieumuon, 'itemnhanvien'=>$nhanvien]);
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
        $phieutra =  \App\Model\phieutra::find($id);
        $phieutra->ngayTra = $request->ngayTra;
        $phieutra->ID_PhieuMuon = $request->ID_PhieuMuon;
        $phieutra->ID_NhanVien = $request->ID_NhanVien;
        $phieutra->save();
        
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
        \App\Model\phieutra::destroy($id);
        return \response()->json(['size'=>\App\Model\phieutra::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('phieutras')->paginate(5);
           
          return  
          view('backend.pages.phieutra.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
