@extends('layouts.admin')

@section('judul', 'Kearifan Lokal')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Repositori Kearifan Lokal</h1>
        <a href="{{ route('pengelola.kearifan.create') }}" class="btn btn-kaloka btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah Entri
        </a>
    </div>

    {{-- Filter & pencarian --}}
    <form method="GET" class="card card-body shadow-sm mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small mb-1">Cari</label>
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control form-control-sm"
                       placeholder="judul / kode / kata kunci / narasumber">
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
            <div class="col-md-3">
                <label class="form-label small mb-1">Status Kurasi</label>
                <select name="status_kurasi" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    @foreach (\App\Models\KearifanLokal::STATUS_KURASI as $s)
                        <option value="{{ $s }}" @selected(request('status_kurasi') === $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-outline-kaloka btn-sm"><i class="bi bi-funnel me-1"></i>Filter</button>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Dimensi</th>
                        <th>Media</th>
                        <th>Etis</th>
                        <th>Kurasi</th>
                        <th>Dibuat oleh</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entri as $e)
                        <tr>
                            <td class="small text-muted">{{ $e->kode_entri }}</td>
                            <td>{{ $e->judul }}</td>
                            <td><span class="badge badge-dimensi text-white">{{ $e->dimensi }}</span></td>
                            <td>{{ $e->jenis_media }}</td>
                            <td><span class="badge bg-{{ $e->warnaStatusEtis() }} text-dark">{{ $e->status_etis }}</span></td>
                            <td><span class="badge bg-{{ $e->warnaStatusKurasi() }}">{{ $e->status_kurasi }}</span></td>
                            <td class="small text-muted">{{ $e->pembuat?->name ?? '—' }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('pengelola.kearifan.show', $e) }}" class="btn btn-sm btn-outline-secondary" title="Lihat"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('pengelola.kearifan.edit', $e) }}" class="btn btn-sm btn-outline-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('pengelola.kearifan.destroy', $e) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus entri {{ $e->kode_entri }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada entri.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $entri->links() }}
    </div>
@endsection
