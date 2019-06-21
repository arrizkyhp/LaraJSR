<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPesanan extends Model
{
    public $primaryKey = 'id_jenis_pesanan';
    protected $table = 't_jenis_pesanan';
    protected $fillable = [
        'nama_jenis_pesanan', 'kode', 'deskripsi', 'foto'
    ];
}