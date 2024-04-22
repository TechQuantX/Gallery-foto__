<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';

    protected $fillable = [
        'NamaAlbum',
        'Deskripsi',
        'cover_image',
        'TanggalDibuat',
        'user_id',
        'category_id', // Pastikan ini ada di sini
    ];

    protected $dates = ['TanggalDibuat'];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan model Foto
    public function photos()
    {
        return $this->hasMany(Foto::class);
    }

    // Accessor untuk format tanggal
    public function getTanggalDibuatAttribute($value)
    {
        return $value ? $this->asDateTime($value)->format('Y-m-d H:i:s') : null;
    }

    // public function category(Category $category)
    // {
    //     $albums = $category->albums;
    //     return view('albums.index', compact('albums', 'category'));
    // }
    // Album.php (Model)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    // // Mutator untuk menyimpan tanggal sebagai objek Carbon
    // public function setTanggalDibuatAttribute($value)
    // {
    //     $this->attributes['TanggalDibuat'] = $value ? $this->fromDateTime($value) : null;
    // }

    // // Accessor untuk cover image
    // public function getCoverImageAttribute($value)
    // {
    //     return $value ? asset('storage/' . $value) : null;
    // }
}
