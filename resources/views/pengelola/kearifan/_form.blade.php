@php
    /** @var \App\Models\Umkm|null $entri */
    $entri = $entri ?? null;
    $val = fn ($k, $d = '') => old($k, $entri->$k ?? $d);
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali isian berikut:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Nama UMKM <span class="text-danger">*</span></label>
        <input type="text" name="nama_umkm" class="form-control" value="{{ $val('nama_umkm') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <input type="text" name="kategori" class="form-control" value="{{ $val('kategori') }}"
               placeholder="mis. Kuliner, Kerajinan" required>
    </div>

    <div class="col-12">
        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
        <textarea name="deskripsi" class="form-control" rows="5" required>{{ $val('deskripsi') }}</textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
        <input type="text" name="pemilik" class="form-control" value="{{ $val('pemilik') }}" required>
    </div>

    <div class="col-md-8">
        <label class="form-label">Alamat <span class="text-danger">*</span></label>
        <input type="text" name="alamat" class="form-control" value="{{ $val('alamat') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Kontak <span class="text-muted small">(WhatsApp/telepon, opsional)</span></label>
        <input type="text" name="kontak" class="form-control" value="{{ $val('kontak') }}">
    </div>

    <div class="col-md-8 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="status_tampil" value="0">
            <input type="checkbox" name="status_tampil" value="1" class="form-check-input" id="statusTampil"
                   @checked(old('status_tampil', $entri->status_tampil ?? true))>
            <label class="form-check-label" for="statusTampil">Tampilkan di halaman publik</label>
        </div>
    </div>

    <div class="col-12">
        <label class="form-label">Foto <span class="text-muted small">(boleh pilih beberapa, maks 20 MB/foto)</span></label>
        <input type="file" name="foto[]" class="form-control" multiple accept="image/*">
    </div>

    @if ($entri && $entri->foto)
        <div class="col-12">
            <label class="form-label small text-muted">Foto saat ini — centang untuk menghapus</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($entri->urlFoto() as $index => $url)
                    <div class="text-center">
                        <img src="{{ $url }}" alt="Foto {{ $index + 1 }}" class="rounded border mb-1"
                             style="width:120px;height:90px;object-fit:cover;">
                        <div class="form-check small">
                            <input type="checkbox" name="hapus_foto[]" value="{{ $index }}"
                                   class="form-check-input" id="hapusFoto{{ $index }}">
                            <label class="form-check-label" for="hapusFoto{{ $index }}">Hapus</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


</div>