<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SignatureFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_signed',
        'file_name',
        'dokumen_id',
        'users_id'
    ];

    public function fileSign()
    {
        return $this->belongsTo('App\Models\Upload', 'dokumen_id');
    }

    public function usersFileSign()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function signerFileSign()
    {
        return $this->belongsTo('App\Models\User', 'signer_id');
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    protected $table = 'signaturefile';

}
