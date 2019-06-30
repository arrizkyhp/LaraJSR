<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $table = 't_bayar';
    public $primaryKey = 'id_bayar';
    protected $fillable = [
        'id_pesanan',
        'bayar',
        'tanggal_bayar',
        'keterangan'
    ];

    public function pesanan()
    {
        return $this->hasOne('\App\Pesanan', 'id_pesanan', 'id_pesanan');
    }
}