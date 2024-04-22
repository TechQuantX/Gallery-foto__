<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    // app\Http\Controllers\AccountController.php

    public function showAccount()
    {
        return view('account.index');
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'NamaAlbum' => 'required|max:255',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $album->update($request->only('NamaAlbum'));

        return redirect()->route('albums.show', $album->id)
            ->with('success', 'Album updated successfully.');
    }
}
