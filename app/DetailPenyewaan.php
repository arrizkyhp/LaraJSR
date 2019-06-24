<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    protected $table = 't_detail_penyewaan';
    protected $primaryKey = 'id_detail_penyewaan';
    protected $fillable = [
        'id_penyewaan', 'id_peralatan', 'jumlah_sewa', 'subtotal'
    ];

    public function penyewaan()
    {
        return $this->hasOne('\App\Penyewaan', 'id_penyewaan', 'id_penyewaan');
    }
    public function peralatan()
    {
        return $this->hasOne('\App\Peralatan', 'id_peralatan', 'id_peralatan');
    }
}