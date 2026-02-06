# 🌟 Fitur Rute Terpopuler - Panduan Penggunaan

## 📋 Ringkasan Fitur
Admin dapat menandai paket wisata sebagai "Terpopuler" melalui tombol **Bintang** di halaman admin packages. Paket yang ditandai akan ditampilkan di halaman khusus "Rute Terpopuler" di website.

---

## 🎯 Cara Menggunakan

### 1️⃣ **Login Admin**
```
URL: http://localhost:8000/admin/login
atau
http://localhost/EndahTrans/public/admin/login

Email: admin@endahtravel.com
Password: password
```

### 2️⃣ **Akses Menu Paket Wisata**
```
Klik: Admin → Paket Wisata (/admin/packages)
```

### 3️⃣ **Tandai Paket Sebagai Terpopuler**
Pada setiap kartu paket, ada 4 tombol action:

| Tombol | Fungsi |
|--------|--------|
| 👁️ **Preview** | Lihat paket di website |
| ⭐ **Bintang** | **Tandai/Hapus dari Rute Terpopuler** |
| ✏️ **Edit** | Edit data paket |
| 🗑️ **Trash** | Hapus paket |

**Cara Klik:**
- Klik **tombol Bintang** (berwarna abu-abu jika belum terpopuler, kuning jika sudah terpopuler)
- Paket akan langsung ditandai/dihapus dari rute terpopuler
- Anda akan melihat notifikasi sukses

### 4️⃣ **Lihat Hasil di Frontend**

#### Halaman Rute Terpopuler
```
URL: http://localhost:8000/rute-terpopuler
atau
http://localhost/EndahTrans/public/rute-terpopuler
```

#### Fitur Halaman:
- ✅ Menampilkan semua paket yang ditandai "Terpopuler"
- ✅ Diurutkan berdasarkan jumlah booking
- ✅ Tampil badge "POPULER" 🔥
- ✅ Tampil jumlah booking untuk setiap paket
- ✅ Pagination otomatis

---

## 🎨 Fitur Visual

### Badge Terpopuler (Admin)
- **Kuning**: Paket sudah ditandai sebagai terpopuler
- **Abu-abu**: Paket belum ditandai

### Badge di Frontend
- 🔥 **POPULER** - Menandakan paket yang dipilih admin
- 📊 **Booking Count** - Jumlah pemesanan paket

### Statistik Dashboard
Di halaman admin packages, terdapat statistik:
- Total Paket
- Paket Aktif
- Paket Unggulan (Terpopuler)

---

## 📊 Contoh Workflow

1. **Admin Login** → `/admin/login`
2. **Buka Paket Wisata** → `/admin/packages`
3. **Cari paket "Big Bus - Bali"** 
4. **Klik tombol Bintang** ⭐
5. **Paket muncul di** `/rute-terpopuler`
6. **Customer bisa lihat paket populer**

---

## 💡 Tips & Tricks

✨ **Pilih 3-6 paket terbaik** sebagai terpopuler untuk rekomendasi terbaik

✨ **Paket dengan diskon** lebih menarik untuk ditandai populer

✨ **Update berkala** sesuai trend pemesanan customer

✨ **Pantau jumlah booking** di halaman rute terpopuler untuk evaluasi

---

## 🔧 Rute & Endpoint

### Admin Routes
```
POST /admin/packages/{package}/toggle-featured
Fungsi: Toggle status terpopuler paket
Method: Form dengan @csrf
```

### Frontend Routes
```
GET /rute-terpopuler
Tampilkan daftar paket terpopuler dengan pagination
```

### API Routes (jika digunakan)
```
GET /api/routes/featured
Ambil data paket terpopuler (JSON)
```

---

## ❓ FAQ

**Q: Paket saya tidak muncul di halaman rute terpopuler?**
A: Pastikan paket status:
- ✅ Aktif (is_active = true)
- ✅ Ditandai Terpopuler (is_featured = true)

**Q: Bisa melihat berapa banyak booking untuk paket populer?**
A: Ya! Setiap paket di halaman rute terpopuler menampilkan jumlah booking.

**Q: Apakah ada batasan jumlah paket populer?**
A: Tidak ada batasan! Anda bisa menandai sebanyak mungkin paket.

---

**Last Updated:** February 2, 2026
**Version:** 1.0
