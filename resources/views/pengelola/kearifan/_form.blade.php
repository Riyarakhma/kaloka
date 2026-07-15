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

    {{-- 9. Jenis media --}}
    <div class="col-md-3">
        <label class="form-label">Jenis Media <span class="text-danger">*</span></label>
        <select name="jenis_media" class="form-select" required>
            @foreach (\App\Models\KearifanLokal::JENIS_MEDIA as $m)
                <option value="{{ $m }}" @selected($val('jenis_media', 'Teks') === $m)>{{ $m }}</option>
            @endforeach
        </select>
    </div>

    {{-- 10. Berkas media --}}
    <div class="col-md-6">
        <label class="form-label">Berkas Media <span class="text-muted small">(opsional, maks 20 MB)</span></label>
        <input type="file" name="berkas_media" class="form-control">
        @if ($entri && $entri->berkas_media)
            <div class="form-text">
                Berkas saat ini: <a href="{{ $entri->urlMedia() }}" target="_blank">lihat</a>
                — unggah baru untuk mengganti.
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

    {{-- 14. Status etis --}}
    <div class="col-md-3">
        <label class="form-label">Status Etis <span class="text-danger">*</span></label>
        <select name="status_etis" class="form-select" required>
            @foreach (\App\Models\KearifanLokal::STATUS_ETIS as $s)
                <option value="{{ $s }}" @selected($val('status_etis', 'Umum') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <div class="form-text">Terbatas/Sakral tidak ditampilkan ke publik.</div>
    </div>

    {{-- 15. Status kurasi --}}
    <div class="col-md-3">
        <label class="form-label">Status Kurasi <span class="text-danger">*</span></label>
        <select name="status_kurasi" class="form-select" required>
            @foreach (\App\Models\KearifanLokal::STATUS_KURASI as $s)
                <option value="{{ $s }}" @selected($val('status_kurasi', 'Draf') === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <div class="form-text">Hanya "Terbit" yang tampil publik.</div>
    </div>

    {{-- 16. Catatan --}}
    <div class="col-12">
        <label class="form-label">Catatan / Relasi</label>
        <textarea name="catatan" class="form-control" rows="2">{{ $val('catatan') }}</textarea>
    </div>
</div>
