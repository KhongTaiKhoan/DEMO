<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class docgia extends Model
{
    protected $table='docgias';
    protected $fillable = ['id','hoTen','namSinh','diaChi','sdt','email'];
}
