# Panduan Deploy KALOKA + SLiMS (Satu Domain)

Dokumen ini menjelaskan cara menempatkan **Portal KALOKA** dan **SLiMS** pada **satu domain**, beserta konfigurasi database produksi untuk **kedua aplikasi** dan checklist keamanan.

> Arsitektur hibrida: **dua aplikasi, dua database**. KALOKA = Laravel (`kaloka_db`); SLiMS = aplikasi PHP terpisah (`slims_sobokerto`).

---

## 1. Skema Penempatan (pilih salah satu)

### Opsi A — Subfolder (paling sederhana)
- `https://namadesa.web.id/`         → **Portal KALOKA**
- `https://namadesa.web.id/katalog`  → **SLiMS**

Letakkan SLiMS di subfolder `katalog/` pada document root, KALOKA di root. Karena KALOKA Laravel menaruh entry-point di `public/`, atur web server agar root domain menunjuk ke `public/` KALOKA, dan `katalog/` ke folder SLiMS.

### Opsi B — Subdomain (lebih rapi)
- `https://namadesa.web.id/`         → **Portal KALOKA**
- `https://katalog.namadesa.web.id/` → **SLiMS**

Pada kedua opsi, isi **Pengaturan → URL OPAC SLiMS** di KALOKA dengan alamat OPAC yang sesuai.

---

## 2. Deploy KALOKA (Laravel)

```bash
# Di server
git clone <url-repo> kaloka && cd kaloka
composer install --no-dev --optimize-autoloader

cp .env.example .env
php artisan key:generate
# Edit .env (lihat bagian 3)

php artisan migrate --force --seed     # --seed hanya pada instalasi pertama
php artisan storage:link

# Optimasi produksi
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Web server → document root harus mengarah ke folder `public/`** milik KALOKA.

Contoh Apache vhost:
```apache
<VirtualHost *:80>
    ServerName namadesa.web.id
    DocumentRoot /var/www/kaloka/public
    <Directory /var/www/kaloka/public>
        AllowOverride All
        Require all granted
    </Directory>
    # SLiMS sebagai alias subfolder (Opsi A):
    Alias /katalog /var/www/slims
    <Directory /var/www/slims>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

---

## 3. Konfigurasi `.env` Produksi (KALOKA)
```env
APP_NAME="KALOKA"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://namadesa.web.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kaloka_db
DB_USERNAME=kaloka_user
DB_PASSWORD=********

# (Opsional) statistik SLiMS read-only di dashboard:
# SLIMS_DB_HOST=127.0.0.1
# SLIMS_DB_DATABASE=slims_sobokerto
# SLIMS_DB_USERNAME=slims_readonly   # akun ber-hak SELECT saja
# SLIMS_DB_PASSWORD=********
```

---

## 4. Deploy SLiMS
Ikuti [INSTALASI-SLIMS.md](INSTALASI-SLIMS.md). Ringkas:
1. Unggah folder SLiMS ke lokasi sesuai skema (subfolder/subdomain).
2. Buat database `slims_sobokerto`.
3. Jalankan installer web SLiMS, isi koneksi DB & akun admin.
4. Catat URL OPAC → masukkan ke **Pengaturan KALOKA**.

---

## 5. Database Produksi — KEDUA Aplikasi
```sql
CREATE DATABASE kaloka_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE slims_sobokerto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Akun KALOKA (hak penuh pada kaloka_db)
CREATE USER 'kaloka_user'@'localhost' IDENTIFIED BY '********';
GRANT ALL PRIVILEGES ON kaloka_db.* TO 'kaloka_user'@'localhost';

-- (Opsional) akun read-only untuk membaca statistik SLiMS dari KALOKA
CREATE USER 'slims_readonly'@'localhost' IDENTIFIED BY '********';
GRANT SELECT ON slims_sobokerto.* TO 'slims_readonly'@'localhost';
FLUSH PRIVILEGES;
```

Perintah migrasi KALOKA saat pembaruan: `php artisan migrate --force`.

---

## 6. Checklist Keamanan (sebelum go-live)
- [ ] `APP_DEBUG=false` dan `APP_ENV=production` di `.env` KALOKA.
- [ ] `php artisan key:generate` sudah dijalankan (APP_KEY terisi).
- [ ] Document root mengarah ke `public/` (folder lain tidak boleh diakses langsung).
- [ ] Izin folder: `storage/` dan `bootstrap/cache/` dapat ditulis web server.
- [ ] HTTPS aktif (sertifikat SSL) untuk KALOKA & SLiMS.
- [ ] Ganti **semua kata sandi default** (admin KALOKA & admin SLiMS).
- [ ] Akun DB KALOKA tidak dipakai bersama SLiMS; akun SLiMS-read-only hanya SELECT.
- [ ] **Backup rutin KEDUA database** (`kaloka_db` & `slims_sobokerto`) + folder `storage/`.
- [ ] `config:cache`, `route:cache`, `view:cache` dijalankan setelah perubahan.

### Contoh backup
```bash
mysqldump -u root -p kaloka_db > backup_kaloka_$(date +%F).sql
mysqldump -u root -p slims_sobokerto > backup_slims_$(date +%F).sql
```
