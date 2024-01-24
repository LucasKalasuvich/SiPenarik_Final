<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback',
        'users_id',
        'signer_id'
    ];

    public function users_feedback()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function signer_feed()
    {
        return $this->belongsTo('App\Models\Signed', 'signer_id');
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    protected $table = 'feedback';

}
