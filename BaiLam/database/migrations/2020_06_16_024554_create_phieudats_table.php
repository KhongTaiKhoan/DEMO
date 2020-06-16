<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
class CreatePhieudatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieudats', function (Blueprint $table) {
            $table->id();
            $table->date('ngayDat')->default(Carbon::now());
            $table->date('ngayHetHan')->default(Carbon::now());
            $table->integer('ID_CuonSach');
            $table->integer('ID_DocGia');
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
        Schema::dropIfExists('phieudats');
    }
}
