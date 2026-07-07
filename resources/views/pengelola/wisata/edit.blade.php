@extends('layouts.admin')

@section('judul', 'Ubah Wisata')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Ubah Spot — {{ $wisata->nama_spot }}</h1>
        <a href="{{ route('pengelola.wisata.show', $wisata) }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengelola.wisata.update', $wisata) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('pengelola.wisata._form')
                <div class="mt-4">
                    <button class="btn btn-kaloka"><i class="bi bi-save me-1"></i>Perbarui</button>
                </div>
            </form>

            @if ($wisata->foto)
                <hr>
                <h2 class="h6">Kelola Foto</h2>
                <div class="d-flex flex-wrap gap-3">
                    @foreach ($wisata->urlFoto() as $i => $url)
                        <div class="text-center">
                            <img src="{{ $url }}" style="height:90px;width:120px;object-fit:cover;border-radius:.4rem;">
                            <form action="{{ route('pengelola.wisata.foto.hapus', $wisata) }}" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')">
                                @csrf @method('DELETE')
                                <input type="hidden" name="index" value="{{ $i }}">
                                <button class="btn btn-sm btn-outline-danger mt-1"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
