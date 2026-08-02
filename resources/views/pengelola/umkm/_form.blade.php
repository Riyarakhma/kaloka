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
        <label class="form-label">Dimensi <span class="text-danger">*</span></label>
        <select name="kategori" class="form-select" required>
            <option value="">— Pilih dimensi —</option>
            @foreach (\App\Models\Umkm::KATEGORI as $k)
                <option value="{{ $k }}" @selected($val('kategori') === $k)>{{ $k }}</option>
            @endforeach
        </select>
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

    <div class="col-md-4">
        <label class="form-label">Sosial Media <span class="text-muted small">(opsional)</span></label>
        <input type="text" name="sosial_media" class="form-control" value="{{ $val('sosial_media') }}"
               placeholder="@NgudiMakmur (Instagram)">
    </div>

   <div class="col-12">
        <label class="form-label">Operasional <span class="text-muted small">(opsional, atur per hari)</span></label>

        <div id="daftarOperasional" class="d-flex flex-column gap-2">
            @php $baris = old('jam_operasional', $entri->jam_operasional ?? []); @endphp
            @if (empty($baris))
                @php $baris = [['hari' => '', 'jam' => '']]; @endphp
            @endif

            @foreach ($baris as $i => $b)
                <div class="row g-2 align-items-center baris-operasional">
                    <div class="col-5">
                        <input type="text" name="jam_operasional[{{ $i }}][hari]" class="form-control form-control-sm"
                               value="{{ $b['hari'] ?? '' }}" placeholder="mis. Senin–Kamis">
                    </div>
                    <div class="col-5">
                        <input type="text" name="jam_operasional[{{ $i }}][jam]" class="form-control form-control-sm"
                               value="{{ $b['jam'] ?? '' }}" placeholder="mis. 06.00–17.00">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.baris-operasional').remove()">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-sm btn-outline-kaloka mt-2" onclick="tambahBarisOperasional()">
            <i class="bi bi-plus-lg me-1"></i>Tambah Baris
        </button>

        <div class="form-text">Contoh: "Senin–Kamis" / "06.00–17.00", baris berikutnya "Jumat" / "17.00–21.00", dst.</div>
    </div>

    <script>
        let indexOperasional = document.querySelectorAll('#daftarOperasional .baris-operasional').length;

        function tambahBarisOperasional() {
            const container = document.getElementById('daftarOperasional');
            const div = document.createElement('div');
            div.className = 'row g-2 align-items-center baris-operasional';
            div.innerHTML = `
                <div class="col-5">
                    <input type="text" name="jam_operasional[${indexOperasional}][hari]" class="form-control form-control-sm" placeholder="mis. Jumat">
                </div>
                <div class="col-5">
                    <input type="text" name="jam_operasional[${indexOperasional}][jam]" class="form-control form-control-sm" placeholder="mis. 17.00–21.00">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.baris-operasional').remove()">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(div);
            indexOperasional++;
        }
    </script>

    <div class="col-12">
        <label class="form-label">Produk <span class="text-muted small">(opsional, boleh tambah lebih dari satu)</span></label>

        <div id="daftarProduk"></div>

        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="tambahBarisProduk()">
            + Tambah Produk
        </button>

        <template id="templateBarisProduk">
            <div class="row g-2 align-items-start baris-produk border rounded p-2 mb-2 mx-0">
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm" data-field="nama"
                           placeholder="Nama produk">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control form-control-sm" data-field="deskripsi"
                           placeholder="Deskripsi singkat (opsional)">
                </div>
                <div class="col-md-2">
                    <input type="number" min="0" class="form-control form-control-sm" data-field="harga"
                           placeholder="Harga (Rp, opsional)">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.baris-produk').remove()">
                        &times;
                    </button>
                </div>
            </div>
        </template>
    </div>

    <script>
        function tambahBarisProduk(data = {}) {
            const tpl = document.getElementById('templateBarisProduk');
            const node = tpl.content.cloneNode(true);
            const baris = node.querySelector('.baris-produk');

            baris.querySelector('[data-field="nama"]').value = data.nama ?? '';
            baris.querySelector('[data-field="deskripsi"]').value = data.deskripsi ?? '';
            baris.querySelector('[data-field="harga"]').value = data.harga ?? '';

            document.getElementById('daftarProduk').appendChild(node);
        }

        // Prefill dari data lama (edit) atau input lama (validasi gagal).
        const produkAwal = @json($val('produk', []) ?: []);
        if (Array.isArray(produkAwal) && produkAwal.length > 0) {
            produkAwal.forEach(tambahBarisProduk);
        }

        // Susun ulang input jadi produk[index][field] sebelum form dikirim.
        // PENTING: pakai id spesifik #formUmkm, bukan querySelector('form') —
        // ada form logout tersembunyi di navbar yang render lebih dulu di HTML,
        // jadi querySelector('form') akan salah ambil form itu.
        document.getElementById('formUmkm').addEventListener('submit', function () {
            document.querySelectorAll('#daftarProduk input[name^="produk"]').forEach(el => el.remove());

            document.querySelectorAll('#daftarProduk .baris-produk').forEach((baris, index) => {
                ['nama', 'deskripsi', 'harga'].forEach(field => {
                    const sumber = baris.querySelector(`[data-field="${field}"]`);
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = `produk[${index}][${field}]`;
                    hidden.value = sumber.value;
                    baris.appendChild(hidden);
                });
            });
        });
    </script>

    <div class="col-12">
        <label class="form-label">Link Google Maps <span class="text-muted small">(opsional)</span></label>
        <input type="url" name="link_maps" class="form-control" value="{{ $val('link_maps') }}"
               placeholder="https://maps.app.goo.gl/xxxxxxx">
        <div class="form-text">Buka Google Maps, cari lokasi, klik "Bagikan" → salin link, lalu tempel di sini.</div>
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
        <label class="form-label">Foto <span class="text-muted small">(boleh pilih beberapa sekaligus, maks 10 foto, maks 20 MB per foto)</span></label>

        @if ($entri && $entri->foto)
            <div class="form-text mb-2">Foto yang sudah ada — centang untuk menghapus:</div>
            <div class="d-flex flex-wrap gap-3 mb-3">
                @foreach ($entri->urlFoto() as $i => $url)
                    <label class="text-center" style="cursor:pointer;">
                        <img src="{{ $url }}" alt="Foto {{ $i + 1 }}" class="rounded border d-block mb-1"
                             style="width:120px;height:90px;object-fit:cover;">
                        <span class="d-inline-flex align-items-center gap-1 small text-danger">
                            <input type="checkbox" name="hapus_foto[]" value="{{ $entri->foto[$i] }}">
                            Hapus
                        </span>
                    </label>
                @endforeach
            </div>
        @endif

        <input type="file" name="foto[]" id="inputFoto" class="form-control" accept="image/*" multiple
               onchange="previewFotoUmkm(event)">
        <div class="form-text">Foto baru yang diunggah akan ditambahkan ke sampul (bukan mengganti semua foto lama).</div>
        <div id="previewFotoBaru" class="d-flex flex-wrap gap-3 mt-2"></div>
    </div>
    <script>
        function previewFotoUmkm(event) {
            const wadah = document.getElementById('previewFotoBaru');
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
</div>