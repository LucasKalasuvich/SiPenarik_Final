<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class PIN extends Model
{
    use HasFactory;

    protected $fillable = [
        'pin',
        // 'status',
        'users_id'
    ];

    protected $hidden = [
        'pin'
    ];

    public function pin()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    protected $table = 'pin';

}