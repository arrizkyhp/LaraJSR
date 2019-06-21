<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_detail_pesanan', function (Blueprint $table) {
            $table->increments('id_detail_pesanan');
            $table->string('id_pesanan');
            $table->string('id_menu');
            $table->string('quantity');
            $table->string('harga');
            $table->string('subtotal');

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
        Schema::dropIfExists('t_detail_pesanan');
    }
}