<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKodeFieldToJenisPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_jenis_pesanan', function (Blueprint $table) {
            $table->string('kode')->after('id_jenis_pesanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_jenis_pesanan', function (Blueprint $table) {
            $table->dropColumn('kode');
        });
    }
}