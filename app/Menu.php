<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $primaryKey = 'id_menu';

    protected $table = 't_menu';

    public $incrementing = false;

    protected $fillable = [
        'id_menu', 'id_jenis_pesanan', 'nama_menu', 'harga', 'deskripsi', 'status_peralatan'
    ];

    public function jenis_pesanan()
    {
        return $this->hasOne('\App\JenisPesanan', 'id_jenis_pesanan', 'id_jenis_pesanan');
    }

    public function detail_menu()
    {
        return $this->hasMany('\App\DetailMenu', 'id_menu', 'id_menu');
    }
}