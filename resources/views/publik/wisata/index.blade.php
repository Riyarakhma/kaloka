@extends('layouts.publik')

@section('judul', 'Wisata')

@section('konten')
    <div class="mb-4">
        <h1 class="h3 mb-1"><i class="bi bi-geo-alt me-2"></i>Info Wisata Desa</h1>
        <p class="text-muted mb-0">Jelajahi pesona Waduk Cengklik dan potensi wisata Desa Sobokerto.</p>
    </div>

    <form method="GET" class="card card-body shadow-sm mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label small mb-1">Cari</label>
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control form-control-sm" placeholder="nama spot...">
            </div>
            <div class="col-md-4">
                <label class="form-label small mb-1">Kategori</label>
                <select name="kategori" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    @foreach (\App\Models\Wisata::KATEGORI as $k)
                        <option value="{{ $k }}" @selected(request('kategori') === $k)>{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-kaloka btn-sm"><i class="bi bi-search me-1"></i>Cari</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse ($wisata as $w)
            <div class="col-sm-6 col-lg-4">
                <a href="{{ route('wisata.show', $w) }}" class="text-decoration-none text-dark">
                    <div class="card kartu-menu shadow-sm h-100">
                        @if ($w->fotoUtama())
                            <img src="{{ $w->fotoUtama() }}" class="card-img-top" alt="{{ $w->nama_spot }}"
                                 style="height:170px;object-fit:cover;border-radius:1rem 1rem 0 0;">
                        @else
                            <div class="text-center pt-3"><i class="ikon bi bi-image"></i></div>
                        @endif
                        <div class="card-body">
                            <span class="badge bg-{{ $w->warnaKategori() }} mb-2">{{ $w->kategori }}</span>
                            <h2 class="h6">{{ $w->nama_spot }}</h2>
                            <p class="small text-muted mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($w->deskripsi), 90) }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-info">Belum ada informasi wisata.</div></div>
        @endforelse
    </div>

    <div class="mt-4">{{ $wisata->links() }}</div>
@endsection
