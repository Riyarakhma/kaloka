# KALOKA — Portal Kearifan & Literasi Lokal Desa Sobokerto

Aplikasi web **custom** untuk **Perpustakaan Desa Sobokerto** (Kec. Ngemplak, Kab. Boyolali — kawasan **Waduk Cengklik**), bagian dari sistem perpustakaan desa berarsitektur **HIBRIDA**.

> **Arsitektur Hibrida — penting:** Sistem ini terdiri dari **dua aplikasi terpisah**:
> 1. **SLiMS** (Senayan Library Management System) — menangani **katalog/OPAC, sirkulasi, keanggotaan**. Dipasang terpisah, **bukan** bagian dari kode ini. Lihat [INSTALASI-SLIMS.md](INSTALASI-SLIMS.md).
> 2. **KALOKA custom** (repo ini) — **Repositori Kearifan Lokal, Info Wisata, Dashboard, dan Portal** penyatu yang menautkan ke OPAC SLiMS.
>
> Katalog **memakai SLiMS**; KALOKA hanya menautkannya lewat URL yang bisa diatur di Pengaturan.

## Fitur
- **Portal publik penyatu**: beranda dengan akses Katalog (SLiMS), Kearifan Lokal, Wisata + cuplikan terbaru.
- **Repositori Kearifan Lokal**: skema metadata **16 field**, alur kurasi (Draf → Terverifikasi → Terbit), proteksi status etis (Umum/Terbatas/Sakral), unggah media, filter & pencarian.
- **Info Wisata**: kategori, banyak foto, galeri, peta, status tampil/sembunyi.
- **Dashboard admin**: statistik KALOKA, tautan & opsi statistik SLiMS, manajemen pengguna, pengaturan situs.
- **Peran**: `admin` (akses penuh) & `pengelola` (kelola konten). Registrasi publik dinonaktifkan.

## Kebutuhan Sistem
- PHP **8.2+** (dikembangkan pada 8.3) dengan ekstensi: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, fileinfo, gd
- **MySQL/MariaDB** (database `kaloka_db`, terpisah dari DB SLiMS)
- **Composer** 2.x
- Web server (Laragon/XAMPP untuk lokal; Apache/Nginx untuk produksi)

> Tampilan memakai **Bootstrap 5 via CDN** — tidak perlu `npm`/build untuk menjalankan.

## Instalasi (Lokal)
```bash
# 1. Ambil kode
git clone <url-repo> kaloka && cd kaloka

# 2. Dependensi PHP
composer install

# 3. Konfigurasi lingkungan
cp .env.example .env
php artisan key:generate
# Edit .env: DB_DATABASE=kaloka_db, DB_USERNAME, DB_PASSWORD sesuai server Anda

# 4. Siapkan database (buat DB kosong 'kaloka_db' lebih dulu), lalu:
php artisan migrate --seed

# 5. Tautkan storage (agar berkas/foto bisa diakses publik)
php artisan storage:link

# 6. Jalankan
php artisan serve
```
Buka http://localhost:8000

## Akun Default (ganti setelah login)
| Peran | Email | Kata Sandi |
|-------|-------|-----------|
| Admin | `admin@kaloka.test` | `admin12345` |
| Pengelola | `pengelola@kaloka.test` | `pengelola12345` |

## Struktur Modul
```
app/
  Http/Controllers/
    PortalController.php          # Beranda/portal publik
    DashboardController.php       # Dashboard + statistik
    PenggunaController.php        # Manajemen pengguna (admin)
    PengaturanController.php      # Pengaturan situs (admin)
    Publik/                      # Halaman publik (kearifan, wisata)
    Pengelola/                   # CRUD pengelola (kearifan, wisata)
  Models/  KearifanLokal.php, Wisata.php, Pengaturan.php, User.php
  Http/Middleware/CekPeran.php   # Pembatas akses berdasarkan peran
database/
  migrations/                    # users(+role), kearifan_lokal, wisata, pengaturan
  seeders/                       # User, Pengaturan, KearifanLokal, Wisata
resources/views/
  layouts/ (publik, admin, app)  # Bootstrap 5 (CDN)
  beranda, publik/, pengelola/, auth/
config/database.php              # koneksi 'mysql' (KALOKA) + 'slims' (opsional, read-only)
```

## Skema Metadata Kearifan Lokal (16 field)
`kode_entri` · `judul` · `dimensi` · `deskripsi` · `kata_kunci` · `narasumber` · `lokasi` · `bahasa` · `jenis_media` · `berkas_media` · `tanggal_dokumentasi` · `pendokumentasi` · `sumber` · `status_etis` · `status_kurasi` · `catatan`

## Pengujian
```bash
php artisan test
```

## Dokumentasi Lain
- [PANDUAN-PENGGUNA.md](PANDUAN-PENGGUNA.md) — panduan untuk pengelola desa
- [DEPLOY.md](DEPLOY.md) — penempatan KALOKA + SLiMS satu domain & checklist keamanan
- [DEPLOY-CPANEL.md](DEPLOY-CPANEL.md) — panduan deploy khusus **shared hosting cPanel** (mis. kaloka.my.id)
- [INSTALASI-SLIMS.md](INSTALASI-SLIMS.md) — memasang & mengonfigurasi SLiMS
- [CLAUDE.md](CLAUDE.md) — konteks & arsitektur proyek

---
Dikembangkan dalam rangka **KKN Tematik** untuk Perpustakaan Desa Sobokerto.
