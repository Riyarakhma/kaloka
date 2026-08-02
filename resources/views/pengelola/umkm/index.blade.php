@extends('layouts.admin')

@section('judul', 'UMKM')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Direktori UMKM</h1>
        <a href="{{ route('pengelola.umkm.create') }}" class="btn btn-kaloka btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah UMKM
        </a>
    </div>

    <form method="GET" class="card card-body shadow-sm mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small mb-1">Cari</label>
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control form-control-sm"
                       placeholder="nama UMKM / pemilik / alamat">
            </div>
            <div class="col-md-4">
                <label class="form-label small mb-1">Dimensi</label>
                <input type="text" name="kategori" value="{{ request('kategori') }}" class="form-control form-control-sm"
                       placeholder="mis. Kuliner">
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
                    <tr>
                        <th>Kode</th>
                        <th>Foto</th>
                        <th>Nama UMKM</th>
                        <th>Dimensi</th>
                        <th>Pemilik</th>
                        <th>Kontak</th>
                        <th>Entri</th>
                        <th>Kurasi</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entri as $e)
                        @php
                            $fotoUmkm = method_exists($e, 'fotoUtama') ? $e->fotoUtama() : null;

                            if (! $fotoUmkm) {
                                $rawFoto = is_array($e->foto) ? ($e->foto[0] ?? null) : $e->foto;
                                $fotoUmkm = $rawFoto ? asset('storage/' . ltrim($rawFoto, '/')) : null;
                            }

                            $petaDimensi = [
                                'kuliner'     => 'danger',
                                'kerajinan'   => 'warning',
                                'budidaya'    => 'info',
                                'pertanian'   => 'success',
                                'perikanan'   => 'info',
                                'perdagangan' => 'primary',
                                'jasa'        => 'primary',
                                'fashion'     => 'warning',
                            ];

                            $warnaDimensi = $petaDimensi[strtolower(trim($e->kategori ?? ''))] ?? 'secondary';
                        @endphp
                        <tr>
                            <td class="small text-muted">{{ $e->kode_entri }}</td>
                            <td>
                                @if ($fotoUmkm)
                                    <img src="{{ $fotoUmkm }}" style="height:40px;width:55px;object-fit:cover;border-radius:.3rem;">
                                @else
                                    <span class="text-muted small">&mdash;</span>
                                @endif
                            </td>
                            <td>{{ $e->nama_umkm }}</td>
                            <td><span class="badge bg-{{ $warnaDimensi }}">{{ $e->kategori }}</span></td>
                            <td>{{ $e->pemilik }}</td>
                            <td class="small text-muted">{{ $e->kontak ?: '—' }}</td>
                            <td><span class="badge bg-{{ $e->warnaStatusEtis() }} text-dark">{{ $e->status_etis }}</span></td>
                            <td><span class="badge bg-{{ $e->warnaStatusKurasi() }}">{{ $e->status_kurasi }}</span></td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('pengelola.umkm.show', $e) }}" class="btn btn-sm btn-outline-secondary" title="Lihat"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('pengelola.umkm.edit', $e) }}" class="btn btn-sm btn-outline-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('pengelola.umkm.destroy', $e) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus UMKM {{ $e->nama_umkm }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center text-muted py-4">Belum ada UMKM.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $entri->links() }}
    </div>
@endsection