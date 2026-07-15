@php
    /** @var \App\Models\Wisata|null $wisata */
    $wisata = $wisata ?? null;
    $val = fn ($k, $d = '') => old($k, $wisata->$k ?? $d);
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Nama Spot <span class="text-danger">*</span></label>
        <input type="text" name="nama_spot" class="form-control" value="{{ $val('nama_spot') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="kategori" class="form-select" required>
            @foreach (\App\Models\Wisata::KATEGORI as $k)
                <option value="{{ $k }}" @selected($val('kategori', 'Destinasi') === $k)>{{ $k }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
        <textarea name="deskripsi" class="form-control" rows="4" required>{{ $val('deskripsi') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control" value="{{ $val('lokasi') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Koordinat <span class="text-muted small">(lat,long — opsional)</span></label>
        <input type="text" name="koordinat" class="form-control" value="{{ $val('koordinat') }}" placeholder="-7.55, 110.72">
    </div>
    <div class="col-md-6">
        <label class="form-label">Jam Operasional</label>
        <input type="text" name="jam_operasional" class="form-control" value="{{ $val('jam_operasional') }}" placeholder="08.00 – 17.00">
    </div>
    <div class="col-md-6">
        <label class="form-label">Kontak</label>
        <input type="text" name="kontak" class="form-control" value="{{ $val('kontak') }}" placeholder="WA / telepon">
    </div>
    <div class="col-12">
        <label class="form-label">Foto <span class="text-muted small">(bisa beberapa, maks 5 MB/foto)</span></label>
        <input type="file" name="foto[]" class="form-control" accept="image/*" multiple>
        @if ($wisata && $wisata->foto)
            <div class="d-flex flex-wrap gap-2 mt-2">
                @foreach ($wisata->urlFoto() as $i => $url)
                    <div class="position-relative">
                        <img src="{{ $url }}" style="height:70px;width:90px;object-fit:cover;border-radius:.4rem;">
                    </div>
                @endforeach
            </div>
            <div class="form-text">Foto baru akan ditambahkan ke foto yang sudah ada.</div>
        @endif
    </div>
    <div class="col-12">
        <div class="form-check form-switch">
            <input type="hidden" name="status_tampil" value="0">
            <input class="form-check-input" type="checkbox" name="status_tampil" value="1" id="tampil"
                   @checked((bool) $val('status_tampil', true))>
            <label class="form-check-label" for="tampil">Tampilkan ke publik</label>
        </div>
    </div>
</div>
