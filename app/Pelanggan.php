<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 't_pelanggan';
    public $primaryKey = 'id_pelanggan';
    protected $fillable = [
        'nama_pelanggan', 'alamat','email', 'no_telepon'
    ];
}