<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyewaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_penyewaan', function (Blueprint $table) {
            $table->string('id_penyewaan')->primary();
            $table->integer('id_pelanggan');
            $table->integer('id_users');
            $table->date('tanggal_penyewaan');
            $table->date('tanggal_kembali');
            $table->integer('total_harga');
            $table->integer('bayar');
            $table->string('keterangan')->nullable();
            $table->integer('status_bayar');
            $table->integer('status_penyewaan');
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
        Schema::dropIfExists('penyewaan');
    }
}