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
            $table->string('hoTen',50);
            $table->date('namSinh');
            $table->date('namMat')->nullable();
            $table->string('tomTat',100);
            $table->string('quocTich',20)->nullable();
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