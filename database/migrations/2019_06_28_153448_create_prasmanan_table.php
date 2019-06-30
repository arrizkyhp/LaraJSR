<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrasmananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_prasmanan', function (Blueprint $table) {
            $table->increments('id_prasmanan');
            $table->string('id_pesanan');
            $table->integer('id_peralatan');
            $table->integer('jumlah_peralatan');
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
        Schema::dropIfExists('t_prasmanan');
    }
}