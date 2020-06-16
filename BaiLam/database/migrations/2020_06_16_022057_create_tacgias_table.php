<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTacgiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tacgias', function (Blueprint $table) {
            $table->id();
            $table->string('hoTen',30);
            $table->integer('namSinh');
            $table->integer('namMat')->nullable();
            $table->string('quocGia',30);
            $table->string('tomTatNgan')->nullable();
            $table->string('anhChanDung',50);
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
        Schema::dropIfExists('tacgias');
    }
}
