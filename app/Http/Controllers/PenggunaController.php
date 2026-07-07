<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::orderBy('role')->orderBy('name')->paginate(10);
        return view('pengelola.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('pengelola.pengguna.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'role'     => ['required', Rule::in(['admin', 'pengelola'])],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], $this->pesan(), $this->atribut());

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('pengelola.pengguna.index')
            ->with('sukses', "Pengguna \"{$data['name']}\" berhasil ditambahkan.");
    }

    public function edit(User $pengguna)
    {
        return view('pengelola.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, User $pengguna)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($pengguna->id)],
            'role'     => ['required', Rule::in(['admin', 'pengelola'])],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ], $this->pesan(), $this->atribut());

        // Cegah admin menurunkan perannya sendiri menjadi pengelola (agar tidak terkunci).
        if ($pengguna->id === $request->user()->id && $data['role'] !== 'admin') {
            return back()->withInput()
                ->withErrors(['role' => 'Anda tidak dapat menurunkan peran akun Anda sendiri.']);
        }

        if (! empty($data['password'])) {
            $pengguna->password = Hash::make($data['password']);
        }
        unset($data['password']);
        $pengguna->fill($data)->save();

        return redirect()->route('pengelola.pengguna.index')
            ->with('sukses', "Pengguna \"{$pengguna->name}\" berhasil diperbarui.");
    }

    public function destroy(Request $request, User $pengguna)
    {
        if ($pengguna->id === $request->user()->id) {
            return back()->withErrors(['hapus' => 'Anda tidak dapat menghapus akun Anda sendiri.']);
        }

        $nama = $pengguna->name;
        $pengguna->delete();

        return redirect()->route('pengelola.pengguna.index')
            ->with('sukses', "Pengguna \"{$nama}\" berhasil dihapus.");
    }

    private function pesan(): array
    {
        return [
            'required'  => 'Kolom :attribute wajib diisi.',
            'email'     => 'Format email tidak valid.',
            'unique'    => 'Email sudah digunakan.',
            'confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'min'       => 'Kata sandi minimal 8 karakter.',
        ];
    }

    private function atribut(): array
    {
        return ['name' => 'nama', 'email' => 'email', 'role' => 'peran', 'password' => 'kata sandi'];
    }
}
