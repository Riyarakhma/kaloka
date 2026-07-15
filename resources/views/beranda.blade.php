@extends('layouts.publik')

@section('judul', 'Beranda')

@section('konten')
  {{-- ===== Hero / Header penyatu ===== --}}
<section class="hero-kaloka p-4 p-md-5 mb-5">
    <div class="row align-items-center">

        <div class="col-lg-7">
            <h1 class="fw-bold display-3 mb-3">
                {{ $situs['nama'] ?? 'KALOKA — Perpustakaan Desa Sobokerto' }}
            </h1>

            <p class="lead mb-4">
                {{ $situs['sambutan'] ?? 'Selamat datang di portal Kearifan dan Literasi Lokal Desa Sobokerto.' }}
            </p>

        <form action="{{ route('cari') }}" method="GET" class="search-box mt-4">

    <i class="bi bi-search search-icon"></i>

    <input
        type="text"
        name="q"
        placeholder="Cari koleksi, kearifan lokal, wisata..."
    >

    <button type="submit">
        Cari
    </button>

</form>

            <small class="text-white opacity-75">
                Satu pencarian untuk katalog pustaka, kearifan lokal, & wisata sekaligus.
            </small>

        </div>

        <div class="col-lg-5 d-none d-lg-flex justify-content-center">
            <i class="bi bi-book-half hero-book"></i>
        </div>

    </div>
</section>

    {{-- ===== Dua layanan utama (custom KALOKA) ===== --}}
    <h2 class="h4 mb-3 text-center">Akses Layanan</h2>
    <div class="row g-4 mb-5 justify-content-center">
        <div class="col-sm-6 col-lg-6">
            <a href="{{ route('kearifan.index') }}" class="text-decoration-none text-dark">
                <div class="card kartu-menu shadow-sm text-center p-4 h-100">
                    <div class="ikon mb-2"><i class="bi bi-bank"></i></div>
                    <h3 class="h5 mb-1">Kearifan Lokal</h3>
                    <p class="small text-muted mb-0">Repositori warisan, tradisi & budaya desa.</p>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-6">
            <a href="{{ route('wisata.index') }}" class="text-decoration-none text-dark">
                <div class="card kartu-menu shadow-sm text-center p-4 h-100">
                    <div class="ikon mb-2"><i class="bi bi-geo-alt"></i></div>
                    <h3 class="h5 mb-1">Info Wisata</h3>
                    <p class="small text-muted mb-0">Pesona Waduk Cengklik & potensi wisata desa.</p>
                </div>
            </a>
        </div>
    </div>

    {{-- ===== Cuplikan Kearifan Lokal terbaru ===== --}}
    @if ($kearifanTerbaru->isNotEmpty())
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 mb-0"><i class="bi bi-bank me-2"></i>Kearifan Lokal Terbaru</h2>
            <a href="{{ route('kearifan.index') }}" class="btn btn-sm btn-outline-kaloka">Lihat semua</a>
        </div>
        <div class="row g-4 mb-5">
            @foreach ($kearifanTerbaru as $e)
                <div class="col-sm-6 col-lg-4">
                    <a href="{{ route('kearifan.show', $e) }}" class="text-decoration-none text-dark">
                        <div class="card kartu-menu shadow-sm h-100">
                            @if ($e->jenis_media === 'Foto' && $e->urlMedia())
                                <img src="{{ $e->urlMedia() }}" class="card-img-top" style="height:150px;object-fit:cover;border-radius:1rem 1rem 0 0;">
                            @endif
                            <div class="card-body">
                                <span class="badge badge-dimensi text-white mb-2">{{ $e->dimensi }}</span>
                                <h3 class="h6">{{ $e->judul }}</h3>
                                <p class="small text-muted mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($e->deskripsi), 80) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ===== Cuplikan Wisata ===== --}}
    @if ($wisataTerbaru->isNotEmpty())
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 mb-0"><i class="bi bi-geo-alt me-2"></i>Jelajah Wisata</h2>
            <a href="{{ route('wisata.index') }}" class="btn btn-sm btn-outline-kaloka">Lihat semua</a>
        </div>
        <div class="row g-4 mb-4">
            @foreach ($wisataTerbaru as $w)
                <div class="col-sm-6 col-lg-4">
                    <a href="{{ route('wisata.show', $w) }}" class="text-decoration-none text-dark">
                        <div class="card kartu-menu shadow-sm h-100">
                            @if ($w->fotoUtama())
                                <img src="{{ $w->fotoUtama() }}" class="card-img-top" style="height:150px;object-fit:cover;border-radius:1rem 1rem 0 0;">
                            @endif
                            <div class="card-body">
                                <span class="badge bg-{{ $w->warnaKategori() }} mb-2">{{ $w->kategori }}</span>
                                <h3 class="h6">{{ $w->nama_spot }}</h3>
                                <p class="small text-muted mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($w->deskripsi), 80) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endsection