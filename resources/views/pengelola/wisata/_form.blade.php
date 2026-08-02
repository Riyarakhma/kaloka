@php
    /** @var \App\Models\Wisata|null $wisata */

    $wisata = $wisata ?? null;

    $val = function ($key, $default = '') use ($wisata) {
        return old($key, $wisata?->{$key} ?? $default);
    };

    $fotoSekarang = $wisata?->fotoUtama();
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali data berikut:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    {{-- Nama Spot --}}
    <div class="col-md-8">
        <label for="nama_spot" class="form-label">
            Nama Spot
            <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="nama_spot"
            id="nama_spot"
            class="form-control @error('nama_spot') is-invalid @enderror"
            value="{{ $val('nama_spot') }}"
            required
        >

        @error('nama_spot')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Kategori --}}
    <div class="col-md-4">
        <label for="kategori" class="form-label">
            Kategori
            <span class="text-danger">*</span>
        </label>

        <select
            name="kategori"
            id="kategori"
            class="form-select @error('kategori') is-invalid @enderror"
            required
        >
            <option value="">— Pilih kategori —</option>

            @foreach (\App\Models\Wisata::KATEGORI as $kategori)
                <option
                    value="{{ $kategori }}"
                    @selected($val('kategori') === $kategori)
                >
                    {{ $kategori }}
                </option>
            @endforeach
        </select>

        @error('kategori')
            <div class="invalid-feedback">{{ $message }}</div>
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
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Lokasi --}}
    <div class="col-md-6">
        <label for="lokasi" class="form-label">
            Lokasi
        </label>

        <input
            type="text"
            name="lokasi"
            id="lokasi"
            class="form-control @error('lokasi') is-invalid @enderror"
            value="{{ $val('lokasi') }}"
            placeholder="Contoh: Ngemplak, Boyolali"
        >

        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Google Maps --}}
    <div class="col-12">
        <label for="google_maps" class="form-label">
            Link Google Maps
        </label>

        <input
            type="text"
            name="google_maps"
            id="google_maps"
            class="form-control @error('google_maps') is-invalid @enderror"
            value="{{ $val('google_maps') }}"
            placeholder="https://maps.google.com/... atau https://maps.app.goo.gl/..."
        >

        <div class="form-text">
            Tempel link Google Maps lokasi wisata. Jika dikosongkan, sistem memakai koordinat.
        </div>

        @error('google_maps')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Jam Operasional --}}
    <div class="col-12">
        <label class="form-label">Jam Operasional <span class="text-muted small">(opsional, atur per hari)</span></label>

        <div id="daftarOperasionalWisata" class="d-flex flex-column gap-2">
            @php $barisJam = old('jam_operasional', $wisata->jam_operasional ?? []); @endphp
            @if (empty($barisJam))
                @php $barisJam = [['hari' => '', 'jam' => '']]; @endphp
            @endif

            @foreach ($barisJam as $i => $b)
                <div class="row g-2 align-items-center baris-operasional-wisata">
                    <div class="col-5">
                        <input type="text" name="jam_operasional[{{ $i }}][hari]" class="form-control form-control-sm"
                               value="{{ $b['hari'] ?? '' }}" placeholder="mis. Senin–Jumat">
                    </div>
                    <div class="col-5">
                        <input type="text" name="jam_operasional[{{ $i }}][jam]" class="form-control form-control-sm"
                               value="{{ $b['jam'] ?? '' }}" placeholder="mis. 06.00–18.00">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.baris-operasional-wisata').remove()">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-sm btn-outline-kaloka mt-2" onclick="tambahBarisOperasionalWisata()">
            <i class="bi bi-plus-lg me-1"></i>Tambah Baris
        </button>

        <div class="form-text">Contoh: "Senin–Jumat" / "06.00–18.00", baris berikutnya "Sabtu–Minggu" / "08.00–20.00".</div>
    </div>

    <script>
        let indexOperasionalWisata = document.querySelectorAll('#daftarOperasionalWisata .baris-operasional-wisata').length;

        function tambahBarisOperasionalWisata() {
            const container = document.getElementById('daftarOperasionalWisata');
            const div = document.createElement('div');
            div.className = 'row g-2 align-items-center baris-operasional-wisata';
            div.innerHTML = `
                <div class="col-5">
                    <input type="text" name="jam_operasional[${indexOperasionalWisata}][hari]" class="form-control form-control-sm" placeholder="mis. Sabtu–Minggu">
                </div>
                <div class="col-5">
                    <input type="text" name="jam_operasional[${indexOperasionalWisata}][jam]" class="form-control form-control-sm" placeholder="mis. 08.00–20.00">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.baris-operasional-wisata').remove()">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(div);
            indexOperasionalWisata++;
        }
    </script>

    {{-- Kontak --}}
    <div class="col-md-6">
        <label for="kontak" class="form-label">
            Kontak
        </label>

        <input
            type="text"
            name="kontak"
            id="kontak"
            class="form-control @error('kontak') is-invalid @enderror"
            value="{{ $val('kontak') }}"
            placeholder="Nomor telepon atau nama pengelola"
        >

        @error('kontak')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Sosial Media --}}
    <div class="col-12">
        <label for="sosial_media" class="form-label">
            Sosial Media
        </label>

        <input
            type="text"
            name="sosial_media"
            id="sosial_media"
            class="form-control @error('sosial_media') is-invalid @enderror"
            value="{{ $val('sosial_media') }}"
            placeholder="Contoh: https://instagram.com/namaakun atau @namaakun"
        >

        @error('sosial_media')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Menu --}}
    <div class="col-md-6">
        <label for="menu_file" class="form-label">
            Menu <span class="text-muted small">(unggah PDF atau foto, opsional)</span>
        </label>

        <input
            type="file"
            name="menu_file"
            id="menu_file"
            class="form-control @error('menu_file') is-invalid @enderror"
            accept=".pdf,image/jpeg,image/png,image/webp"
        >

        @if ($wisata && $wisata->menu_file)
            <div class="form-text">
                Menu saat ini: <a href="{{ $wisata->urlMenu() }}" target="_blank">lihat</a>
                — unggah baru untuk mengganti.
            </div>
        @endif

        @error('menu_file')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Fasilitas --}}
    <div class="col-md-6">
        <label for="fasilitas" class="form-label">
            Fasilitas
        </label>

        <textarea
            name="fasilitas"
            id="fasilitas"
            class="form-control @error('fasilitas') is-invalid @enderror"
            rows="4"
            placeholder="Contoh: area parkir, toilet, musala, gazebo"
        >{{ $val('fasilitas') }}</textarea>

        @error('fasilitas')
            <div class="invalid-feedback">{{ $message }}</div>
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
            placeholder="Nama narasumber atau pengelola"
        >

        @error('narasumber')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Status Etis --}}
    <div class="col-md-6">
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
            @foreach (\App\Models\Wisata::STATUS_ETIS as $status)
                <option
                    value="{{ $status }}"
                    @selected($val('status_etis', 'Umum') === $status)
                >
                    {{ $status }}
                </option>
            @endforeach
        </select>

        @error('status_etis')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Terjemahan Inggris --}}
    <div class="col-12">
        <hr class="my-3">

        <h5 class="mb-0">
            Terjemahan Bahasa Inggris
            <span class="text-muted small">(opsional)</span>
        </h5>
    </div>

    <div class="col-md-6">
        <label for="nama_spot_en" class="form-label">
            Nama Spot (EN)
        </label>

        <input
            type="text"
            name="nama_spot_en"
            id="nama_spot_en"
            class="form-control"
            value="{{ $val('nama_spot_en') }}"
        >
    </div>

    <div class="col-md-6">
        <label for="lokasi_en" class="form-label">
            Lokasi (EN)
        </label>

        <input
            type="text"
            name="lokasi_en"
            id="lokasi_en"
            class="form-control"
            value="{{ $val('lokasi_en') }}"
        >
    </div>

    <div class="col-12">
        <label for="deskripsi_en" class="form-label">
            Deskripsi (EN)
        </label>

        <textarea
            name="deskripsi_en"
            id="deskripsi_en"
            class="form-control"
            rows="5"
        >{{ $val('deskripsi_en') }}</textarea>
    </div>

    <div class="col-md-6">
        <label for="jam_operasional_en" class="form-label">
            Jam Operasional (EN)
        </label>

        <input
            type="text"
            name="jam_operasional_en"
            id="jam_operasional_en"
            class="form-control"
            value="{{ $val('jam_operasional_en') }}"
        >
    </div>

    <div class="col-md-6">
        <label for="kontak_en" class="form-label">
            Kontak (EN)
        </label>

        <input
            type="text"
            name="kontak_en"
            id="kontak_en"
            class="form-control"
            value="{{ $val('kontak_en') }}"
        >
    </div>

    {{-- Foto --}}
    <div class="col-12">
        <hr class="my-3">
    </div>

   <div class="col-12">
        <label class="form-label">Foto <span class="text-muted small">(boleh pilih beberapa sekaligus, maks 10 foto, maks 20 MB per foto)</span></label>
        @if ($wisata && $wisata->foto)
            <div class="form-text mb-2">Foto yang sudah ada — centang untuk menghapus:</div>
            <div class="d-flex flex-wrap gap-3 mb-3">
                @foreach ($wisata->urlFoto() as $i => $url)
                    <label class="text-center" style="cursor:pointer;">
                        <img src="{{ $url }}" alt="Foto {{ $i + 1 }}" class="rounded border d-block mb-1"
                             style="width:120px;height:90px;object-fit:cover;">
                        <span class="d-inline-flex align-items-center gap-1 small text-danger">
                            <input type="checkbox" name="hapus_foto[]" value="{{ $wisata->foto[$i] }}">
                            Hapus
                        </span>
                    </label>
                @endforeach
            </div>
        @endif
        <input type="file" name="foto[]" id="inputFotoWisata" class="form-control @error('foto') is-invalid @enderror"
               accept="image/*" multiple onchange="previewFotoWisata(event)">
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Foto baru yang diunggah akan ditambahkan (bukan mengganti semua foto lama).</div>
        <div id="previewFotoBaruWisata" class="d-flex flex-wrap gap-3 mt-2"></div>
    </div>
</div>
<script>
    function previewFotoWisata(event) {
        const wadah = document.getElementById('previewFotoBaruWisata');
        wadah.innerHTML = '';
        Array.from(event.target.files).forEach((file) => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'rounded border';
            img.style.cssText = 'width:120px;height:90px;object-fit:cover;';
            wadah.appendChild(img);
        });
    }
</script>