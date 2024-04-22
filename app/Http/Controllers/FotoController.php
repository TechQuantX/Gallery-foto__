<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use App\Models\KomentarFoto;
use App\Models\LikeFoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index()
    {
        $photos = Foto::with('album:id,NamaAlbum', 'user:id,nama_lengkap')->get();
        return view('photos.index', compact('photos'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        try {
            $photo = Foto::findOrFail($id);
            return view('photos.show', compact('photo'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('photos.index')->with('error', 'Photo not found');
        }
    }

    public function create()
    {
        $user = Auth::user();
        $albums = $user->albums;
        $users = User::where('id', $user->id)->get();

        // Berikan nilai default untuk TanggalUnggah
        $defaultUploadDate = now()->format('Y-m-d\TH:i');

        return view('photos.create', compact('albums', 'users', 'defaultUploadDate'));
    }

    public function edit($id)
    {
        try {
            $photo = Foto::findOrFail($id);
            $users = User::all();
            $albums = Album::all();
            return view('photos.edit', compact('photo', 'users', 'albums'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('photos.index')->with('error', 'Photo not found');
        }
    }
    public function update(Request $request, Foto $photo)
    {
        $this->authorize('update', $photo);

        try {
            $request->validate([
                'JudulFoto' => 'required',
                'DeskripsiFoto' => 'required',
                'TanggalUnggah' => 'date_format:Y-m-d',
                'LokasiFile' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'album_id' => 'required|exists:albums,id',
                'user_id' => 'required|exists:users,id',
            ]);

            $data = [
                'JudulFoto' => $request->input('JudulFoto'),
                'DeskripsiFoto' => $request->input('DeskripsiFoto'),
                'TanggalUnggah' => $request->input('TanggalUnggah'),
                // ... (set other attributes as needed)
            ];

            if ($request->hasFile('LokasiFile')) {
                $imageName = Crypt::encrypt(time() . '.' . $request->LokasiFile->extension());
                $request->LokasiFile->move(public_path('storage/photos'), $imageName);
                $filePath = 'storage/photos/' . $imageName;
                Storage::delete($photo->LokasiFile); // delete old file
                $data['LokasiFile'] = $filePath;
            }

            $photo->update($data);

            return redirect()->route('photos.show', $photo->id)
                ->with('success', 'Photo updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('photos.index')->with('error', 'Something went wrong.');
        }
    }




    public function store(Request $request)
    {
        try {
            $request->validate([
                'JudulFoto' => 'required',
                'DeskripsiFoto' => 'required',
                'LokasiFile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'album_id' => 'required|exists:albums,id',
                'user_id' => 'required|exists:users,id',
            ]);

            $imageName = Crypt::encrypt(time() . '.' . $request->LokasiFile->extension());
            $request->LokasiFile->move(public_path('storage/photos'), $imageName);
            $filePath = 'storage/photos/' . $imageName;

            $photo = Foto::create([
                'JudulFoto' => $request->JudulFoto,
                'DeskripsiFoto' => $request->DeskripsiFoto,
                'TanggalUnggah' => now()->format('Y-m-d'),
                'album_id' => $request->album_id,
                'user_id' => $request->user_id,
                'LokasiFile' => $filePath,
            ]);

            return redirect()->route('photos.index')->with('success', 'Foto berhasil dibuat');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('photos.index')->with('error', 'Terjadi kesalahan.');
        }
    }


    public function destroy($id)
    {
        try {
            $photo = Foto::findOrFail($id);
            $user = Auth::user();

            if ($user->id !== $photo->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to perform this action.');
            }

            Storage::disk('public')->delete($photo->LokasiFile);
            $photo->delete();

            return redirect()->route('photos.index')->with('success', 'Photo deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('photos.index')->with('error', 'Photo not found');
        } catch (\Exception $e) {
            return redirect()->route('photos.index')->with('error', 'Something went wrong.');
        }
    }

    public function addComment(Request $request, $fotoId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $user = Auth::user();

        KomentarFoto::create([
            'FotoID' => $fotoId,
            'user_id' => $user->id,
            'isikomentar' => $request->input('comment'),
            'TanggalKomentar' => now(),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function deleteComment($commentId)
    {
        try {
            $comment = KomentarFoto::findOrFail($commentId);
            $user = Auth::user();

            if ($user->id !== $comment->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to perform this action.');
            }

            $comment->delete();

            return redirect()->back()->with('success', 'Comment deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Comment not found');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }


    public function addLike($fotoId)
    {
        $user = Auth::user();

        $existingLike = LikeFoto::where('FotoID', $fotoId)->where('UserID', $user->id)->first();

        if (!$existingLike) {
            LikeFoto::create([
                'FotoID' => $fotoId,
                'UserID' => $user->id,
                'TanggalLike' => now(),
            ]);

            return redirect()->back()->with('success', 'Liked successfully');
        }

        return redirect()->back()->with('error', 'You have already liked this photo');
    }

    public function unlikePhoto($id)
    {
        try {
            $photo = Foto::findOrFail($id);

            // Pastikan bahwa pengguna telah menyukai foto sebelumnya
            $like = LikeFoto::where('FotoID', $photo->id)
                ->where('UserID', auth()->id())
                ->first();

            if ($like) {
                $like->delete();
                return redirect()->back()->with('success', 'You unliked the photo.');
            } else {
                return redirect()->back()->with('error', 'You have not liked this photo.');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('photos.index')->with('error', 'Photo not found');
        }
    }
}
