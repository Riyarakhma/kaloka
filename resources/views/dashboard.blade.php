@extends('layouts.admin')

@section('judul', 'Dashboard')

@section('konten')
    <div class="mb-4">
        <h1 class="h3 mb-0">Dashboard</h1>
        <p class="text-muted mb-0">Selamat datang, {{ Auth::user()->name }}
            <span class="badge bg-secondary">{{ Auth::user()->labelPeran() }}</span>
        </p>
    </div>

    {{-- Kartu ringkasan --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm text-center p-3 h-100">
                <div class="ikon text-success"><i class="bi bi-bank"></i></div>
                <div class="h2 mb-0">{{ $statistik['kearifan_total'] }}</div>
                <div class="small text-muted">Total Kearifan Lokal</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm text-center p-3 h-100">
                <div class="ikon text-primary"><i class="bi bi-globe"></i></div>
                <div class="h2 mb-0">{{ $statistik['kearifan_terbit'] }}</div>
                <div class="small text-muted">Entri Terbit (publik)</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm text-center p-3 h-100">
                <div class="ikon text-danger"><i class="bi bi-geo-alt"></i></div>
                <div class="h2 mb-0">{{ $statistik['wisata_total'] }}</div>
                <div class="small text-muted">Total Spot Wisata</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm text-center p-3 h-100">
                <div class="ikon text-info"><i class="bi bi-eye"></i></div>
                <div class="h2 mb-0">{{ $statistik['wisata_tampil'] }}</div>
                <div class="small text-muted">Wisata Tampil</div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- Kearifan per status --}}
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white"><strong>Kearifan per Status Kurasi</strong></div>
                <ul class="list-group list-group-flush">
                    @foreach ($statistik['kearifan_status'] as $status => $jml)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $status }}</span><span class="badge bg-secondary">{{ $jml }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Kearifan per dimensi --}}
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white"><strong>Kearifan per Dimensi</strong></div>
                <ul class="list-group list-group-flush">
                    @foreach ($statistik['kearifan_dimensi'] as $dim => $jml)
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="small">{{ $dim }}</span><span class="badge badge-dimensi text-white">{{ $jml }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Katalog SLiMS --}}
        <div class="col-lg-4">
            <div class="card shadow-sm h-100 border-primary">
                <div class="card-header bg-white"><strong><i class="bi bi-book me-1"></i>Katalog (SLiMS)</strong></div>
                <div class="card-body">
                    <p class="small text-muted">Katalog, sirkulasi, dan keanggotaan dikelola oleh aplikasi
                        <strong>SLiMS</strong> yang terpisah.</p>

                    @if (($slims['aktif'] ?? false))
                        {{-- Statistik nyata dari DB SLiMS (hanya-baca) --}}
                        <div class="row text-center g-2 mb-3">
                            <div class="col-4">
                                <div class="border rounded py-2">
                                    <div class="h5 mb-0">{{ number_format($slims['koleksi']) }}</div>
                                    <div class="small text-muted">Koleksi</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border rounded py-2">
                                    <div class="h5 mb-0">{{ number_format($slims['eksemplar']) }}</div>
                                    <div class="small text-muted">Eksemplar</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border rounded py-2">
                                    <div class="h5 mb-0">{{ number_format($slims['anggota']) }}</div>
                                    <div class="small text-muted">Anggota</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-light border small">
                            <i class="bi bi-info-circle me-1"></i>
                            Statistik katalog dilihat langsung di SLiMS.
                            <span class="d-block text-muted mt-1">{{ $slims['pesan'] ?? '' }}</span>
                        </div>
                    @endif

                    @if ($urlOpac)
                        <a href="{{ $urlOpac }}" target="_blank" class="btn btn-kaloka btn-sm w-100 mb-2">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Buka OPAC SLiMS
                        </a>
                    @endif
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('pengelola.pengaturan.edit') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-gear me-1"></i>Atur URL OPAC
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Tautan cepat --}}
    <div class="row g-3 mt-1">
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('pengelola.kearifan.index') }}" class="btn btn-outline-kaloka w-100">
                <i class="bi bi-bank me-1"></i>Kelola Kearifan Lokal
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('pengelola.wisata.index') }}" class="btn btn-outline-kaloka w-100">
                <i class="bi bi-geo-alt me-1"></i>Kelola Wisata
            </a>
        </div>
        @if (Auth::user()->isAdmin())
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('pengelola.pengguna.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-people me-1"></i>Manajemen Pengguna
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('pengelola.pengaturan.edit') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-gear me-1"></i>Pengaturan Situs
                </a>
            </div>
        @endif
    </div>
@endsection
