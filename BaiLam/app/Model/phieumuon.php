<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phieumuon extends Model
{
    protected $table='phieumuons';
    protected $fillable = ['id','ngayMuon','ngayTra','ID_DocGia','ID_NhanVien','daTra','soLuongSach' ];

    public function cuonsachs(){
        return $this->belongsToMany('App\Model\cuonsach','chitietphieumuons','ID_PhieuMuon','ID_CuonSach');
    }
}
