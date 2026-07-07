@extends('layouts.publik')

@section('judul', $wisata->nama_spot)
@section('og_judul', $wisata->nama_spot)
@section('og_deskripsi', \Illuminate\Support\Str::limit(strip_tags($wisata->deskripsi), 150))
@section('og_gambar', $wisata->fotoUtama() ?? ($situs['logo'] ?? asset('favicon.svg')))

@section('konten')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('wisata.index') }}">Wisata</a></li>
            <li class="breadcrumb-item active">{{ $wisata->nama_spot }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-8">
            <h1 class="h3">{{ $wisata->nama_spot }}</h1>
            <p><span class="badge bg-{{ $wisata->warnaKategori() }}">{{ $wisata->kategori }}</span></p>

            @if ($wisata->foto)
                <div id="galeriWisata" class="carousel slide mb-4 shadow-sm rounded overflow-hidden" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($wisata->urlFoto() as $i => $url)
                            <div class="carousel-item @if($i===0) active @endif">
                                <img src="{{ $url }}" class="d-block w-100" style="height:380px;object-fit:cover;" alt="{{ $wisata->nama_spot }}">
                            </div>
                        @endforeach
                    </div>
                    @if (count($wisata->urlFoto()) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#galeriWisata" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#galeriWisata" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            @endif

            <article style="white-space:pre-line">{{ $wisata->deskripsi }}</article>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Informasi Kunjungan</strong></div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item"><i class="bi bi-geo-alt me-1"></i><strong>Lokasi:</strong> {{ $wisata->lokasi ?: '—' }}</li>
                    <li class="list-group-item"><i class="bi bi-clock me-1"></i><strong>Jam:</strong> {{ $wisata->jam_operasional ?: '—' }}</li>
                    <li class="list-group-item"><i class="bi bi-telephone me-1"></i><strong>Kontak:</strong> {{ $wisata->kontak ?: '—' }}</li>
                    @if ($wisata->koordinat)
                        <li class="list-group-item">
                            <i class="bi bi-pin-map me-1"></i>
                            <a href="https://www.google.com/maps?q={{ $wisata->koordinat }}" target="_blank">Lihat di Peta</a>
                        </li>
                    @endif
                </ul>
            </div>
            <a href="{{ route('wisata.index') }}" class="btn btn-outline-kaloka w-100 mt-3">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection
