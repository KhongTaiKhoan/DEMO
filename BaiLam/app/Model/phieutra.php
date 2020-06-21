<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phieutra extends Model
{
    protected $table='phieutras';
    protected $fillable = ['id','ngayTra','ID_PhieuMuon','ID_NhanVien'];
}
