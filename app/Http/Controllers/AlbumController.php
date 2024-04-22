<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class AlbumController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->has('category')) {
            $category = Category::find($request->category);

            if (!$category) {
                return redirect()->route('albums.index')->with('error', 'Selected category not found');
            }

            $albums = $category->albums;
        } else {
            $category = null;
            $albums = Album::all();
        }

        return view('albums.index', compact('albums', 'categories', 'category'));
    }


    public function show($id)
    {
        $album = Album::findOrFail($id);

        // Jika album terkunci dan tidak ada sesi yang menyatakan album sudah terbuka, arahkan ke halaman unlock
        if ($album->locked && !session('unlocked_album_' . $id)) {
            return redirect()->route('albums.unlock', $album->id);
        }

        // Jika album tidak terkunci atau album sudah terbuka, lanjutkan ke tampilan album
        return view('albums.show', compact('album'));
    }


    // Tambahkan metode baru untuk mengarahkan kembali ke daftar album
    public function redirectToAlbums()
    {
        return redirect()->route('albums.index');
    }


    public function edit(Album $album)
    {
        $categories = Category::all();

        return view('albums.edit', compact('album', 'categories'));
    }

    public function update(Request $request, Album $album)
    {
        $this->authorize('update', $album);

        $request->validate([
            'NamaAlbum' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'category_id' => 'required',
        ]);

        $data = [
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'category_id' => $request->category_id,
        ];

        // Periksa apakah input password diisi, jika iya, tambahkan ke data yang akan diupdate
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $album->update($data);

        // Proses upload cover image jika ada
        if ($request->hasFile('cover_image')) {
            // Proses upload cover image disini
            $imageName = time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('storage'), $imageName);
            $album->cover_image = $imageName;
            $album->save();
        }

        return redirect()->route('account.index', $album->id)->with('success', 'Album updated successfully');
    }


    public function destroy(Album $album)
    {
        $this->authorize('delete', $album);

        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully');
    }

    public function create()
    {
        $categories = Category::all();
        return view('albums.create', compact('categories'));
    }


    public function category(Category $category)
    {
        $albums = Album::where('category_id', $category->id)->get();
        return view('albums.index', ['albums' => $albums, 'category' => $category]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaAlbum' => 'required',
            'Deskripsi' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'category_id' => 'required',
        ], [
            'cover_image.required' => 'The cover image is required.',
            'cover_image.image' => 'The file must be an image.',
            'cover_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'cover_image.max' => 'The image may not be greater than 10 megabytes.',
        ]);

        $imageName = time() . '.' . $request->cover_image->extension();
        $request->cover_image->move(public_path('storage'), $imageName);

        $album = Album::create([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'cover_image' => $imageName,
            'TanggalDibuat' => now(),
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('albums.index')->with('success', 'Album created successfully');
    }
}
