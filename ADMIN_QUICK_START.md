# 🎯 Quick Start Admin Panel - Endah Travel

## ⚡ Akses Cepat

### Login
**URL:** `http://localhost/EndahTrans/public/admin/login`

**Email:** `admin@endahtravel.com`  
**Password:** `password`

---

## 📌 Menu Utama

| Menu | URL | Fungsi |
|------|-----|--------|
| Dashboard | `/admin` | Overview statistik |
| Paket Wisata | `/admin/paket` | Kelola paket tour |
| Destinasi | `/admin/destinasi` | Kelola kota/tujuan |
| Booking | `/admin/booking` | Lihat pesanan |
| Kontak | `/admin/kontak` | Pesan dari website |

---

## 🎬 Cara Cepat Tambah Paket

1. **Login** → Klik **"Paket Wisata"**
2. Klik **"Tambah Paket Baru"**
3. Isi data:
   - Destinasi: Pilih (Bali, Jakarta, dll)
   - Nama: "Big Bus - Bali"
   - Harga: 17000000
   - Durasi: 3 hari
   - Upload Gambar
4. Klik **"Simpan"**

**Paket langsung tampil di website!**

---

## 🖼️ Cara Upload Gambar Paket

Saat membuat/edit paket:
1. Klik **"Pilih Gambar"** atau **"Upload"**
2. Pilih file dari komputer
3. Gambar otomatis dikompres dan disimpan
4. Klik **"Simpan Paket"**

**Rekomendasi Ukuran Gambar:** 500x300px atau landscape

---

## 🔄 Cara Edit & Hapus

### Edit Paket:
1. Di list paket, klik **ikon pensil** atau nama paket
2. Edit data
3. Klik **"Update"**

### Hapus Paket:
1. Di list paket, klik **ikon trash**
2. Konfirmasi penghapusan

---

## 📊 Database Info

**Database:** `endahtrans`  
**User:** `root`  
**Password:** (kosong)

Akses via phpMyAdmin: `http://localhost/phpmyadmin`

---

## ⚙️ Setting Website

Untuk mengubah nama, kontak, social media website:
- Edit di **Dashboard** → **Settings** (jika tersedia)
- Atau edit langsung di `config/app.php`

---

## 🔐 Ganti Password

1. Login ke admin
2. Klik **"Profil"** (top-right)
3. Pilih **"Ganti Password"**
4. Masukkan password baru
5. Klik **"Simpan"**

---

## ✅ Fitur yang Sudah Ada

✔️ Kelola Paket (CRUD)  
✔️ Kelola Destinasi (CRUD)  
✔️ Lihat Booking  
✔️ Lihat Pesan Kontak  
✔️ Dashboard dengan Statistik  
✔️ Upload Gambar  
✔️ Search & Filter  
✔️ Multi-user Support  

---

## 🆘 Troubleshooting

**Q: Lupa password admin?**  
A: Reset via database atau gunakan perintah:
```bash
php artisan tinker
User::find(1)->update(['password' => Hash::make('password_baru')])
exit
```

**Q: Gambar tidak tampil?**  
A: Pastikan permission folder `storage/` benar:
```bash
php artisan storage:link
```

**Q: Admin halaman tidak bisa diakses?**  
A: Cek apakah sudah login di `/admin/login`

---

Semua fitur admin panel **sudah siap digunakan!** 🚀

Dokumentasi lengkap ada di file `ADMIN_GUIDE.md`
