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

    <div class="col-md-8">
        <label class="form-label">Status Entri <span class="text-danger">*</span></label>
        <select name="status_etis" class="form-select" required>
            @foreach (\App\Models\Umkm::STATUS_ETIS as $s)
                <option value="{{ $s }}" @selected($val('status_etis', 'Umum') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <div class="form-text">Sakral tidak ditampilkan ke publik.</div>
    </div>

    <div class="col-12">
        <label class="form-label">Foto <span class="text-muted small">(maks 20 MB, unggah baru untuk mengganti)</span></label>
        <input type="file" name="foto" id="inputFoto" class="form-control" accept="image/*"
               onchange="previewFotoUmkm(event)">
        <div class="form-text">
            <img id="previewFotoUmkmImg"
                 src="{{ $entri && $entri->foto ? ($entri->urlFoto()[0] ?? '') : '' }}"
                 alt="Pratinjau foto"
                 class="rounded border mt-2 {{ $entri && $entri->foto ? '' : 'd-none' }}"
                 style="width:160px;height:120px;object-fit:cover;">
        </div>
    </div>
    <script>
        function previewFotoUmkm(event) {
            const file = event.target.files[0];
            const img = document.getElementById('previewFotoUmkmImg');
            if (!file) return;
            img.src = URL.createObjectURL(file);
            img.classList.remove('d-none');
        }
    </script>
</div>