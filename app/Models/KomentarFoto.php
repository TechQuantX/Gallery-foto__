<?php

// app/Models/KomentarFoto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    protected $table = 'komentarfoto';

    protected $fillable = [
        'FotoID',
        'user_id',
        'isikomentar',
        'TanggalKomentar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
