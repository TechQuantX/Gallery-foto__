<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';
    protected $fillable = [
        'JudulFoto',
        'DeskripsiFoto',
        'TanggalUnggah',
        'LokasiFile',
        'album_id',
        'user_id',
    ];

    // Relasi dengan model Album
    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function komentar()
    {
        return $this->hasMany(KomentarFoto::class, 'FotoID');
    }

    public function likes()
    {
        return $this->hasMany(LikeFoto::class, 'FotoID');
    }
    public function likedByUser()
    {
        return $this->likes->contains('user_id', Auth::id());
    }

    public static function rules($id = null)
    {
        return [
            'JudulFoto' => 'required|unique:fotos,JudulFoto,' . $id,
            'DeskripsiFoto' => 'required',
            'TanggalUnggah' => 'required|date',
            'LokasiFile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'album_id' => 'required|exists:albums,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        // Set TanggalUnggah to current date and time before saving
        static::creating(function ($foto) {
            $foto->TanggalUnggah = Carbon::now();
        });
    }
}
