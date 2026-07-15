@extends('layouts.admin')

@section('judul', 'Tambah Kearifan Lokal')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Tambah Entri Kearifan Lokal</h1>
        <a href="{{ route('pengelola.kearifan.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengelola.kearifan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('pengelola.kearifan._form')
                <div class="mt-4">
                    <button type="submit" class="btn btn-kaloka">
                        <i class="bi bi-save me-1"></i>Simpan Entri
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
