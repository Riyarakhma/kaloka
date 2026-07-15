@extends('layouts.publik')

@section('judul', $q !== '' ? 'Pencarian: ' . $q : 'Pencarian')

@section('konten')
    {{-- Kotak pencarian terpadu --}}
    <section class="hero-kaloka p-4 p-md-5 mb-4">
        <h1 class="h3 fw-bold mb-1"><i class="bi bi-search me-2"></i>Pencarian Terpadu</h1>
        <p class="mb-3 opacity-75">Satu pencarian untuk Katalog Pustaka, Kearifan Lokal, dan Wisata.</p>
        <form action="{{ route('cari') }}" method="GET" class="row g-2">
            <div class="col-md-9 col-lg-8">
                <input type="text" name="q" value="{{ $q }}" autofocus
                       class="form-control form-control-lg" placeholder="Ketik kata kunci...">
            </div>
            <div class="col-md-3 col-lg-2 d-grid">
                <button class="btn btn-light btn-lg text-success fw-semibold">
                    <i class="bi bi-search me-1"></i>Cari
                </button>
            </div>
        </form>
    </section>

    @php
        $totalLokal = $kearifan->count() + $wisata->count();
        $totalKatalog = count($katalog);
    @endphp

    @if ($q === '')
        <div class="alert alert-info">Masukkan kata kunci untuk mulai mencari.</div>
    @else
        <p class="text-muted">
            Hasil untuk <strong>"{{ $q }}"</strong>:
            {{ $totalKatalog }} koleksi pustaka, {{ $kearifan->count() }} kearifan lokal, {{ $wisata->count() }} wisata.
        </p>

        {{-- ===== Katalog SLiMS ===== --}}
        <h2 class="h5 mt-4 mb-3"><i class="bi bi-book me-2"></i>Katalog Pustaka (SLiMS)</h2>
        @if ($totalKatalog > 0)
            <div class="list-group mb-2 shadow-sm">
                @foreach ($katalog as $k)
                    <a href="{{ $urlOpac }}/index.php?p=show_detail&id={{ $k['id'] }}" target="_blank" rel="noopener"
                       class="list-group-item list-group-item-action d-flex gap-3 align-items-center">
                        @if (!empty($k['sampul']))
                            <img src="{{ $urlOpac }}/images/docs/{{ $k['sampul'] }}" alt=""
                                 style="height:54px;width:40px;object-fit:cover;border-radius:.25rem;">
                        @else
                            <i class="bi bi-book text-success fs-3"></i>
                        @endif
                        <span>
                            <span class="fw-semibold d-block">{{ $k['judul'] }}</span>
                            <small class="text-muted">
                                {{ $k['pengarang'] ?: 'Pengarang tidak diketahui' }}{{ $k['tahun'] ? ' · ' . $k['tahun'] : '' }}
                            </small>
                        </span>
                        <i class="bi bi-box-arrow-up-right ms-auto text-muted"></i>
                    </a>
                @endforeach
            </div>
            @if ($urlOpac)
                <a href="{{ $urlOpac }}/index.php?keywords={{ urlencode($q) }}" target="_blank" rel="noopener"
                   class="btn btn-sm btn-outline-kaloka mb-2">
                    Lihat semua hasil di Katalog SLiMS <i class="bi bi-arrow-right ms-1"></i>
                </a>
            @endif
        @else
            <p class="text-muted small">
                Tidak ada koleksi cocok di katalog.
                @if ($urlOpac)
                    <a href="{{ $urlOpac }}/index.php?keywords={{ urlencode($q) }}" target="_blank" rel="noopener">Telusuri langsung di SLiMS</a>.
                @endif
            </p>
        @endif

        {{-- ===== Kearifan Lokal ===== --}}
        <h2 class="h5 mt-4 mb-3"><i class="bi bi-bank me-2"></i>Kearifan Lokal</h2>
        @if ($kearifan->isNotEmpty())
            <div class="row g-3">
                @foreach ($kearifan as $e)
                    <div class="col-sm-6 col-lg-4">
                        <a href="{{ route('kearifan.show', $e) }}" class="text-decoration-none text-dark">
                            <div class="card kartu-menu shadow-sm h-100">
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
        @else
            <p class="text-muted small">Tidak ada entri kearifan lokal yang cocok.</p>
        @endif

        {{-- ===== Wisata ===== --}}
        <h2 class="h5 mt-4 mb-3"><i class="bi bi-geo-alt me-2"></i>Info Wisata</h2>
        @if ($wisata->isNotEmpty())
            <div class="row g-3">
                @foreach ($wisata as $w)
                    <div class="col-sm-6 col-lg-4">
                        <a href="{{ route('wisata.show', $w) }}" class="text-decoration-none text-dark">
                            <div class="card kartu-menu shadow-sm h-100">
                                @if ($w->fotoUtama())
                                    <img src="{{ $w->fotoUtama() }}" class="card-img-top" style="height:130px;object-fit:cover;border-radius:1rem 1rem 0 0;">
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
        @else
            <p class="text-muted small">Tidak ada wisata yang cocok.</p>
        @endif
    @endif
@endsection
