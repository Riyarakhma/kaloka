@extends('layouts.admin')

@section('judul', 'Info Wisata')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Info Wisata</h1>
        <a href="{{ route('pengelola.wisata.create') }}" class="btn btn-kaloka btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah Spot
        </a>
    </div>

    <form method="GET" class="card card-body shadow-sm mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small mb-1">Cari</label>
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control form-control-sm" placeholder="nama spot">
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
            <div class="col-md-3 d-grid">
                <button class="btn btn-outline-kaloka btn-sm"><i class="bi bi-funnel me-1"></i>Filter</button>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th>Foto</th><th>Nama Spot</th><th>Kategori</th><th>Tampil</th><th class="text-end">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($wisata as $w)
                        <tr>
                            <td>
                                @if ($w->fotoUtama())
                                    <img src="{{ $w->fotoUtama() }}" style="height:40px;width:55px;object-fit:cover;border-radius:.3rem;">
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td>{{ $w->nama_spot }}</td>
                            <td><span class="badge bg-{{ $w->warnaKategori() }}">{{ $w->kategori }}</span></td>
                            <td>
                                @if ($w->status_tampil)
                                    <span class="badge bg-success">Tampil</span>
                                @else
                                    <span class="badge bg-secondary">Sembunyi</span>
                                @endif
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('pengelola.wisata.show', $w) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('pengelola.wisata.edit', $w) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('pengelola.wisata.destroy', $w) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus {{ $w->nama_spot }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada spot wisata.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $wisata->links() }}</div>
@endsection
