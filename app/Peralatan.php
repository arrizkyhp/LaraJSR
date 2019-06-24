<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $table = 't_peralatan';
    public $primaryKey = 'id_peralatan';
    protected $fillable = [
        'nama_peralatan', 'satuan', 'stock', 'harga_sewa', 'harga_ganti'
    ];
}