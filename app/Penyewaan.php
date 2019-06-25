<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{

    protected $table = 't_penyewaan';
    public $primaryKey = 'id_penyewaan';
    public $incrementing = false;
    protected $fillable = [
        'id_penyewaan',
        'id_pelanggan',
        'id_users',
        'tanggal_penyewaan',
        'tanggal_akhir',
        'tanggal_kembali',
        'total_harga',
        'total_bayar',
        'bayar',
        'keterangan',
        'status_bayar',
        'status_penyewaan'
    ];

    public function pelanggan()
    {
        return $this->hasOne('\App\Pelanggan', 'id_pelanggan', 'id_pelanggan');
    }

    public function users()
    {
        return $this->hasOne('\App\Users', 'id_users', 'id_users');
    }

    public function detail_penyewaan()
    {
        return $this->hasMany('\App\DetailPenyewaan', 'id_penyewaan');
    }

    public function pengembalian()
    {
        return $this->hasMany('\App\Pengembalian', 'id_penyewaan');
    }
    // public static function tanggalGanti($value)
    // {
    //     // return \Carbon\Carbon::parse($value)->addDays(+1)->format('d-m-Y'); tambah hari
    //     return \Carbon\Carbon::now()->diffInDays($value);
    // }
}