@extends('layouts.publik')

@section('judul', $entri->judul)
@section('og_judul', $entri->judul)
@section('og_deskripsi', \Illuminate\Support\Str::limit(strip_tags($entri->deskripsi), 150))
@section('og_gambar', ($entri->jenis_media === 'Foto' && $entri->urlMedia()) ? $entri->urlMedia() : ($situs['logo'] ?? asset('favicon.svg')))

@section('konten')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kearifan.index') }}">Kearifan Lokal</a></li>
            <li class="breadcrumb-item active">{{ $entri->kode_entri }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-8">
            <h1 class="h3">{{ $entri->judul }}</h1>
            <p class="mb-3">
                <span class="badge badge-dimensi text-white">{{ $entri->dimensi }}</span>
                <span class="badge bg-secondary">{{ $entri->jenis_media }}</span>
            </p>

            {{-- Media --}}
            @if ($entri->berkas_media)
                <div class="mb-4">
                    @switch ($entri->jenis_media)
                        @case('Foto')
                            <img src="{{ $entri->urlMedia() }}" class="img-fluid rounded shadow-sm" alt="{{ $entri->judul }}">
                            @break
                        @case('Audio')
                            <audio controls class="w-100"><source src="{{ $entri->urlMedia() }}"></audio>
                            @break
                        @case('Video')
                            <video controls class="w-100 rounded shadow-sm"><source src="{{ $entri->urlMedia() }}"></video>
                            @break
                        @default
                            <a href="{{ $entri->urlMedia() }}" target="_blank" class="btn btn-outline-kaloka">
                                <i class="bi bi-download me-1"></i>Unduh Berkas
                            </a>
                    @endswitch
                </div>
            @endif

            <article style="white-space:pre-line">{{ $entri->deskripsi }}</article>

            @if ($entri->daftarKataKunci())
                <div class="mt-4">
                    @foreach ($entri->daftarKataKunci() as $k)
                        <span class="badge bg-light text-dark border">#{{ $k }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Informasi</strong></div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item"><strong>Narasumber:</strong> {{ $entri->narasumber ?: '—' }}</li>
                    <li class="list-group-item"><strong>Lokasi:</strong> {{ $entri->lokasi ?: '—' }}</li>
                    <li class="list-group-item"><strong>Bahasa:</strong> {{ $entri->bahasa ?: '—' }}</li>
                    <li class="list-group-item"><strong>Tanggal:</strong>
                        {{ $entri->tanggal_dokumentasi?->format('d M Y') ?: '—' }}</li>
                    <li class="list-group-item"><strong>Sumber:</strong> {{ $entri->sumber ?: '—' }}</li>
                </ul>
            </div>
            <a href="{{ route('kearifan.index') }}" class="btn btn-outline-kaloka w-100 mt-3">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection
