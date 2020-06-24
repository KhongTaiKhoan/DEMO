<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
        'tenTaiKhoan',
        'password',
        'id',
        'email',
        'ngayLap',
        'avatar',
        'ID_NhanVien',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function nhanvien(){
        return $this->belongsTo('App\Model\nhanvien','ID_NhanVien');
    }

    public function chucvus(){
        return $this->belongsToMany('App\Model\chucvu','admin_chucvu','ID_Admin','ID_ChucVu'); 
    }

   
}
