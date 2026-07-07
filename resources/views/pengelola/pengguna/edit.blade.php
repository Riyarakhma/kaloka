@extends('layouts.admin')

@section('judul', 'Ubah Pengguna')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Ubah Pengguna — {{ $pengguna->name }}</h1>
        <a href="{{ route('pengelola.pengguna.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengelola.pengguna.update', $pengguna) }}" method="POST">
                @csrf @method('PUT')
                @include('pengelola.pengguna._form')
                <div class="mt-4"><button class="btn btn-kaloka"><i class="bi bi-save me-1"></i>Perbarui</button></div>
            </form>
        </div>
    </div>
@endsection
