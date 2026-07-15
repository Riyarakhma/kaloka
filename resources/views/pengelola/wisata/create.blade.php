@extends('layouts.admin')

@section('judul', 'Tambah Wisata')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Tambah Spot Wisata</h1>
        <a href="{{ route('pengelola.wisata.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengelola.wisata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('pengelola.wisata._form')
                <div class="mt-4">
                    <button class="btn btn-kaloka"><i class="bi bi-save me-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
