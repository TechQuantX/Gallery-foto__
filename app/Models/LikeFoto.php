<?php

// app/Models/LikeFoto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    protected $table = 'likefoto';

    protected $fillable = [
        'FotoID',
        'UserID',
        'TanggalLike',
    ];
    // LikeFoto.php (Model)

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'FotoID');
    }
}
