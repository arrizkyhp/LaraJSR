<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeralatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_peralatan', function (Blueprint $table) {
            $table->increments('id_peralatan');
            $table->string('nama_peralatan');
            $table->string('satuan');
            $table->integer('stock');
            $table->integer('tersedia');
            $table->integer('keluar');
            $table->integer('harga_sewa');
            $table->integer('harga_ganti');
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
        Schema::dropIfExists('t_peralatan');
    }
}