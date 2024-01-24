<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Signed extends Model
{
    use HasFactory;

    protected $fillable = [
        'keterangan',
        'status',
        'users_id',
        'files_id',
        'signer_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function file()
    {
        return $this->belongsTo('App\Models\Upload', 'files_id');
    }

    public function signer()
    {
        return $this->belongsTo('App\Models\User', 'signer_id');
    }

    public function signer_feed()
    {
        return $this->hasOne('App\Models\Feedback', 'signer_id');
    }

    // public function dokumenSigned()
    // {
    //     return $this->hasOne('App\Models\SignatureFile', 'signer_id');
    // }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    protected $table = 'requestsigned';

}
