<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'users_id'
    ];

    public function upload()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function files()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function dokumenSigned()
    {
        return $this->hasOne('App\Models\SignatureFile', 'dokumen_id');
    }

    public function fileOut()
    {
        return $this->hasOne('App\Models\Signed', 'files_id');
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    protected $table = 'upload';


}
