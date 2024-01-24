<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesan',
        'users_id'
    ];

    public function users_pesan()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    protected $table = 'comment';

}
