<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisListMakanan extends Model
{
    public $primaryKey = 'id_jenis_makanan';
    protected $table = 't_jenis_makanan';
    protected $fillable = [
        'nama_jenis_makanan'
    ];
}