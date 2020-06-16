<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
class CreatePhieunhapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieunhaps', function (Blueprint $table) {
            $table->id();
            $table->date('ngayNhap')->default(Carbon::now());
            $table->integer('soLuong');
            $table->float('tongGia');
            $table->integer('ID_NhanVien');
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
        Schema::dropIfExists('phieunhaps');
    }
}
