<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sachs', function (Blueprint $table) {
            $table->id();
            $table->string('tenSach',50);
            $table->integer('namXuatBan');
            $table->string('anhBia',50);
            $table->float('diemDanhGia');
            $table->integer('soLuong');
            $table->integer('gia');
            $table->string('mieuTa')->nullable();
            $table->integer('soLuongMuon');
            $table->boolean('choPhepMuon');
            $table->integer('ID_TheLoai');
            $table->integer('ID_TacGia');
            $table->integer('ID_NhaXB');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sachs');
    }
}
