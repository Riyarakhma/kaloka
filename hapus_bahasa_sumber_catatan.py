#!/usr/bin/env python3
def ganti(path, old, new):
    with open(path, 'r', encoding='utf-8') as f:
        isi = f.read()

    jumlah = isi.count(old)

    if jumlah == 0:
        print(f"[DILEWATI - tidak ketemu] {path}")
        return
    if jumlah > 1:
        print(f"[BAHAYA - ketemu {jumlah}x, dilewati demi keamanan] {path}")
        return

    isi = isi.replace(old, new)
    with open(path, 'w', encoding='utf-8') as f:
        f.write(isi)
    print(f"[OK - diperbarui] {path}")


# ── 1. Model ──────────────────────────────────────────────
ganti(
    'app/Models/KearifanLokal.php',
    "        'lokasi',\n        'bahasa',\n        'berkas_media',",
    "        'lokasi',\n        'berkas_media',",
)
ganti(
    'app/Models/KearifanLokal.php',
    "        'pendokumentasi',\n        'sumber',\n        'status_etis',",
    "        'pendokumentasi',\n        'status_etis',",
)
ganti(
    'app/Models/KearifanLokal.php',
    "        'status_kurasi',\n        'catatan',\n        'dibuat_oleh',",
    "        'status_kurasi',\n        'dibuat_oleh',",
)

# ── 2. FormRequest ────────────────────────────────────────
ganti(
    'app/Http/Requests/KearifanLokalRequest.php',
    "\n            'bahasa' => [\n                'nullable',\n                'string',\n                'max:255',\n            ],\n",
    "\n",
)
ganti(
    'app/Http/Requests/KearifanLokalRequest.php',
    "\n            'sumber' => [\n                'nullable',\n                'string',\n                'max:255',\n            ],\n",
    "\n",
)
ganti(
    'app/Http/Requests/KearifanLokalRequest.php',
    "\n            'catatan' => [\n                'nullable',\n                'string',\n            ],\n",
    "\n",
)
ganti(
    'app/Http/Requests/KearifanLokalRequest.php',
    "            'bahasa' => 'bahasa',\n",
    "",
)
ganti(
    'app/Http/Requests/KearifanLokalRequest.php',
    "            'sumber' => 'sumber',\n",
    "",
)

# ── 3. Form tambah/ubah (_form.blade.php) ────────────────
ganti(
    'resources/views/pengelola/kearifan/_form.blade.php',
    """    {{-- Bahasa --}}
    <div class="col-md-3">
        <label for="bahasa" class="form-label">
            Bahasa
        </label>

        <input
            type="text"
            name="bahasa"
            id="bahasa"
            class="form-control @error('bahasa') is-invalid @enderror"
            value="{{ $val('bahasa', 'Indonesia') }}"
        >

        @error('bahasa')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

""",
    "",
)
ganti(
    'resources/views/pengelola/kearifan/_form.blade.php',
    """    {{-- Sumber --}}
    <div class="col-md-6">
        <label for="sumber" class="form-label">
            Sumber
        </label>

        <input
            type="text"
            name="sumber"
            id="sumber"
            class="form-control @error('sumber') is-invalid @enderror"
            value="{{ $val('sumber') }}"
            placeholder="Asal informasi"
        >

        @error('sumber')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

""",
    "",
)
ganti(
    'resources/views/pengelola/kearifan/_form.blade.php',
    """    {{-- Catatan --}}
    <div class="col-12">
        <label for="catatan" class="form-label">
            Catatan atau Relasi
        </label>

        <textarea
            name="catatan"
            id="catatan"
            class="form-control @error('catatan') is-invalid @enderror"
            rows="2"
        >{{ $val('catatan') }}</textarea>

        @error('catatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
""",
    "",
)

# ── 4. Halaman detail dashboard (show.blade.php) ─────────
ganti(
    'resources/views/pengelola/kearifan/show.blade.php',
    '                    <li class="list-group-item"><strong>Bahasa:</strong> {{ $entri->bahasa ?: \'—\' }}</li>\n',
    '',
)
ganti(
    'resources/views/pengelola/kearifan/show.blade.php',
    '                    <li class="list-group-item"><strong>Sumber:</strong> {{ $entri->sumber ?: \'—\' }}</li>\n',
    '',
)
ganti(
    'resources/views/pengelola/kearifan/show.blade.php',
    """                    @if ($entri->catatan)
                        <div class="alert alert-light border small mb-0">
                            <strong>Catatan/Relasi:</strong> {{ $entri->catatan }}
                        </div>
                    @endif
""",
    "",
)

# ── 5. Halaman detail publik (show.blade.php) ────────────
ganti(
    'resources/views/publik/kearifan/show.blade.php',
    """        <li class="list-group-item">
            <strong>Bahasa:</strong>
            {{ $entri->bahasa ?: '—' }}
        </li>
""",
    "",
)
ganti(
    'resources/views/publik/kearifan/show.blade.php',
    """        <li class="list-group-item">
            <strong>Sumber:</strong>
            {{ $entri->sumber ?: '—' }}
        </li>
""",
    "",
)

print("\nSelesai. Cek hasilnya dengan: git diff")
