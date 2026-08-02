<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('judul', 'Masuk') — {{ $situs['nama'] ?? 'KALOKA' }}
    </title>

    {{-- Bootstrap 5 dan ikon --}}
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

    <style>
        .logo-app {
            width: 42px;
            height: 42px;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            display: block;
            flex-shrink: 0;
        }

        .logo-app-fallback {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .navbar-brand-logo {
            min-width: 0;
        }

        @media (max-width: 575.98px) {
            .logo-app,
            .logo-app-fallback {
                width: 38px;
                height: 38px;
                border-radius: 9px;
            }
        }
    </style>

    @stack('gaya')
</head>

<body class="d-flex flex-column min-vh-100">
    <div
        id="app"
        class="d-flex flex-column min-vh-100 w-100"
    >
        <nav class="navbar navbar-expand-md navbar-kaloka shadow-sm">
            <div class="container">
                <a
                    class="navbar-brand navbar-brand-logo d-flex align-items-center"
                    href="{{ url('/') }}"
                >
                    @if (!empty($situs['logo']))
                        <img
                            src="{{ $situs['logo'] }}"
                            alt="{{ $situs['nama'] ?? 'KALOKA' }}"
                            class="logo-app me-2"
                        >
                    @else
                        <span
                            class="logo-app-fallback me-2"
                            aria-hidden="true"
                        >
                            <i class="bi bi-book-half"></i>
                        </span>
                    @endif

                    <span class="fw-bold">
                        {{ $situs['nama'] ?? 'KALOKA' }}
                    </span>
                </a>

                @auth
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarUtama"
                        aria-controls="navbarUtama"
                        aria-expanded="false"
                        aria-label="Buka menu"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div
                        class="collapse navbar-collapse"
                        id="navbarUtama"
                    >
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="{{ route('dashboard') }}"
                                >
                                    <i class="bi bi-speedometer2 me-1"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a
                                    id="navbarDropdown"
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ Auth::user()->name }}
                                </a>

                                <div
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="navbarDropdown"
                                >
                                    <span class="dropdown-item-text small text-muted">
                                        {{ Auth::user()->labelPeran() }}
                                    </span>

                                    <div class="dropdown-divider"></div>

                                    <a
                                        class="dropdown-item"
                                        href="{{ route('profil.edit') }}"
                                    >
                                        <i class="bi bi-person-gear me-1"></i>
                                        Profil Saya
                                    </a>

                                    <a
                                        class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="
                                            event.preventDefault();
                                            document.getElementById('logout-form').submit();
                                        "
                                    >
                                        <i class="bi bi-box-arrow-right me-1"></i>
                                        Keluar
                                    </a>

                                    <form
                                        id="logout-form"
                                        action="{{ route('logout') }}"
                                        method="POST"
                                        class="d-none"
                                    >
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>

        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>

        <footer class="footer-kaloka py-3 mt-auto">
            <div class="container text-center small">
                {{ $situs['nama'] ?? 'KALOKA' }}
                — Portal Literasi Desa Sobokerto
                &copy; {{ date('Y') }}
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('skrip')
</body>
</html>