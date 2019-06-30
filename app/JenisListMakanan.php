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

    public function list_makanan()
    {
        return $this->hasMany('\App\JenisListMakanan', 'id_jenis_makanan', 'id_jenis_makanan');
    }
}