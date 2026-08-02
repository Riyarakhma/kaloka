@extends('layouts.admin')

@section('judul', $entri->kode_entri)

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h4 mb-0">{{ $entri->judul }}</h1>
        <div class="text-nowrap">
            <a href="{{ route('pengelola.kearifan.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Daftar
            </a>
            <a href="{{ route('pengelola.kearifan.edit', $entri) }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Ubah
            </a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-2">
                        <span class="badge badge-dimensi text-white">{{ $entri->dimensi }}</span>
                        <span class="badge bg-{{ $entri->warnaStatusEtis() }} text-dark">Entri: {{ $entri->status_etis }}</span>
                        <span class="badge bg-{{ $entri->warnaStatusKurasi() }}">Kurasi: {{ $entri->status_kurasi }}</span>
                    </p>

                    <p style="white-space:pre-line">{{ $entri->deskripsi }}</p>

                    @if ($entri->daftarKataKunci())
                        <div class="mb-3">
                            @foreach ($entri->daftarKataKunci() as $k)
                                <span class="badge bg-light text-dark border">#{{ $k }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if ($entri->berkas_media)
                        <div class="mb-3">
                            <img src="{{ $entri->urlMedia() }}" alt="Foto {{ $entri->judul }}"
                                 class="rounded border" style="max-width:320px;max-height:220px;object-fit:cover;">
                        </div>
                    @endif
                    @if ($entri->dokumen)
                        <div class="mb-3">
                            <a href="{{ $entri->urlDokumen() }}" target="_blank"
                               class="d-inline-flex align-items-center gap-2 text-decoration-none border rounded-3 px-3 py-2">
                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-3"></i>
                                <span>
                                    <span class="d-block fw-semibold text-dark">Dokumen PDF</span>
                                    <span class="d-block small text-muted">{{ basename($entri->dokumen) }}</span>
                                </span>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- Alur kurasi (khusus admin) --}}
            @if (Auth::user()->isAdmin())
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-white"><strong>Alur Kurasi</strong></div>
                    <div class="card-body">
                        <p class="small text-muted">Draf → Terbit</p>
                        <form action="{{ route('pengelola.kearifan.kurasi', $entri) }}" method="POST" class="d-flex gap-2">
                            @csrf @method('PATCH')
                            <select name="status_kurasi" class="form-select form-select-sm">
                                @foreach (\App\Models\KearifanLokal::STATUS_KURASI as $s)
                                    <option value="{{ $s }}" @selected($entri->status_kurasi === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-kaloka btn-sm text-nowrap">Ubah</button>
                        </form>
                        @if (! $entri->bolehPublik())
                            <div class="alert alert-warning small mt-3 mb-0">
                                <i class="bi bi-eye-slash me-1"></i>Entri ini <strong>tidak tampil di publik</strong>
                                (harus Terbit & status entri Umum).
                            </div>
                        @else
                            <div class="alert alert-success small mt-3 mb-0">
                                <i class="bi bi-globe me-1"></i>Tampil publik.
                                <a href="{{ route('kearifan.show', $entri) }}" target="_blank">Lihat halaman publik</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Metadata --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>Metadata</strong></div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item"><strong>Kode:</strong> {{ $entri->kode_entri }}</li>
                    <li class="list-group-item"><strong>Narasumber:</strong> {{ $entri->narasumber ?: '—' }}</li>
                    <li class="list-group-item"><strong>Lokasi:</strong> {{ $entri->lokasi ?: '—' }}</li>
                    <li class="list-group-item"><strong>Tanggal Dokumentasi:</strong>
                        {{ $entri->tanggal_dokumentasi?->format('d M Y') ?: '—' }}</li>
                    <li class="list-group-item"><strong>Pendokumentasi:</strong> {{ $entri->pendokumentasi ?: '—' }}</li>
                    <li class="list-group-item"><strong>Dibuat:</strong> {{ $entri->created_at?->format('d M Y') ?? '—' }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection