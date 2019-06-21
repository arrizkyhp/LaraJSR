<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 't_detail_pesanan';
    protected $primaryKey = 'id_detail_pesanan';
    protected $fillable = [
        'id_pesanan', 'id_menu', 'quantity', 'harga',  'subtotal'
    ];

    public function pesanan()
    {
        return $this->hasOne('\App\Pesanan', 'id_pesanan', 'id_pesanan');
    }
    public function menu()
    {
        return $this->hasOne('\App\Menu', 'id_menu', 'id_menu');
    }
}