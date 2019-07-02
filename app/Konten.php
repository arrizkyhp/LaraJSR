<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    public $primaryKey = 'id_konten';
    protected $table = 't_konten';
    protected $fillable = [
        'id_jenis_pesanan', 'nama_konten', 'deskripsi', 'foto'
    ];

    public function jenis()
    {
        return $this->hasOne('\App\JenisPesanan', 'id_jenis_pesanan', 'id_jenis_pesanan');
    }
}