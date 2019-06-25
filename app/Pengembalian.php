<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 't_pengembalian';
    public $primaryKey = 'id_pengembalian';
    public $incrementing = false;
    protected $fillable = [
        'id_pengembalian',
        'id_penyewaan',
        'tanggal_kembali',
        'denda_per_hari',
        'denda_telat',
        'denda_ganti',
        'total_denda',
    ];

    public function penyewaan()
    {
        return $this->hasOne('\App\Penyewaan', 'id_penyewaan', 'id_penyewaan');
    }
}