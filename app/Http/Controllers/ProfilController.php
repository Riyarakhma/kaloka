<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    /** Form profil pengguna yang sedang login. */
    public function edit(Request $request)
    {
        return view('pengelola.profil.edit', ['pengguna' => $request->user()]);
    }

    /** Perbarui nama/email dan (opsional) kata sandi sendiri. */
    public function update(Request $request)
    {
        $pengguna = $request->user();

        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($pengguna->id)],
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'email'    => 'Format email tidak valid.',
            'unique'   => 'Email sudah digunakan.',
        ], ['name' => 'nama', 'email' => 'email']);

        $pengguna->fill($data)->save();

        return back()->with('sukses', 'Profil berhasil diperbarui.');
    }

    /** Ubah kata sandi sendiri (memerlukan kata sandi lama). */
    public function ubahSandi(Request $request)
    {
        $request->validate([
            'sandi_lama' => ['required', 'current_password'],
            'password'   => ['required', 'confirmed', Password::min(8)],
        ], [
            'sandi_lama.required'      => 'Kata sandi lama wajib diisi.',
            'sandi_lama.current_password' => 'Kata sandi lama tidak cocok.',
            'password.required'        => 'Kata sandi baru wajib diisi.',
            'password.confirmed'       => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'             => 'Kata sandi baru minimal 8 karakter.',
        ]);

        $request->user()->update(['password' => Hash::make($request->password)]);

        return back()->with('sukses', 'Kata sandi berhasil diubah.');
    }
}
