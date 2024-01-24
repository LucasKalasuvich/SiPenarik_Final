<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'email',
        'bagian',
        'nip',
        'telepon',
        'level',
    ];

    protected $hidden = [
        'password',
    ];

    public function UserTTD()
    {
        return $this->hasOne('App\Models\SignatureFile', 'users_id');
    }

    protected $table = 'users';
}
