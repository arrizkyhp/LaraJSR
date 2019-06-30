<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prasmanan extends Model
{
    protected $table = 't_prasmanan';
    public $primaryKey = 'id_prasmanan';
    protected $fillable = [
        'id_pesanan', 'id_peralatan', 'jumlah_peralatan'
    ];

    public function pesanan()
    {
        return $this->hasOne('\App\Pesanan', 'id_pesanan', 'id_pesanan');
    }

    public function peralatan()
    {
        return $this->hasOne('\App\Peralatan', 'id_peralatan', 'id_peralatan');
    }
}