@extends('layouts.admin')

@section('judul', $entri->nama_umkm)

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h4 mb-0">{{ $entri->nama_umkm }}</h1>
        <div class="text-nowrap">
            <a href="{{ route('pengelola.umkm.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Daftar
            </a>
            <a href="{{ route('pengelola.umkm.edit', $entri) }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Ubah
            </a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-2">
                        <span class="badge bg-secondary">{{ $entri->kategori }}</span>
                        @if ($entri->status_tampil)
                            <span class="badge bg-success">Tampil publik</span>
                        @else
                            <span class="badge bg-secondary">Disembunyikan</span>
                        @endif
                    </p>

                    <p style="white-space:pre-line">{{ $entri->deskripsi }}</p>

                    @if ($entri->foto)
                        <div class="d-flex flex-wrap gap-3 mt-3">
                            @foreach ($entri->urlFoto() as $url)
                                <img src="{{ $url }}" alt="{{ $entri->nama_umkm }}" class="rounded border"
                                     style="width:160px;height:120px;object-fit:cover;">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Metadata</strong></div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item"><strong>Pemilik:</strong> {{ $entri->pemilik }}</li>
                    <li class="list-group-item"><strong>Alamat:</strong> {{ $entri->alamat }}</li>
                    <li class="list-group-item"><strong>Kontak:</strong> {{ $entri->kontak ?: '—' }}</li>
                    <li class="list-group-item"><strong>Dibuat:</strong> {{ $entri->created_at?->format('d M Y') ?? '—' }}</li>
                </ul>
                @if ($entri->status_tampil)
                    <div class="alert alert-success small m-3 mb-0">
                        <i class="bi bi-globe me-1"></i>
                        <a href="{{ route('umkm.show', $entri) }}" target="_blank">Lihat halaman publik</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection