@extends('layouts.publik')

@section('judul', 'Kearifan Lokal')

@section('konten')
    <div class="mb-4">
        <h1 class="h3 mb-1"><i class="bi bi-bank me-2"></i>Repositori Kearifan Lokal</h1>
        <p class="text-muted mb-0">Dokumentasi warisan & budaya Desa Sobokerto, kawasan Waduk Cengklik.</p>
    </div>

    {{-- Filter & pencarian --}}
    <form method="GET" class="card card-body shadow-sm mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small mb-1">Cari</label>
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control form-control-sm"
                       placeholder="kata kunci, judul...">
            </div>
            <div class="col-md-3">
                <label class="form-label small mb-1">Dimensi</label>
                <select name="dimensi" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    @foreach (\App\Models\KearifanLokal::DIMENSI as $d)
                        <option value="{{ $d }}" @selected(request('dimensi') === $d)>{{ $d }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small mb-1">Media</label>
                <select name="jenis_media" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    @foreach (\App\Models\KearifanLokal::JENIS_MEDIA as $m)
                        <option value="{{ $m }}" @selected(request('jenis_media') === $m)>{{ $m }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-kaloka btn-sm"><i class="bi bi-search me-1"></i>Cari</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse ($entri as $e)
            <div class="col-sm-6 col-lg-4">
                <a href="{{ route('kearifan.show', $e) }}" class="text-decoration-none text-dark">
                    <div class="card kartu-menu shadow-sm h-100">
                        @if ($e->jenis_media === 'Foto' && $e->urlMedia())
                            <img src="{{ $e->urlMedia() }}" class="card-img-top" alt="{{ $e->judul }}"
                                 style="height:160px;object-fit:cover;border-radius:1rem 1rem 0 0;">
                        @else
                            <div class="text-center pt-3"><i class="ikon bi
                                @switch($e->jenis_media)
                                    @case('Foto') bi-image @break
                                    @case('Audio') bi-music-note-beamed @break
                                    @case('Video') bi-camera-video @break
                                    @default bi-file-text
                                @endswitch"></i></div>
                        @endif
                        <div class="card-body">
                            <span class="badge badge-dimensi text-white mb-2">{{ $e->dimensi }}</span>
                            <h2 class="h6">{{ $e->judul }}</h2>
                            <p class="small text-muted mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($e->deskripsi), 90) }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada entri yang dipublikasikan.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $entri->links() }}
    </div>
@endsection
