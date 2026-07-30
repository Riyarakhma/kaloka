@php
    /** @var \App\Models\KearifanLokal|null $entri */
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
    {{-- 2. Judul --}}
    <div class="col-md-8">
        <label class="form-label">Judul <span class="text-danger">*</span></label>
        <input type="text" name="judul" class="form-control" value="{{ $val('judul') }}" required>
    </div>

    {{-- 3. Dimensi --}}
    <div class="col-md-4">
        <label class="form-label">Dimensi <span class="text-danger">*</span></label>
        <select name="dimensi" class="form-select" required>
            <option value="">— pilih —</option>
            @foreach (\App\Models\KearifanLokal::DIMENSI as $d)
                <option value="{{ $d }}" @selected($val('dimensi') === $d)>{{ $d }}</option>
            @endforeach
        </select>
    </div>

    {{-- 4. Deskripsi --}}
    <div class="col-12">
        <label class="form-label">Deskripsi (narasi) <span class="text-danger">*</span></label>
        <textarea name="deskripsi" class="form-control" rows="5" required>{{ $val('deskripsi') }}</textarea>
    </div>

    {{-- 5. Kata kunci --}}
    <div class="col-md-6">
        <label class="form-label">Kata Kunci <span class="text-muted small">(pisah dengan koma)</span></label>
        <input type="text" name="kata_kunci" class="form-control" value="{{ $val('kata_kunci') }}"
               placeholder="mis. mina padi, tradisi, gotong royong">
    </div>

    {{-- 6. Narasumber --}}
    <div class="col-md-6">
        <label class="form-label">Narasumber</label>
        <input type="text" name="narasumber" class="form-control" value="{{ $val('narasumber') }}">
    </div>

    {{-- 7. Lokasi --}}
    <div class="col-md-6">
        <label class="form-label">Lokasi <span class="text-muted small">(dukuh/koordinat)</span></label>
        <input type="text" name="lokasi" class="form-control" value="{{ $val('lokasi') }}">
    </div>

    {{-- 8. Bahasa --}}
    <div class="col-md-3">
        <label class="form-label">Bahasa</label>
        <input type="text" name="bahasa" class="form-control" value="{{ $val('bahasa', 'Indonesia') }}">
    </div>

    {{-- 10. Foto --}}
    <div class="col-md-6">
        <label class="form-label">Foto <span class="text-muted small">(opsional, maks 20 MB, unggah baru untuk mengganti)</span></label>
        <input type="file" name="berkas_media" id="inputFotoKearifan" class="form-control" accept="image/*"
               onchange="previewFotoKearifan(event)">
        <div class="form-text">
            <img id="previewFotoKearifanImg"
                 src="{{ $entri && $entri->berkas_media ? $entri->urlMedia() : '' }}"
                 alt="Pratinjau foto"
                 class="rounded border mt-2 {{ $entri && $entri->berkas_media ? '' : 'd-none' }}"
                 style="width:160px;height:120px;object-fit:cover;">
        </div>
    </div>

    <script>
        function previewFotoKearifan(event) {
            const file = event.target.files[0];
            const img = document.getElementById('previewFotoKearifanImg');
            if (!file) return;
            img.src = URL.createObjectURL(file);
            img.classList.remove('d-none');
        }
    </script>

    {{-- 10b. Dokumen PDF --}}
    <div class="col-md-6">
        <label class="form-label">Dokumen PDF <span class="text-muted small">(opsional, maks 20 MB, unggah baru untuk mengganti)</span></label>
        <input type="file" name="dokumen" class="form-control" accept="application/pdf">
        @if ($entri && $entri->dokumen)
            <div class="form-text">
                Dokumen saat ini: <a href="{{ $entri->urlDokumen() }}" target="_blank">{{ basename($entri->dokumen) }}</a>
            </div>
        @endif
    </div>

    {{-- 11. Tanggal dokumentasi --}}
    <div class="col-md-3">
        <label class="form-label">Tanggal Dokumentasi</label>
        <input type="date" name="tanggal_dokumentasi" class="form-control"
               value="{{ $val('tanggal_dokumentasi') ? \Illuminate\Support\Carbon::parse($val('tanggal_dokumentasi'))->format('Y-m-d') : '' }}">
    </div>

    {{-- 12. Pendokumentasi --}}
    <div class="col-md-3">
        <label class="form-label">Pendokumentasi <span class="text-muted small">(nama mahasiswa)</span></label>
        <input type="text" name="pendokumentasi" class="form-control" value="{{ $val('pendokumentasi') }}">
    </div>

    {{-- 13. Sumber --}}
    <div class="col-md-6">
        <label class="form-label">Sumber <span class="text-muted small">(asal informasi)</span></label>
        <input type="text" name="sumber" class="form-control" value="{{ $val('sumber') }}">
    </div>

    {{-- 14. Status entri --}}
    <div class="col-md-4">
        <label class="form-label">Status Entri <span class="text-danger">*</span></label>
        <select name="status_etis" class="form-select" required>
            @foreach (\App\Models\KearifanLokal::STATUS_ETIS as $s)
                <option value="{{ $s }}" @selected($val('status_etis', 'Umum') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <div class="form-text">Sakral tidak ditampilkan ke publik.</div>
    </div>

    {{-- 16. Catatan --}}
    <div class="col-12">
        <label class="form-label">Catatan / Relasi</label>
        <textarea name="catatan" class="form-control" rows="2">{{ $val('catatan') }}</textarea>
    </div>
</div>