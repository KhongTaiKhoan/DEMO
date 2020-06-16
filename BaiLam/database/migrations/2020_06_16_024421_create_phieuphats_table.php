<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuphatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieuphats', function (Blueprint $table) {
            $table->id();
            $table->string('ghiChu');
            $table->integer('denBu');
            $table->integer('ID_NhanVien');
            $table->integer('ID_PhieuTra');
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
        Schema::dropIfExists('phieuphats');
    }
}
