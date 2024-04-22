<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\Album;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap',
        'alamat',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
    // User.php (Model)


    public function likes()
    {
        return $this->hasMany(LikeFoto::class);
    }


    public static function rules()
    {
        return [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ];
    }


    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }

    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];
}
