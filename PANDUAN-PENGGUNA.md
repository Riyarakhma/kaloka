# Panduan Pengguna KALOKA (untuk Pengelola Desa)

Panduan praktis mengoperasikan aplikasi **KALOKA**. Ditujukan untuk pengelola & admin Perpustakaan Desa Sobokerto.

> **Ingat:** KALOKA mengurus **Kearifan Lokal, Wisata, Portal**. Untuk **katalog buku & peminjaman**, gunakan aplikasi **SLiMS** (terpisah) — lihat bagian akhir panduan ini.

---

## 1. Masuk (Login)
1. Buka alamat situs, klik **Login** (pojok kanan atas) atau menu **Login** di beranda.
2. Masukkan **email** dan **kata sandi** yang diberikan admin.
3. Setelah berhasil, Anda diarahkan ke **Dashboard**.

> Tidak ada pendaftaran mandiri. Akun baru dibuat oleh **admin** (lihat bagian 5).

**Dua peran:**
- **Pengelola** — mengelola Kearifan Lokal & Wisata.
- **Admin** — semua hak pengelola **+** manajemen pengguna & pengaturan situs.

---

## 2. Mengelola Entri Kearifan Lokal
Menu **Kearifan Lokal** di sidebar.

### Menambah entri
1. Klik **Tambah Entri**.
2. Isi formulir (16 kolom metadata). Yang wajib bertanda **\***: Judul, Dimensi, Deskripsi, Jenis Media, Status Etis, Status Kurasi.
3. **Berkas Media** (opsional): unggah foto/audio/video/dokumen (maks 20 MB).
4. **Kode entri dibuat otomatis** (mis. KL-0001).
5. Klik **Simpan**.

### Alur Kurasi (penting)
Setiap entri punya **Status Kurasi**: **Draf → Terverifikasi → Terbit**.
- Buka detail entri → panel **Alur Kurasi** → pilih status → **Ubah**.
- **Hanya entri "Terbit"** yang bisa tampil di publik.

### Status Etis (lindungi pengetahuan sensitif)
- **Umum** — boleh tampil publik.
- **Terbatas / Sakral** — **tidak ditampilkan ke publik**, walaupun statusnya "Terbit".

> Jadi entri tampil ke publik **hanya jika**: Status Kurasi = **Terbit** **dan** Status Etis = **Umum**.

### Mengubah / menghapus
Pada daftar, gunakan ikon **pensil** (ubah) atau **tempat sampah** (hapus).

---

## 3. Mengelola Info Wisata
Menu **Info Wisata** di sidebar.
1. **Tambah Spot** → isi nama, kategori (Destinasi/Kuliner/Kerajinan/Event), deskripsi, lokasi, koordinat, jam, kontak.
2. **Foto**: bisa mengunggah **beberapa** sekaligus. Saat mengubah, foto baru ditambahkan; hapus foto lewat halaman **Ubah**.
3. **Tampilkan ke publik**: aktifkan sakelar agar muncul di portal. Nonaktif = disembunyikan.

---

## 4. Mengatur URL Katalog (OPAC SLiMS) — *admin*
Menu **Pengaturan**.
1. Isi **URL OPAC SLiMS** dengan alamat katalog SLiMS Anda (mis. `http://namadesa.web.id/katalog`).
2. **Simpan**. Tombol "Katalog/Cari Koleksi" di portal & dashboard otomatis mengarah ke sana.

Di sini juga diatur **Nama Situs**, **Kontak Desa**, dan **Teks Sambutan** beranda.

---

## 5. Manajemen Pengguna — *admin*
Menu **Pengguna**.
- **Tambah Pengguna**: isi nama, email, peran (admin/pengelola), kata sandi.
- **Ubah**: ganti data/peran; kata sandi boleh dikosongkan bila tak diubah.
- Demi keamanan, Anda **tidak bisa** menghapus atau menurunkan peran akun Anda sendiri.

---

## 6. Memakai SLiMS untuk Katalog & Sirkulasi (ringkas)
Katalog buku, peminjaman-pengembalian, dan keanggotaan dijalankan di **SLiMS**:
1. Login ke **admin SLiMS** (alamat & akun terpisah dari KALOKA).
2. **Bibliografi**: tambah judul koleksi; **Eksemplar**: tambah kopi fisik beserta kode barcode.
3. **Keanggotaan**: daftarkan anggota perpustakaan.
4. **Sirkulasi**: layani pinjam & kembali.
5. **OPAC** (katalog publik) otomatis tersedia — salin alamatnya ke **Pengaturan KALOKA** (bagian 4) agar terhubung dari portal.

> Statistik katalog (jumlah koleksi, anggota, transaksi) dilihat langsung di **SLiMS**.

---

## Tips
- Selalu set entri sensitif ke **Terbatas/Sakral** agar tidak bocor ke publik.
- Periksa pratinjau "Lihat halaman publik" pada detail entri untuk memastikan tampilannya.
- Ganti kata sandi default segera setelah serah terima.
