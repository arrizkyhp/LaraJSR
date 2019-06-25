<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengembalianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pengembalian', function (Blueprint $table) {
            $table->string('id_pengembalian')->primary();
            $table->string('id_penyewaan');
            $table->date('tanggal_kembali');
            $table->integer('denda_per_hari')->nullable();
            $table->integer('denda_telat')->nullable();
            $table->integer('denda_ganti')->nullable();
            $table->integer('total_denda')->nullable();
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
        Schema::dropIfExists('t_pengembalian');
    }
}