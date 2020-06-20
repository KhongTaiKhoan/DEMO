<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ChiTietPhieuMuon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang = DB::table('chitietphieumuons')->join('phieumuons','chitietphieumuons.ID_PhieuMuon','=','phieumuons.id')
                   ->join('cuonsachs','chitietphieumuons.ID_CuonSach','=','cuonsachs.id')
                   ->select(['chitietphieumuons.id','phieumuons.id as idphieumuon','cuonsachs.id as idcuonsach'])->paginate(5);
        return \view('backend.pages.chitietphieumuon.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phieumuon = DB::table('phieumuons')->select('id')->get();
        $cuonsach =  DB::table('cuonsachs')->select('id')->get();
        return \view('backend.pages.chitietphieumuon.create',['itemcuonsach'=>$cuonsach,'itemphieumuon'=>$phieumuon]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chitietphieumuon = new \App\Model\chitietphieumuon();
        $chitietphieumuon->ID_PhieuMuon = $request->ID_PhieuMuon;
        $chitietphieumuon->ID_CuonSach = $request->ID_CuonSach;
        $chitietphieumuon->save();
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
    {   
        $mang = DB::table('chitietphieumuons')->join('phieumuons','chitietphieumuons.ID_PhieuMuon','=','phieumuons.id')
                   ->join('cuonsachs','chitietphieumuons.ID_CuonSach','=','cuonsachs.id')
                   ->join('saches','cuonsachs.ID_Sach','saches.id')
                   ->join('docgias','phieumuons.ID_DocGia','=','docgias.id')
                   ->join('nhanviens','phieumuons.ID_NhanVien','=','nhanviens.id')
                   ->select(['chitietphieumuons.id','phieumuons.id as idphieumuon','cuonsachs.id as idcuonsach','phieumuons.ngayMuon','phieumuons.ngayHenTra','nhanviens.hoTen as tenNhanVien','docgias.hoTen as tenDocGia','saches.tenSach as tenSach'])
                   ->where('phieumuons.id', $id)
                   ->paginate(5);
        return \view('backend.pages.chitietphieumuon.index')->with(['arr'=>$mang,'page'=>1]);
        // $chitietphieumuon=\App\Model\chitietphieumuon::find($id);
        // if($chitietphieumuon != null){
        //     return \response()->json(['yes'=>true],200);
        // }
        // else return \response()->json(['yes'=>fasle],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chitietphieumuon =  \App\Model\chitietphieumuon::find($id);
        $cuonsach = DB::table('cuonsachs')->select('id')->get();
        return view('backend.pages.chitietphieumuon.edit')->with(['itemctpm'=>$chitietphieumuon,'itemcuonsach'=>$cuonsach]);
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
        $chitietphieumuon =  \App\Model\chitietphieumuon::find($id);
        $chitietphieumuon->ID_CuonSach = $request->ID_CuonSach;
        $chitietphieumuon->save();
        
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
        \App\Model\chitietphieumuon::destroy($id);
        return \response()->json(['size'=>\App\Model\chitietphieumuon::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('chitietphieumuons')->paginate(5);
           
          return  
          view('backend.pages.chitietphieumuon.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
