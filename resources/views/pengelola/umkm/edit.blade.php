@extends('layouts.admin')

@section('judul', 'Ubah UMKM')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Ubah UMKM — {{ $entri->nama_umkm }}</h1>
        <a href="{{ route('pengelola.umkm.show', $entri) }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="formUmkm" action="{{ route('pengelola.umkm.update', $entri) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('pengelola.umkm._form')
                <div class="mt-4">
                    <button type="submit" class="btn btn-kaloka">
                        <i class="bi bi-save me-1"></i>Perbarui UMKM
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection