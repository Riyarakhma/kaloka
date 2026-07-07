@extends('layouts.admin')

@section('judul', 'Ubah Kearifan Lokal')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Ubah Entri — {{ $entri->kode_entri }}</h1>
        <a href="{{ route('pengelola.kearifan.show', $entri) }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengelola.kearifan.update', $entri) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('pengelola.kearifan._form')
                <div class="mt-4">
                    <button type="submit" class="btn btn-kaloka">
                        <i class="bi bi-save me-1"></i>Perbarui Entri
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
