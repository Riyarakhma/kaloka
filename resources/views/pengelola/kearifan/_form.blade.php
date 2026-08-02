@php
    /** @var \App\Models\KearifanLokal|null $entri */

    $entri = $entri ?? null;

    $val = function ($key, $default = '') use ($entri) {
        return old(
            $key,
            $entri?->{$key} ?? $default
        );
    };

    $fotoSekarang = $entri?->urlMedia();
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali isian berikut:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    {{-- Judul --}}
    <div class="col-md-8">
        <label for="judul" class="form-label">
            Judul
            <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="judul"
            id="judul"
            class="form-control @error('judul') is-invalid @enderror"
            value="{{ $val('judul') }}"
            required
        >

        @error('judul')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Dimensi --}}
    <div class="col-md-4">
        <label for="dimensi" class="form-label">
            Dimensi
            <span class="text-danger">*</span>
        </label>

        <select
            name="dimensi"
            id="dimensi"
            class="form-select @error('dimensi') is-invalid @enderror"
            required
        >
            <option value="">
                — pilih —
            </option>

            @foreach (\App\Models\KearifanLokal::DIMENSI as $dimensi)
                <option
                    value="{{ $dimensi }}"
                    @selected($val('dimensi') === $dimensi)
                >
                    {{ $dimensi }}
                </option>
            @endforeach
        </select>

        @error('dimensi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div class="col-12">
        <label for="deskripsi" class="form-label">
            Deskripsi
            <span class="text-danger">*</span>
        </label>

        <textarea
            name="deskripsi"
            id="deskripsi"
            class="form-control @error('deskripsi') is-invalid @enderror"
            rows="5"
            required
        >{{ $val('deskripsi') }}</textarea>

        @error('deskripsi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Kata Kunci --}}
    <div class="col-md-6">
        <label for="kata_kunci" class="form-label">
            Kata Kunci
            <span class="text-muted small">
                (pisahkan dengan koma)
            </span>
        </label>

        <input
            type="text"
            name="kata_kunci"
            id="kata_kunci"
            class="form-control @error('kata_kunci') is-invalid @enderror"
            value="{{ $val('kata_kunci') }}"
            placeholder="misalnya: mina padi, tradisi, gotong royong"
        >

        @error('kata_kunci')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Narasumber --}}
    <div class="col-md-6">
        <label for="narasumber" class="form-label">
            Narasumber
        </label>

        <input
            type="text"
            name="narasumber"
            id="narasumber"
            class="form-control @error('narasumber') is-invalid @enderror"
            value="{{ $val('narasumber') }}"
        >

        @error('narasumber')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Lokasi --}}
    <div class="col-md-6">
        <label for="lokasi" class="form-label">
            Lokasi
            <span class="text-muted small">
                (dukuh atau koordinat)
            </span>
        </label>

        <input
            type="text"
            name="lokasi"
            id="lokasi"
            class="form-control @error('lokasi') is-invalid @enderror"
            value="{{ $val('lokasi') }}"
        >

        @error('lokasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Foto --}}
    <div class="col-md-6">
        <label for="berkas_media" class="form-label">
            Foto
            <span class="text-muted small">
                (opsional, maksimal 20 MB)
            </span>
        </label>

        <input
            type="file"
            name="berkas_media"
            id="berkas_media"
            class="form-control @error('berkas_media') is-invalid @enderror"
            accept="image/jpeg,image/png,image/webp"
            onchange="previewFotoKearifan(event)"
        >

        @error('berkas_media')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <div class="form-text">
            Unggah foto baru untuk mengganti foto lama.
        </div>

        <img
            id="previewFotoKearifanImg"
            src="{{ $fotoSekarang ?? '' }}"
            alt="Pratinjau foto"
            class="rounded border mt-3 {{ $fotoSekarang ? '' : 'd-none' }}"
            style="
                width: 180px;
                height: 130px;
                object-fit: cover;
            "
        >
    </div>

    {{-- Dokumen PDF --}}
    <div class="col-md-6">
        <label for="dokumen" class="form-label">
            Dokumen PDF
            <span class="text-muted small">
                (opsional, maksimal 20 MB)
            </span>
        </label>

        <input
            type="file"
            name="dokumen"
            id="dokumen"
            class="form-control @error('dokumen') is-invalid @enderror"
            accept="application/pdf"
        >

        @error('dokumen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        @if ($entri && $entri->dokumen)
            <div class="form-text mt-2">
                Dokumen saat ini:

                <a
                    href="{{ $entri->urlDokumen() }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    {{ basename($entri->dokumen) }}
                </a>
            </div>
        @endif
    </div>

    {{-- Tanggal Dokumentasi --}}
    <div class="col-md-3">
        <label for="tanggal_dokumentasi" class="form-label">
            Tanggal Dokumentasi
        </label>

        <input
            type="date"
            name="tanggal_dokumentasi"
            id="tanggal_dokumentasi"
            class="form-control @error('tanggal_dokumentasi') is-invalid @enderror"
            value="{{
                $val('tanggal_dokumentasi')
                    ? \Illuminate\Support\Carbon::parse(
                        $val('tanggal_dokumentasi')
                    )->format('Y-m-d')
                    : ''
            }}"
        >

        @error('tanggal_dokumentasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Status Etis --}}
    <div class="col-md-4">
        <label for="status_etis" class="form-label">
            Status Entri
            <span class="text-danger">*</span>
        </label>

        <select
            name="status_etis"
            id="status_etis"
            class="form-select @error('status_etis') is-invalid @enderror"
            required
        >
            @foreach (\App\Models\KearifanLokal::STATUS_ETIS as $status)
                <option
                    value="{{ $status }}"
                    @selected($val('status_etis', 'Umum') === $status)
                >
                    {{ $status }}
                </option>
            @endforeach
        </select>

        <div class="form-text">
            Entri berstatus Sakral tidak ditampilkan di portal publik.
        </div>

        @error('status_etis')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

<script>
    function previewFotoKearifan(event) {
        const file = event.target.files?.[0];
        const preview = document.getElementById(
            'previewFotoKearifanImg'
        );

        if (!file || !preview) {
            return;
        }

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    }
</script>