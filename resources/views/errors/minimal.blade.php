<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('kode') — KALOKA</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/kaloka.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1 d-flex align-items-center">
        <div class="container text-center py-5">
            <div class="ikon mb-3" style="font-size:4rem;color:var(--kaloka-primary);">
                <i class="bi @yield('ikon', 'bi-exclamation-triangle')"></i>
            </div>
            <h1 class="display-4 fw-bold">@yield('kode')</h1>
            <p class="h5 text-muted mb-1">@yield('judul')</p>
            <p class="text-muted">@yield('pesan')</p>
            <a href="{{ url('/') }}" class="btn btn-kaloka mt-2">
                <i class="bi bi-house-door me-1"></i>Kembali ke Beranda
            </a>
        </div>
    </main>
    <footer class="footer-kaloka py-3 text-center small">
        KALOKA — Perpustakaan Desa Sobokerto &copy; {{ date('Y') }}
    </footer>
</body>
</html>
