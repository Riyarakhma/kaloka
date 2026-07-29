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

    <div class="col-12"><hr><h6 class="text-muted">Terjemahan Bahasa Inggris (opsional)</h6></div>

    <div class="col-md-6">
        <label class="form-label">Nama Spot (EN)</label>
        <input type="text" name="nama_spot_en" class="form-control" value="{{ $val('nama_spot_en') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Lokasi (EN)</label>
        <input type="text" name="lokasi_en" class="form-control" value="{{ $val('lokasi_en') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi (EN)</label>
        <textarea name="deskripsi_en" class="form-control" rows="4">{{ $val('deskripsi_en') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Jam Operasional (EN)</label>
        <input type="text" name="jam_operasional_en" class="form-control" value="{{ $val('jam_operasional_en') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Kontak (EN)</label>
        <input type="text" name="kontak_en" class="form-control" value="{{ $val('kontak_en') }}">
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
    <div class="col-md-4">
        <label class="form-label">Status Entri <span class="text-danger">*</span></label>
        <select name="status_etis" class="form-select" required>
            @foreach (\App\Models\Wisata::STATUS_ETIS as $s)
                <option value="{{ $s }}" @selected($val('status_etis', 'Umum') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <div class="form-text">Sakral tidak ditampilkan ke publik.</div>
    </div>
</div>
