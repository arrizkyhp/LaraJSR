<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public $primaryKey = 'id_pesanan';
    public $incrementing = false;
    protected $table = 't_pesanan';
    protected $fillable = [
        'id_pesanan', 'id_pelanggan', 'id_users', 'tanggal', 'tanggal_pesanan', 'total_harga', 'keterangan',  'bayar', 'status_bayar', 'status_pesanan', 'status_alat'
    ];

    public function pelanggan()
    {
        return $this->hasOne('\App\Pelanggan', 'id_pelanggan', 'id_pelanggan');
    }


    public function detail_pesanan()
    {
        return $this->hasMany('\App\DetailPesanan', 'id_pesanan');
    }

    public function user()
    {
        return $this->hasOne('\App\Users', 'id_users', 'id_users');
    }
    public function bayar()
    {
        return $this->hasMany('\App\Bayar', 'id_pesanan');
    }
    public function prasmanan()
    {
        return $this->hasMany('\App\Prasmanan', 'id_pesanan');
    }
}