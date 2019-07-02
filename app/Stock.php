<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 't_stock';
    public $primaryKey = 'id_stock';
    protected $fillable = [
        'id_peralatan', 'stock', 'tersedia', 'keluar', 'keterangan'
    ];
}