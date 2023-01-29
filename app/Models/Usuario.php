<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


class Usuario extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'usuarios';

    protected $fillable = [
        'nick',
        'mail',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    function getJWTIdentifier()
    {
        return $this->getKey();
    }

    function getJWTCustomClaims()
    {
        return [];
    }

}
