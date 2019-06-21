<?php

namespace App;


use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Users extends Authenticatable
{

    use  Notifiable;
    protected $primaryKey = 'id_users';
    protected $table = 'users';
    protected $fillable = [
        'name', 'username', 'password', 'role'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}