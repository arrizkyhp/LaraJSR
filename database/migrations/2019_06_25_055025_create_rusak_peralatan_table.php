<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRusakPeralatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_peralatan_rusak', function (Blueprint $table) {
            $table->increments('id_peralatan_rusak');
            $table->string('id_pengembalian');
            $table->integer('id_peralatan');
            $table->integer('jumlah_rusak');
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
        Schema::dropIfExists('rusak_peralatan');
    }
}