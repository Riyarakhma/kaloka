@extends('layouts.app')

@section('judul', 'Masuk')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-book-half" style="font-size:2.5rem;color:var(--kaloka-primary);"></i>
                        <h1 class="h4 mt-2 mb-0">Masuk Area Pengelola</h1>
                        <p class="text-muted small">KALOKA — Perpustakaan Desa Sobokerto</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-kaloka">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                    Lupa kata sandi?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <p class="text-center text-muted small mt-3 mb-0">
                <i class="bi bi-info-circle me-1"></i>Pendaftaran akun hanya melalui admin.
            </p>
        </div>
    </div>
</div>
@endsection
