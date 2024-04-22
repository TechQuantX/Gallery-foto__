<?php

namespace App\Models;

use App\Models\Foto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    public function unlikePhoto($id)
    {
        $photo = Foto::findOrFail($id);
        $user = Auth::user();

        $like = Like::where('FotoID', $photo->id)
            ->where('UserID', $user->id)
            ->first();

        if ($like) {
            $like->unlike();
            return redirect()->route('photos.show', $photo->id)->with('success', 'Photo unliked successfully');
        } else {
            return redirect()->route('photos.show', $photo->id)->with('error', 'You have not liked this photo');
        }
    }
}
