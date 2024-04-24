<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        // Tambahkan logika tampilan profil atau kembalikan data profil pengguna
        return view('user.profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'old_password' => 'nullable|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:255', // Validasi untuk nomor HP
            'foto' => 'nullable|image|max:2048', // Validasi untuk foto
        ]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->alamat = $request->alamat;
        $user->nomor_hp = $request->nomor_hp; // Simpan nomor HP yang baru

        // Simpan foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads'), $nama_foto);
            $user->foto = $nama_foto;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
