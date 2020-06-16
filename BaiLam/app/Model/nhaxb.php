<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class nhaxb extends Model
{
    protected $table='nhaxbs';
    protected $fillable = ['id','tenNXB','email','sdt'];
}
