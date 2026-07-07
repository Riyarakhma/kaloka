@extends('layouts.admin')

@section('judul', 'Profil Saya')

@section('konten')
    <h1 class="h4 mb-3">Profil Saya</h1>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="row g-4">
        {{-- Data profil --}}
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white"><strong>Data Akun</strong></div>
                <div class="card-body">
                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $pengguna->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $pengguna->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Peran</label>
                            <input type="text" class="form-control" value="{{ $pengguna->labelPeran() }}" disabled>
                            <div class="form-text">Peran hanya dapat diubah oleh admin.</div>
                        </div>
                        <button class="btn btn-kaloka"><i class="bi bi-save me-1"></i>Simpan Profil</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Ganti kata sandi --}}
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white"><strong>Ganti Kata Sandi</strong></div>
                <div class="card-body">
                    <form action="{{ route('profil.sandi') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Kata Sandi Lama</label>
                            <input type="password" name="sandi_lama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kata Sandi Baru</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button class="btn btn-kaloka"><i class="bi bi-key me-1"></i>Ubah Kata Sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
