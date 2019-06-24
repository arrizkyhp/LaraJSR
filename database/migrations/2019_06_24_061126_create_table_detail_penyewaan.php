<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailPenyewaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_detail_penyewaan', function (Blueprint $table) {
            $table->increments('id_detail_penyewaan');
            $table->string('id_penyewaan');
            $table->string('id_peralatan');
            $table->string('jumlah_sewa');
            $table->integer('subtotal');
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
        Schema::dropIfExists('t_detail_penyewaan');
    }
}