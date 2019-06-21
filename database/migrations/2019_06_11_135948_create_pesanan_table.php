<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pesanan', function (Blueprint $table) {
            $table->string('id_pesanan')->primary();
            $table->integer('id_pelanggan');
            $table->integer('id_users');
            $table->date('tanggal');
            $table->date('tanggal_pesanan');
            $table->integer('total_harga');
            $table->integer('bayar');
            $table->string('keterangan')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('t_pesanan');
    }
}