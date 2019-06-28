<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListMakanan extends Model
{
    public $primaryKey = 'id_list_makanan';
    protected $table = 't_list_makanan';
    protected $fillable = [
        'nama_makanan', 'id_jenis_makanan', 'harga'
    ];

    public function jenis_makanan()
    {
        return $this->hasOne('\App\JenisListMakanan', 'id_jenis_makanan', 'id_jenis_makanan');
    }
}