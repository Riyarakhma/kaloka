# CLAUDE.md — Konteks Induk Proyek KALOKA

> Berkas ini adalah ringkasan konteks proyek. Baca lebih dulu sebelum menulis kode apa pun.

## Apa Itu KALOKA
**KALOKA** = *Kearifan dan Literasi Lokal Desa*. Aplikasi web untuk **Perpustakaan Desa Sobokerto**, Kecamatan Ngemplak, Kabupaten Boyolali (kawasan **Waduk Cengklik**), dibangun dalam rangka **KKN Tematik**.

## Arsitektur Hibrida (PENTING)
Sistem perpustakaan desa ini terdiri dari **DUA aplikasi terpisah dengan dua basis data**:

1. **SLiMS** (Senayan Library Management System) — aplikasi **TERPISAH** yang dipasang sendiri (manual, bukan dibangun di sini). Menangani **Katalog/OPAC, sirkulasi, keanggotaan, otomasi**. **KAMI TIDAK MEMBANGUN INI.** DB sendiri (mis. `slims_sobokerto`).
2. **KALOKA custom** (yang dibangun di repo ini) — menangani **Repositori Kearifan Lokal, Info Wisata, Dashboard, dan Portal penyatu**. DB sendiri: `kaloka_db`.

**Portal KALOKA** adalah halaman muka penyatu yang menautkan ke OPAC SLiMS, Repositori, dan Info Wisata sehingga terasa satu sistem.
**URL OPAC SLiMS disimpan sebagai pengaturan yang bisa diubah — JANGAN di-hardcode.**

```
                 ┌─────────────────────────────┐
                 │   PORTAL KALOKA (custom)    │  ← halaman muka penyatu
                 └──────────────┬──────────────┘
        ┌──────────────────────┼──────────────────────┐
        ▼                      ▼                      ▼
  ┌───────────┐        ┌───────────────┐      ┌───────────────┐
  │ SLiMS OPAC│        │ Repositori    │      │ Info Wisata   │
  │ (standalone)       │ Kearifan Lokal│      │ (custom)      │
  └───────────┘        └───────────────┘      └───────────────┘
    DB SLiMS               DB KALOKA (kaloka_db) ──────┘
```

## Tujuan Aplikasi Custom
1. Mendokumentasikan kearifan lokal desa (repositori dengan **skema metadata 16 field**).
2. Mempromosikan potensi wisata desa (Waduk Cengklik dan sekitarnya).
3. Dashboard admin untuk pengelolaan & statistik.
4. Portal publik yang menyatukan layanan (termasuk tautan ke katalog SLiMS).

## Pengguna
- **Publik**: pemustaka/warga & wisatawan (akses **hanya-baca**).
- **Pengelola**: mengelola entri kearifan lokal & wisata.
- **Admin desa**: semua hak pengelola + manajemen pengguna + pengaturan situs.

## Empat Dimensi Kearifan Lokal
1. Ekologi Waduk Cengklik
2. Pertanian & Pangan Lokal
3. Tradisi Lisan & Sejarah
4. Wisata Berbasis Komunitas

## Teknologi
- **Laravel** (versi stabil terbaru), **PHP 8.2+** (lokal: 8.3.16)
- **MySQL/MariaDB** — database `kaloka_db`, **terpisah** dari DB SLiMS
- **Blade + Bootstrap 5**
- Autentikasi: **laravel/ui** dengan Bootstrap (dua peran: `admin` & `pengelola`)

### Lingkungan Lokal (Laragon)
- PHP: `D:\laragon\bin\php\php-8.3.16-Win32-vs16-x64`
- MySQL server: `127.0.0.1:3306`, user `root`, **tanpa password** (catatan: client mysql default ke 3307, set port eksplisit di `.env`)
- Composer 2.8.9, Node 22

## Konvensi
- Nama tabel & kolom: **bahasa Indonesia, snake_case** (mis. `kearifan_lokal`, `wisata`, `pengaturan`).
- Komentar kode & pesan UI: **bahasa Indonesia**.
- Setiap fitur disertai **validasi input & penanganan error**.
- Kode mudah dibaca & dipelihara mahasiswa.

## Non-Fungsional
- **Responsif** (mobile-friendly).
- **Aman**: hanya pengguna login yang mengelola data; tampilan publik hanya-baca. Entri belum "Terbit" atau berstatus etis Terbatas/Sakral **TIDAK boleh bocor** ke publik.
- Mudah di-deploy ke hosting murah/VPS.

## Cara Kerja (Bertahap)
- Kerjakan **BERTAHAP** sesuai fase. Jangan membangun semua sekaligus.
- Akhir tiap fase: jalankan/validasi, jelaskan singkat, lalu tunggu instruksi.
- Selalu beri tahu perintah terminal yang perlu dijalankan.
- Commit Git di akhir tiap fase.

## Peta Fase
| Fase | Isi | Status |
|------|-----|--------|
| 0 | Konteks induk (berkas ini) | ✅ |
| 1 | Inisialisasi Laravel + kerangka layout publik/admin | ⏳ |
| 2 | Autentikasi & peran (admin/pengelola) | ⏳ |
| 3 | Repositori Kearifan Lokal (16 field + kurasi) | ⏳ |
| 4 | Info Wisata | ⏳ |
| 5 | Dashboard admin (+ tautan/baca SLiMS, pengaturan) | ⏳ |
| 6 | Portal publik penyatu | ⏳ |
| 7 | Data contoh, pengujian, perapian | ⏳ |
| 8 | Dokumentasi & deploy | ⏳ |

## Skema Metadata Kearifan Lokal (16 Field) — acuan Fase 3
1. `kode_entri` (unik, otomatis) · 2. `judul` · 3. `dimensi` · 4. `deskripsi` · 5. `kata_kunci` · 6. `narasumber` · 7. `lokasi` · 8. `bahasa` · 9. `jenis_media` · 10. `berkas_media` · 11. `tanggal_dokumentasi` · 12. `pendokumentasi` · 13. `sumber` · 14. `status_etis` (Umum|Terbatas|Sakral) · 15. `status_kurasi` (Draf|Terverifikasi|Terbit) · 16. `catatan`/relasi
