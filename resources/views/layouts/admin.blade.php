<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Dashboard') — Admin KALOKA</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/kaloka.css') }}" rel="stylesheet">
    @stack('gaya')
</head>
<body>

    {{-- ====== Navbar Admin ====== --}}
    <nav class="navbar navbar-expand-lg navbar-kaloka shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand navbar-brand-logo d-flex align-items-center" href="{{ route('dashboard') }}">
                @if (!empty($situs['logo']))
                    <img src="{{ $situs['logo'] }}" alt="{{ $situs['nama'] ?? 'KALOKA' }}" style="height:32px;" class="me-2">
                @else
                    <i class="bi bi-speedometer2 me-1"></i>
                @endif
                KALOKA
                <span class="d-none d-sm-inline fw-normal fs-6 ms-1">— Perpustakaan Desa Sobokerto</span>
            </a>
            <div class="ms-auto">
                <div class="dropdown">
                    <a href="#" class="text-white text-decoration-none dropdown-toggle d-flex align-items-center"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i>
                        <span class="small">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text small text-muted">{{ auth()->user()->labelPeran() }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('profil.edit') }}"><i class="bi bi-person-gear me-1"></i>Profil Saya</a></li>
                        <li>
                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-admin').submit();">
                                <i class="bi bi-box-arrow-right me-1"></i>Keluar
                            </a>
                            <form id="logout-admin" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            {{-- ====== Sidebar ====== --}}
            <aside class="col-12 col-lg-2 sidebar-admin p-3">
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-house-door me-2"></i>Dashboard</a>
                    <a class="nav-link {{ request()->routeIs('pengelola.kearifan.*') ? 'active' : '' }}" href="{{ route('pengelola.kearifan.index') }}"><i class="bi bi-bank me-2"></i>Kearifan Lokal</a>
                    <a class="nav-link {{ request()->routeIs('pengelola.wisata.*') ? 'active' : '' }}" href="{{ route('pengelola.wisata.index') }}"><i class="bi bi-geo-alt me-2"></i>Info Wisata</a>
                    @if (auth()->user()?->isAdmin())
                        <a class="nav-link {{ request()->routeIs('pengelola.pengguna.*') ? 'active' : '' }}" href="{{ route('pengelola.pengguna.index') }}"><i class="bi bi-people me-2"></i>Pengguna</a>
                        <a class="nav-link {{ request()->routeIs('pengelola.pengaturan.*') ? 'active' : '' }}" href="{{ route('pengelola.pengaturan.edit') }}"><i class="bi bi-gear me-2"></i>Pengaturan</a>
                    @endif
                    <hr>
                    <a class="nav-link {{ request()->routeIs('profil.*') ? 'active' : '' }}" href="{{ route('profil.edit') }}"><i class="bi bi-person-gear me-2"></i>Profil Saya</a>
                    <a class="nav-link" href="{{ route('beranda') }}"><i class="bi bi-globe me-2"></i>Lihat Portal Publik</a>
                </nav>
            </aside>

            {{-- ====== Konten ====== --}}
            <main class="col-12 col-lg-10 p-4">
                @if (session('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif
                @yield('konten')
            </main>
        </div>
    </div>

    <footer class="footer-kaloka py-3 mt-4">
        <div class="container-fluid text-center small">
            KALOKA — Perpustakaan Desa Sobokerto &copy; {{ date('Y') }}
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('skrip')
</body>
</html>
