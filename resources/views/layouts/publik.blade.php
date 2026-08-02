<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('judul', 'Beranda') — {{ $situs['nama'] ?? 'KALOKA' }}
    </title>

    {{-- Bootstrap 5 & ikon via CDN --}}
    <link
        rel="icon"
        href="{{ $situs['logo'] ?? asset('favicon.svg') }}"
        type="image/svg+xml"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <link
        href="{{ asset('css/kaloka.css') }}"
        rel="stylesheet"
    >

    {{-- Open Graph / preview saat dibagikan ke WhatsApp & media sosial --}}
    <meta
        property="og:site_name"
        content="{{ $situs['nama'] ?? 'KALOKA' }}"
    >

    <meta
        property="og:type"
        content="website"
    >

    <meta
        property="og:title"
        content="@yield('og_judul', ($situs['nama'] ?? 'KALOKA — Perpustakaan Desa Sobokerto'))"
    >

    <meta
        property="og:description"
        content="@yield('og_deskripsi', 'Portal Kearifan dan Literasi Lokal Desa Sobokerto, kawasan Waduk Cengklik.')"
    >

    <meta
        property="og:image"
        content="@yield('og_gambar', ($situs['logo'] ?? asset('favicon.svg')))"
    >

    <meta
        property="og:url"
        content="{{ url()->current() }}"
    >

    <meta
        name="description"
        content="@yield('og_deskripsi', 'Portal Kearifan dan Literasi Lokal Desa Sobokerto, kawasan Waduk Cengklik.')"
    >

    <meta
        name="twitter:card"
        content="summary_large_image"
    >

    <style>
        /*
         * Ukuran logo dibuat konsisten.
         * object-fit: cover membuat area logo selalu terisi penuh.
         */
        .logo-publik {
            width: 112px;
            height: 112px;
            object-fit: cover;
            object-position: center;
            border-radius: 28px;
            display: block;
            flex-shrink: 0;
        }

        .navbar-brand-logo {
            white-space: normal;
        }

        .navbar-brand-text {
            line-height: 1.15;
        }

        .navbar-brand-title {
            display: block;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .navbar-brand-subtitle {
            display: block;
            margin-top: 0.25rem;
            font-size: 1rem;
            font-weight: 400;
        }

        /*
         * Ukuran lebih kecil di HP agar navbar tidak terlalu tinggi.
         */
        @media (max-width: 575.98px) {
            .logo-publik {
                width: 64px;
                height: 64px;
                border-radius: 16px;
            }

            .navbar-brand-title {
                font-size: 1.3rem;
            }

            .navbar-brand-subtitle {
                display: none;
            }
        }
    </style>

    @stack('gaya')
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- ====== Navbar Publik ====== --}}
    <nav class="navbar navbar-expand-lg navbar-kaloka shadow-sm">
        <div class="container">

            <a
                class="navbar-brand navbar-brand-logo d-flex align-items-center"
                href="{{ route('beranda') }}"
            >
                @if (!empty($situs['logo']))
                    <img
                        src="{{ $situs['logo'] }}"
                        alt="{{ $situs['nama'] ?? 'KALOKA' }}"
                        class="logo-publik me-3"
                    >
                @else
                    <span
                        class="d-inline-flex align-items-center justify-content-center logo-publik me-3"
                        aria-hidden="true"
                    >
                        <i class="bi bi-book-half fs-2"></i>
                    </span>
                @endif

                <span class="navbar-brand-text">
                    <span class="navbar-brand-title">
                        {{ $situs['nama'] ?? 'KALOKA' }}
                    </span>

                    <span class="navbar-brand-subtitle">
                        Portal Literasi Desa Sobokerto
                    </span>
                </span>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navUtama"
                aria-controls="navUtama"
                aria-expanded="false"
                aria-label="Buka menu"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="navUtama"
            >
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ $situs['url_opac'] ?? '#' }}"
                            target="_blank"
                            rel="noopener"
                        >
                            <i class="bi bi-search me-1"></i>
                            Katalog (SLiMS)
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('kearifan.index') }}"
                        >
                            <i class="bi bi-bank me-1"></i>
                            Kearifan Lokal
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('wisata.index') }}"
                        >
                            <i class="bi bi-geo-alt me-1"></i>
                            Wisata
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('login') }}"
                        >
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Login
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    {{-- ====== Konten ====== --}}
    <main class="container my-4 flex-grow-1">

        @if (session('sukses'))
            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ session('sukses') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"
                ></button>
            </div>
        @endif

        @yield('konten')
    </main>

    {{-- ====== Footer ====== --}}
    <footer class="footer-kaloka mt-auto py-4">
        <div class="container">
            <div class="row gy-3">

                <div class="col-md-6">
                    <h5 class="mb-1">
                        <i class="bi bi-book-half me-1"></i>
                        {{ $situs['nama'] ?? 'KALOKA' }}
                    </h5>

                    <p class="mb-0 small">
                        Kearifan dan Literasi Lokal Desa — Perpustakaan Desa Sobokerto,
                        Kec. Ngemplak, Kab. Boyolali (kawasan Waduk Cengklik).
                    </p>
                </div>

                <div class="col-md-6 text-md-end small">

                    @if (!empty($situs['kontak']))
                        <p class="mb-1">
                            <i class="bi bi-geo-alt me-1"></i>
                            {{ $situs['kontak'] }}
                        </p>
                    @endif

                    <p class="mb-1">
                        Dikembangkan melalui KKN Tematik.
                    </p>

                    <p class="mb-0">
                        &copy; {{ date('Y') }} Perpustakaan Desa Sobokerto.
                    </p>

                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('skrip')
</body>
</html>