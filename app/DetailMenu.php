<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailMenu extends Model
{
    public $primaryKey = 'id_detail_menu';

    protected $table = 't_detail_menu';

    protected $fillable = [
        'id_menu', 'id_list_makanan'
    ];

    public function list_makanan()
    {
        return $this->hasOne('\App\ListMakanan', 'id_list_makanan', 'id_list_makanan');
    }
    public function menu()
    {
        return $this->hasOne('\App\Menu', 'id_menu', 'id_menu');
    }
}