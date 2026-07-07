<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('judul', 'Masuk') — KALOKA Perpustakaan Desa Sobokerto</title>

    {{-- Bootstrap 5 & ikon via CDN (tanpa proses build, mudah di-deploy) --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/kaloka.css') }}" rel="stylesheet">
    @stack('gaya')
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column min-vh-100 w-100">
        <nav class="navbar navbar-expand-md navbar-kaloka shadow-sm">
            <div class="container">
                <a class="navbar-brand navbar-brand-logo d-flex align-items-center" href="{{ url('/') }}">
                    @if (!empty($situs['logo']))
                        <img src="{{ $situs['logo'] }}" alt="{{ $situs['nama'] ?? 'KALOKA' }}" style="height:34px;" class="me-2">
                    @else
                        <i class="bi bi-book-half me-1"></i>
                    @endif
                    KALOKA
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarUtama" aria-controls="navbarUtama"
                        aria-expanded="false" aria-label="Buka menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarUtama">
                    <ul class="navbar-nav ms-auto">
                        {{-- Registrasi publik dinonaktifkan: tidak ada tautan daftar. --}}
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <span class="dropdown-item-text small text-muted">
                                        {{ Auth::user()->labelPeran() }}
                                    </span>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('profil.edit') }}">
                                        <i class="bi bi-person-gear me-1"></i>Profil Saya
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-1"></i>Keluar
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>

        <footer class="footer-kaloka py-3 mt-auto">
            <div class="container text-center small">
                KALOKA — Perpustakaan Desa Sobokerto &copy; {{ date('Y') }}
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('skrip')
</body>
</html>
