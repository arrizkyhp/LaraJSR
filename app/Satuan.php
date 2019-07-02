<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 't_satuan';
    public $primaryKey = 'id_satuan';
    protected $fillable = [
        'nama_satuan'
    ];
}