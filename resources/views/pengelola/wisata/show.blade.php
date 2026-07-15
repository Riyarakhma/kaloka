@extends('layouts.admin')

@section('judul', $wisata->nama_spot)

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h4 mb-0">{{ $wisata->nama_spot }}</h1>
        <div class="text-nowrap">
            <a href="{{ route('pengelola.wisata.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Daftar</a>
            <a href="{{ route('pengelola.wisata.edit', $wisata) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i>Ubah</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p>
                        <span class="badge bg-{{ $wisata->warnaKategori() }}">{{ $wisata->kategori }}</span>
                        @if ($wisata->status_tampil)
                            <span class="badge bg-success">Tampil publik</span>
                        @else
                            <span class="badge bg-secondary">Disembunyikan</span>
                        @endif
                    </p>
                    @if ($wisata->foto)
                        <div class="row g-2 mb-3">
                            @foreach ($wisata->urlFoto() as $url)
                                <div class="col-4"><img src="{{ $url }}" class="img-fluid rounded"></div>
                            @endforeach
                        </div>
                    @endif
                    <p style="white-space:pre-line">{{ $wisata->deskripsi }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Informasi</strong></div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item"><strong>Lokasi:</strong> {{ $wisata->lokasi ?: '—' }}</li>
                    <li class="list-group-item"><strong>Koordinat:</strong> {{ $wisata->koordinat ?: '—' }}</li>
                    <li class="list-group-item"><strong>Jam:</strong> {{ $wisata->jam_operasional ?: '—' }}</li>
                    <li class="list-group-item"><strong>Kontak:</strong> {{ $wisata->kontak ?: '—' }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
