# Deploy KALOKA + SLiMS ke cPanel (domain: kaloka.my.id)

Panduan khusus **shared hosting cPanel**. Dua aplikasi, dua database, satu domain.

```
https://kaloka.my.id/          → Portal KALOKA (Laravel)
https://kaloka.my.id/katalog   → SLiMS (subfolder)     ← panduan ini memakai opsi ini
(alternatif: https://katalog.kaloka.my.id via subdomain)
```

> **Cek dulu:** di cPanel → **MultiPHP Manager**, set domain ke **PHP 8.2/8.3**. Di **Select PHP Version → Extensions**, aktifkan: `pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, fileinfo, gd, curl, bcmath`.
> Cek apakah ada menu **Terminal** (SSH). Panduan menyediakan jalur **dengan** dan **tanpa** Terminal.

---

## BAGIAN A — Persiapan di komputer lokal (sebelum upload)

### A1. Bangun dependency & rapikan
```bash
cd d:\laragon\www\kaloka
composer install --no-dev --optimize-autoloader
```
(Jika hosting tidak punya Composer/Terminal, folder `vendor/` hasil langkah ini ikut di-upload.)

### A2. Siapkan file .env produksi
Salin `.env.example` → `.env.production`, lalu isi:
```env
APP_NAME="KALOKA"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://kaloka.my.id

APP_LOCALE=id
APP_FALLBACK_LOCALE=id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=USER_kaloka        # nama DB dari cPanel (mis. sobokerto_kaloka)
DB_USERNAME=USER_kalokausr     # user DB dari cPanel
DB_PASSWORD=********

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# (opsional) statistik SLiMS di dashboard — akun MySQL ber-hak SELECT saja
SLIMS_DB_DATABASE=USER_slims
SLIMS_DB_USERNAME=USER_slimsro
SLIMS_DB_PASSWORD=********
```
> `APP_KEY` akan digenerate di server (langkah C3). Jika tidak ada Terminal, jalankan `php artisan key:generate --show` di lokal lalu tempel hasilnya ke `APP_KEY=` pada `.env`.

### A3. Ekspor database KALOKA (untuk diimpor via phpMyAdmin)
Jalankan lokal agar dapat struktur + data contoh:
```bash
php artisan migrate:fresh --seed   # pada DB lokal
```
Lalu ekspor:
```bash
mysqldump --no-defaults -u root kaloka_db > kaloka_db.sql
```
`kaloka_db.sql` akan diimpor ke DB produksi (langkah C4). *(Alternatif: kalau ada Terminal di server, lewati ekspor ini dan cukup `php artisan migrate --force --seed` di server.)*

---

## BAGIAN B — Buat Database di cPanel

cPanel → **MySQL® Databases**:
1. **Create New Database**: mis. `kaloka` → jadi `USER_kaloka`.
2. **Add New User**: mis. `kalokausr` + password kuat.
3. **Add User To Database** → beri **ALL PRIVILEGES**.
4. Ulangi untuk SLiMS: DB `slims`, user `slimsusr`.
5. (Opsional stat SLiMS) buat user `slimsro`, tambahkan ke DB slims dengan **hak SELECT saja**.

Catat nama DB & user (ada prefix `USER_`) → masukkan ke `.env` (A2).

---

## BAGIAN C — Upload & Pasang KALOKA (Laravel)

### Struktur di cPanel (trik folder public)
Laravel butuh `public/` sebagai web root, sedangkan cPanel memakai `public_html`. Cara paling aman:

```
/home/USER/
├── kaloka_app/           ← SELURUH isi proyek Laravel KECUALI isi public/
│   ├── app/ bootstrap/ config/ database/ routes/ vendor/ storage/ ...
│   └── .env
└── public_html/          ← isi folder public/ Laravel dipindah ke sini
    ├── index.php  (diedit, lihat C2)
    ├── .htaccess
    ├── css/ favicon.svg logo-kaloka.png storage(symlink)
    └── katalog/          ← SLiMS (Bagian D)
```

### C1. Upload
- Zip proyek, upload via **File Manager**, extract.
- Pindahkan **isi** folder `public/` ke `public_html/`.
- Pindahkan sisa proyek ke `kaloka_app/` (di luar `public_html`).
- Upload `.env.production` sebagai `kaloka_app/.env`.

### C2. Edit `public_html/index.php`
Sesuaikan dua path agar menunjuk ke `kaloka_app`:
```php
// require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../kaloka_app/vendor/autoload.php';

// $app = require_once __DIR__.'/../bootstrap/app.php';
$app = require_once __DIR__.'/../kaloka_app/bootstrap/app.php';
```

### C3. Kunci aplikasi
- **Ada Terminal**: `cd ~/kaloka_app && php artisan key:generate`
- **Tanpa Terminal**: tempel `APP_KEY=base64:...` (dari A2) ke `.env`.

### C4. Import database KALOKA
- **Ada Terminal**: `php artisan migrate --force --seed`
- **Tanpa Terminal**: cPanel → **phpMyAdmin** → pilih DB `USER_kaloka` → **Import** → unggah `kaloka_db.sql`.

### C5. Symlink storage (agar gambar/berkas tampil)
- **Ada Terminal**: `php artisan storage:link` (lalu pastikan symlink `public_html/storage` mengarah ke `kaloka_app/storage/app/public`).
- **Tanpa Terminal / symlink diblokir**: buat symlink lewat File Manager, atau tambahkan file `kaloka_app/public/link.php` sekali-jalan:
  ```php
  <?php symlink('/home/USER/kaloka_app/storage/app/public','/home/USER/public_html/storage'); echo 'ok';
  ```
  buka `https://kaloka.my.id/link.php` sekali, lalu **hapus** file itu.

### C6. Optimasi (jika ada Terminal)
```bash
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

### C7. Izin folder
Pastikan `kaloka_app/storage` dan `kaloka_app/bootstrap/cache` **writable** (755/775) via File Manager → Permissions.

Uji: buka **https://kaloka.my.id** → portal tampil.

---

## BAGIAN D — Pasang SLiMS di /katalog

1. Buat folder `public_html/katalog`, upload SLiMS ke situ (atau pakai **subdomain** `katalog.kaloka.my.id` dengan docroot `public_html/katalog`).
2. Import database SLiMS: phpMyAdmin → DB `USER_slims` → Import file `slims_umum_desa.sql` (ekspor dari lokal:
   `mysqldump --no-defaults -u root slims_umum_desa > slims_umum_desa.sql`).
3. Edit `katalog/config/database.php` → host `localhost`, database `USER_slims`, user `USER_slimsusr`, password.
4. Pastikan `katalog/config/env.php` → `$env='production'`.
5. Hapus/rename folder `katalog/install`.
6. Uji: **https://kaloka.my.id/katalog**.

---

## BAGIAN E — Ganti URL localhost → domain (PENTING)

Beberapa tautan masih `http://localhost:8000` / `localhost/SLIMS2026` dari masa pengembangan:

1. **Pengaturan KALOKA** (login admin → Pengaturan): **URL OPAC SLiMS** = `https://kaloka.my.id/katalog`.
2. **Template SLiMS** — ganti tautan portal (Kearifan Lokal, Wisata, Portal Desa) di:
   `katalog/template/default/parts/_navbar.php` dan `parts/_home.php`
   dari `http://localhost:8000` → `https://kaloka.my.id`.
   (Bisa via File Manager → Code Editor, cari-ganti.)
3. **Konten SLiMS** halaman Kontak juga memuat tautan `http://localhost:8000` → ganti ke `https://kaloka.my.id`.

---

## BAGIAN F — Checklist Keamanan (sebelum diumumkan)
- [ ] `APP_DEBUG=false`, `APP_ENV=production` di `.env`.
- [ ] `APP_KEY` terisi.
- [ ] **Ganti semua password default**: admin KALOKA (`admin@kaloka.test`), pengelola, dan admin SLiMS (`admin/admin12345`).
- [ ] HTTPS aktif (cPanel → **SSL/TLS Status** → jalankan AutoSSL/Let's Encrypt).
- [ ] Web root domain mengarah ke isi `public/` (bukan root proyek).
- [ ] Folder `storage/`, `bootstrap/cache` writable.
- [ ] URL localhost sudah diganti ke `kaloka.my.id` (Bagian E).
- [ ] **Backup rutin** kedua database (`kaloka` & `slims`) via cPanel → **Backup**.
- [ ] Hapus file bantu sekali-pakai (mis. `link.php`) dan folder `katalog/install`.

---

## Ringkas: DNS
Di pengelola domain `kaloka.my.id`, arahkan **A record** ke IP server hosting (dari cPanel → sidebar "Shared IP Address"), atau ganti **nameserver** ke nameserver hosting. Tunggu propagasi (bisa sampai 1×24 jam).
