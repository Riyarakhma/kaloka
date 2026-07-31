@extends('layouts.admin')

@section('judul', $entri->nama_umkm)

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h4 mb-0">{{ $entri->kode_entri }} — {{ $entri->nama_umkm }}</h1>
        <div class="text-nowrap">
            <a href="{{ route('pengelola.umkm.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Daftar
            </a>
            <a href="{{ route('pengelola.umkm.edit', $entri) }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Ubah
            </a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-2">
                        <span class="badge bg-secondary">{{ $entri->kategori }}</span>
                        <span class="badge bg-{{ $entri->warnaStatusEtis() }} text-dark">Entri: {{ $entri->status_etis }}</span>
                        <span class="badge bg-{{ $entri->warnaStatusKurasi() }}">Kurasi: {{ $entri->status_kurasi }}</span>
                    </p>

                    <p style="white-space:pre-line">{{ $entri->deskripsi }}</p>

                    @if ($entri->foto)
                        <div class="d-flex flex-wrap gap-3 mt-3">
                            @foreach ($entri->urlFoto() as $url)
                                <img src="{{ $url }}" alt="{{ $entri->nama_umkm }}" class="rounded border"
                                     style="width:160px;height:120px;object-fit:cover;">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            @if (Auth::user()->isAdmin())
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-white"><strong>Alur Kurasi</strong></div>
                    <div class="card-body">
                        <p class="small text-muted">Draf → Terbit</p>
                        <form action="{{ route('pengelola.umkm.kurasi', $entri) }}" method="POST" class="d-flex gap-2">
                            @csrf @method('PATCH')
                            <select name="status_kurasi" class="form-select form-select-sm">
                                @foreach (\App\Models\Umkm::STATUS_KURASI as $s)
                                    <option value="{{ $s }}" @selected($entri->status_kurasi === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-kaloka btn-sm text-nowrap">Ubah</button>
                        </form>
                        @if (! $entri->bolehPublik())
                            <div class="alert alert-warning small mt-3 mb-0">
                                <i class="bi bi-eye-slash me-1"></i>Tidak tampil publik (harus Terbit & entri Umum).
                            </div>
                        @else
                            <div class="alert alert-success small mt-3 mb-0">
                                <i class="bi bi-globe me-1"></i>Tampil publik.
                                <a href="{{ route('umkm.show', $entri) }}" target="_blank">Lihat halaman publik</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Metadata</strong></div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item"><strong>Pemilik:</strong> {{ $entri->pemilik }}</li>
                    <li class="list-group-item"><strong>Alamat:</strong> {{ $entri->alamat }}</li>
                    <li class="list-group-item"><strong>Kontak:</strong> {{ $entri->kontak ?: '—' }}</li>
                    <li class="list-group-item"><strong>Sosial Media:</strong> {{ $entri->sosial_media ?: '—' }}</li>
                    <li class="list-group-item"><strong>Jam Operasional:</strong> {{ $entri->jam_operasional ?: '—' }}</li>
                    <li class="list-group-item">
                        <strong>Produk:</strong>
                        @if ($entri->daftarProduk())
                            {{ implode(', ', $entri->daftarProduk()) }}
                        @else
                            —
                        @endif
                    </li>
                    <li class="list-group-item">
                        <strong>Google Maps:</strong>
                        @if ($entri->link_maps)
                            <a href="{{ $entri->link_maps }}" target="_blank">Buka di Maps</a>
                        @else
                            —
                        @endif
                    </li>
                    <li class="list-group-item"><strong>Dibuat:</strong> {{ $entri->created_at?->format('d M Y') ?? '—' }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection