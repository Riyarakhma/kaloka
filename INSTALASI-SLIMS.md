# Instalasi & Konfigurasi SLiMS (Katalog Perpustakaan)

SLiMS (**Senayan Library Management System**) dipasang **apa adanya** — bukan dibangun dari kode. SLiMS menyediakan **katalog/OPAC, sirkulasi (pinjam-kembali), keanggotaan, dan statistik** yang menjadi **bukti otomasi untuk akreditasi (Komponen Pelayanan)**.

> SLiMS adalah aplikasi **terpisah** dengan **database sendiri**. KALOKA hanya menautkannya.

---

## A. Persiapan
- Web server PHP + MySQL/MariaDB (Laragon/XAMPP di lokal; Apache/Nginx di produksi).
- Unduh SLiMS versi stabil terbaru dari situs resmi: **https://slims.web.id**.

## B. Langkah Instalasi
1. **Unduh & ekstrak** paket SLiMS.
2. **Letakkan** folder SLiMS di web server:
   - Lokal (XAMPP): `htdocs/katalog`
   - Lokal (Laragon): folder di dalam `www/`, mis. `www/katalog`
   - Produksi: sesuai skema di [DEPLOY.md](DEPLOY.md) (subfolder `/katalog` atau subdomain `katalog.`)
3. **Buat database kosong** untuk SLiMS, mis. `slims_sobokerto`:
   ```sql
   CREATE DATABASE slims_sobokerto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
4. **Jalankan installer web** SLiMS — buka di browser (mis. `http://localhost/katalog`) dan ikuti wizard:
   - Isi **koneksi database** (host, nama DB `slims_sobokerto`, user, password).
   - Buat **akun admin SLiMS**.
   - Isi **profil perpustakaan**: nama → **"Perpustakaan Desa Sobokerto"**.
5. **Amankan** setelah instalasi: hapus/rename folder `install/` sesuai petunjuk SLiMS.

## C. Konfigurasi Dasar
Masuk ke **admin SLiMS** lalu atur:
- **Identitas perpustakaan** (nama, alamat, logo).
- **Jam layanan**.
- **Jenis keanggotaan** & aturan peminjaman.
- **Aktifkan OPAC** (katalog publik).

## D. Input Koleksi
- **Bibliografi**: tambah judul koleksi (manual atau impor).
- **Eksemplar**: tambah kopi fisik tiap judul (kode eksemplar/barcode).
- **Keanggotaan**: daftarkan anggota.

## E. Hubungkan ke Portal KALOKA
1. Catat **URL OPAC** SLiMS (mis. `http://localhost/katalog` atau `https://namadesa.web.id/katalog`).
2. Login ke **KALOKA** sebagai admin → **Pengaturan** → isi **URL OPAC SLiMS** → **Simpan**.
3. Portal & dashboard KALOKA kini menaut ke katalog SLiMS.

## F. (Opsional) Statistik SLiMS di Dashboard KALOKA
Agar dashboard KALOKA menampilkan angka koleksi/anggota dari SLiMS:
1. Buat akun MySQL **hanya-baca** (SELECT) untuk DB SLiMS (lihat [DEPLOY.md](DEPLOY.md) bagian 5).
2. Isi variabel `SLIMS_DB_*` di `.env` KALOKA (sudah disediakan, masih komentar).
3. Aktifkan fitur pembacaan (pengembangan lanjutan). **KALOKA tidak pernah menulis** ke DB SLiMS.

---
**Catatan untuk tim:** sesuaikan langkah ini dengan kondisi lapangan saat deploy ke hosting, dan simpan kredensial dengan aman.
