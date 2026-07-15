<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Beranda') — KALOKA Perpustakaan Desa Sobokerto</title>

    {{-- Bootstrap 5 & ikon via CDN (tanpa proses build, mudah di-deploy) --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/kaloka.css') }}" rel="stylesheet">

    {{-- Open Graph / preview saat dibagikan ke WhatsApp & medsos --}}
    <meta property="og:site_name" content="{{ $situs['nama'] ?? 'KALOKA' }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_judul', ($situs['nama'] ?? 'KALOKA — Perpustakaan Desa Sobokerto'))">
    <meta property="og:description" content="@yield('og_deskripsi', 'Portal Kearifan dan Literasi Lokal Desa Sobokerto, kawasan Waduk Cengklik.')">
    <meta property="og:image" content="@yield('og_gambar', ($situs['logo'] ?? asset('favicon.svg')))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="description" content="@yield('og_deskripsi', 'Portal Kearifan dan Literasi Lokal Desa Sobokerto, kawasan Waduk Cengklik.')">
    <meta name="twitter:card" content="summary_large_image">
    @stack('gaya')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- ====== Navbar Publik ====== --}}
    <nav class="navbar navbar-expand-lg navbar-kaloka shadow-sm">
        <div class="container">
            <a class="navbar-brand navbar-brand-logo d-flex align-items-center" href="{{ route('beranda') }}">
                @if (!empty($situs['logo']))
                    <img src="{{ $situs['logo'] }}" alt="{{ $situs['nama'] ?? 'KALOKA' }}" style="height:36px;" class="me-2">
                @else
                    <i class="bi bi-book-half me-1"></i>
                @endif
                KALOKA
                <span class="d-none d-sm-inline fw-normal fs-6 ms-1">— Perpustakaan Desa Sobokerto</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUtama"
                    aria-controls="navUtama" aria-expanded="false" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navUtama">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $situs['url_opac'] ?? '#' }}" target="_blank" rel="noopener">
                            <i class="bi bi-search me-1"></i>Katalog (SLiMS)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kearifan.index') }}"><i class="bi bi-bank me-1"></i>Kearifan Lokal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('wisata.index') }}"><i class="bi bi-geo-alt me-1"></i>Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ====== Konten ====== --}}
    <main class="container my-4 flex-grow-1">
        @if (session('sukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif
        @yield('konten')
    </main>

    {{-- ====== Footer ====== --}}
    <footer class="footer-kaloka mt-auto py-4">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-6">
                    <h5 class="mb-1"><i class="bi bi-book-half me-1"></i>{{ $situs['nama'] ?? 'KALOKA' }}</h5>
                    <p class="mb-0 small">Kearifan dan Literasi Lokal Desa — Perpustakaan Desa Sobokerto,
                        Kec. Ngemplak, Kab. Boyolali (kawasan Waduk Cengklik).</p>
                </div>
                <div class="col-md-6 text-md-end small">
                    @if (!empty($situs['kontak']))
                        <p class="mb-1"><i class="bi bi-geo-alt me-1"></i>{{ $situs['kontak'] }}</p>
                    @endif
                    <p class="mb-1">Dikembangkan melalui KKN Tematik.</p>
                    <p class="mb-0">&copy; {{ date('Y') }} Perpustakaan Desa Sobokerto.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('skrip')
</body>
</html>
