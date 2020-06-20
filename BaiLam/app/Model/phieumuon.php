<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phieumuon extends Model
{
    protected $table='phieumuons';
    protected $fillable = ['id','ngayMuon','ngayTra','ID_DocGia','ID_NhanVien'];
}
