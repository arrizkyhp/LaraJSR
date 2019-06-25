<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeralatanRusak extends Model
{
    protected $table = 't_peralatan_rusak';
    public $primaryKey = 'id_peralatan_rusak';
    protected $fillable = [
        'id_pengembalian',
        'id_peralatan',
        'jumlah_rusak',
    ];

    public function pengembalian()
    {
        return $this->hasOne('\App\Pengembalian', 'id_pengembalian', 'id_pengembalian');
    }
    public function peralatan()
    {
        return $this->hasOne('\App\Peralatan', 'id_peralatan', 'id_peralatan');
    }
}