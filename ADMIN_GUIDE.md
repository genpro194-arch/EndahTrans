# 📊 Panduan Admin Panel - Endah Travel

## 🔐 Akses Login Admin

### URL Admin Panel
```
http://localhost/EndahTrans/public/admin/login
```

### Kredensial Default
- **Email:** `admin@endahtravel.com`
- **Password:** `password`

⚠️ **PENTING:** Ganti password setelah login pertama!

---

## 📋 Menu-Menu Admin

### 1️⃣ **Dashboard**
- Melihat statistik overview
- Jumlah destinasi, paket, booking, dan pelanggan
- Grafik dan data real-time

### 2️⃣ **Paket Wisata** (`/admin/paket`)
Kelola semua paket perjalanan

#### Fitur:
- ✅ **Tambah Paket** - Buat paket wisata baru
- ✅ **Edit Paket** - Ubah informasi paket
- ✅ **Hapus Paket** - Hapus paket dari sistem
- ✅ **Filter & Cari** - Cari berdasarkan nama, destinasi, status

#### Field yang Diisi:
```
- Destinasi (pilih dari list)
- Nama Paket (contoh: "Big Bus - Bali")
- Jenis Bus (Big Bus / Medium Bus)
- Deskripsi & Itinerary
- Harga
- Durasi (jumlah hari)
- Kapasitas (max penumpang)
- Gambar Paket
- Status Aktif/Non-aktif
```

---

### 3️⃣ **Destinasi** (`/admin/destinasi`)
Kelola kota/destinasi wisata

#### Fitur:
- ✅ **Tambah Destinasi** - Tambah kota baru
- ✅ **Edit Destinasi** - Ubah info destinasi
- ✅ **Hapus Destinasi** - Hapus destinasi
- ✅ **Gambar Destinasi** - Upload foto destinasi

#### Field:
```
- Nama Destinasi (contoh: "Jakarta")
- Slug (auto-generate)
- Deskripsi
- Gambar
- Featured (tampilkan di halaman utama)
- Status Aktif
```

---

### 4️⃣ **Booking** (`/admin/booking`)
Lihat semua pemesanan dari pelanggan

#### Fitur:
- ✅ **Lihat Detail Booking** - Informasi lengkap pemesanan
- ✅ **Update Status** - Ubah status (pending, confirmed, completed)
- ✅ **Hapus Booking** - Hapus pesanan
- ✅ **Filter** - Cari berdasarkan status, tanggal

#### Status Booking:
- 🟡 **Pending** - Menunggu konfirmasi
- 🟢 **Confirmed** - Sudah dikonfirmasi
- 🔵 **Completed** - Selesai
- 🔴 **Cancelled** - Dibatalkan

---

### 5️⃣ **Kontak** (`/admin/kontak`)
Kelola pesan dari halaman kontak website

#### Fitur:
- ✅ **Lihat Pesan** - Baca pesan dari pengunjung
- ✅ **Tandai Terbaca** - Mark as read
- ✅ **Hapus Pesan** - Hapus pesan
- ✅ **Filter** - Cari berdasarkan nama, email, status

---

## 🎯 Langkah-Langkah Tambah Paket Wisata

### Via Admin Panel:

1. **Login** ke `/admin/login`
2. Klik **"Paket Wisata"** → **"Tambah Paket Baru"**
3. **Isi Form:**
   ```
   Destinasi       : Pilih dari dropdown (contoh: Bali)
   Nama Paket      : "Big Bus - Bali" atau "Medium Bus - Bali"
   Jenis Bus       : Big Bus / Medium Bus
   Kapasitas       : 40 (Big Bus) atau 35 (Medium Bus)
   Deskripsi       : Penjelasan singkat paket
   Itinerary       : Detail harian perjalanan
   Include         : Apa saja yang termasuk
   Exclude         : Apa saja yang tidak termasuk
   Harga           : Harga paket (Rp)
   Harga Diskon    : Harga setelah diskon (optional)
   Durasi          : Jumlah hari
   Gambar          : Upload foto
   Status          : Centang "Aktif"
   ```
4. Klik **"Simpan"**

---

## 🛠️ Cara Ganti Password Admin

1. Login ke admin panel
2. Klik **profil admin** (nama di top-right)
3. Pilih **"Ganti Password"**
4. Masukkan password lama dan password baru
5. Klik **"Simpan"**

---

## 📊 Database MySQL

### Tabel Utama:
```sql
users              -- Data admin
packages           -- Paket wisata
destinations       -- Kota/destinasi
bookings           -- Pemesanan
contacts           -- Pesan kontak
```

### Akses Database:
- **Tool:** phpMyAdmin
- **URL:** `http://localhost/phpmyadmin`
- **Database:** `endah_travel`
- **User:** `root`
- **Password:** (kosong atau sesuai konfigurasi)

---

## 🚀 Fitur Lanjutan

### Export Data
Anda bisa export paket/booking dalam format CSV/Excel (jika fitur tersedia)

### Backup Database
```bash
# Windows - dari folder project
php artisan backup:run
```

### Reset Password Melalui Terminal
```bash
php artisan tinker
User::where('email', 'admin@endahtravel.com')->update(['password' => Hash::make('password_baru')])
exit
```

---

## ⚠️ Tips Penting

1. **Backup Database Rutin** - Jangan lupa backup data penting
2. **Ganti Password Default** - Keamanan admin adalah prioritas
3. **Gunakan Gambar Berkualitas** - Paket dengan gambar lebih menarik
4. **Deskripsi Lengkap** - Semakin detail, semakin menarik bagi pelanggan
5. **Update Status Booking** - Selalu update status agar pelanggan tahu

---

## 📞 Bantuan

Jika ada kendala, silakan:
1. Cek error log: `storage/logs/laravel.log`
2. Pastikan database terhubung
3. Cek permission folder `storage/` dan `bootstrap/cache/`

---

**Versi Admin Panel:** 1.0  
**Terakhir Update:** 2 Februari 2026
