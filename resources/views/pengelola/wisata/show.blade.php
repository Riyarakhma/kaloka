@extends('layouts.admin')

@section('judul', $wisata->nama_spot)

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h4 mb-0">{{ $wisata->kode_entri }} — {{ $wisata->nama_spot }}</h1>
        <div class="text-nowrap">
            <a href="{{ route('pengelola.wisata.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Daftar</a>
            <a href="{{ route('pengelola.wisata.edit', $wisata) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil me-1"></i>Ubah</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p>
                        <span class="badge bg-{{ $wisata->warnaKategori() }}">{{ $wisata->kategori }}</span>
                        <span class="badge bg-{{ $wisata->warnaStatusEtis() }} text-dark">Entri: {{ $wisata->status_etis }}</span>
                        <span class="badge bg-{{ $wisata->warnaStatusKurasi() }}">Kurasi: {{ $wisata->status_kurasi }}</span>
                    </p>
                    @if ($wisata->foto)
                        <div class="row g-2 mb-3">
                            @foreach ($wisata->urlFoto() as $url)
                                <div class="col-4"><img src="{{ $url }}" class="img-fluid rounded"></div>
                            @endforeach
                        </div>
                    @endif
                    <p style="white-space:pre-line">{{ $wisata->deskripsi }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @if (Auth::user()->isAdmin())
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-white"><strong>Alur Kurasi</strong></div>
                    <div class="card-body">
                        <p class="small text-muted">Draf → Terbit</p>
                        <form action="{{ route('pengelola.wisata.kurasi', $wisata) }}" method="POST" class="d-flex gap-2">
                            @csrf @method('PATCH')
                            <select name="status_kurasi" class="form-select form-select-sm">
                                @foreach (\App\Models\Wisata::STATUS_KURASI as $s)
                                    <option value="{{ $s }}" @selected($wisata->status_kurasi === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-kaloka btn-sm text-nowrap">Ubah</button>
                        </form>
                        @if (! $wisata->bolehPublik())
                            <div class="alert alert-warning small mt-3 mb-0">
                                <i class="bi bi-eye-slash me-1"></i>Tidak tampil publik (harus Terbit & entri Umum).
                            </div>
                        @else
                            <div class="alert alert-success small mt-3 mb-0">
                                <i class="bi bi-globe me-1"></i>Tampil publik.
                                <a href="{{ route('wisata.show', $wisata) }}" target="_blank">Lihat halaman publik</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Informasi</strong></div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item"><strong>Lokasi:</strong> {{ $wisata->lokasi ?: '—' }}</li>
                    <li class="list-group-item"><strong>Koordinat:</strong> {{ $wisata->koordinat ?: '—' }}</li>
                    <li class="list-group-item"><strong>Jam:</strong> {{ $wisata->jam_operasional ?: '—' }}</li>
                    <li class="list-group-item"><strong>Kontak:</strong> {{ $wisata->kontak ?: '—' }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
