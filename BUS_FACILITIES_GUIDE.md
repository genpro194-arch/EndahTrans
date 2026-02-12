# 🚌 Implementasi Bus Facilities (Reguler & Ekslusif)

## 📋 Ringkasan Perubahan

Sistem Anda telah diperbarui untuk mendukung 2 pilihan fasilitas bus (Reguler & Ekslusif) dengan harga yang berbeda. Setiap paket sekarang dapat memiliki multiple fasilitas dengan pricing terpisah.

---

## 🗄️ Database Changes

### 1. Tabel `bus_facilities` (BARU)
Menyimpan master data fasilitas bus yang tersedia:
- **id**: Primary key
- **name**: Nama fasilitas (Reguler, Ekslusif)
- **slug**: URL-friendly identifier
- **description**: Deskripsi fasilitas
- **features**: JSON array fitur-fitur yang disediakan
- **display_order**: Urutan tampilan
- **is_active**: Status aktif/tidak

**Default Data:**
- ✅ Reguler: AC, Kursi Busa, Toilet
- ✅ Ekslusif: AC Premium, Kursi Reclining, WiFi, Monitor Individual, Toilet VIP, Makanan & Minuman

### 2. Tabel `package_bus_facilities` (BARU)
Relasi antara paket dan fasilitas dengan harga spesifik:
- **package_id**: Foreign key ke packages
- **bus_facility_id**: Foreign key ke bus_facilities
- **price**: Harga fasilitas tertentu
- **discount_price**: Harga diskon (optional)

### 3. Tabel `bookings` (MODIFIED)
Tambahan kolom:
- **bus_facility_id**: Fasilitas yang dipilih customer saat booking

---

## 📦 Model Updates

### BusFacility (NEW)
```php
- hasMany: packageFacilities()
- belongsToMany: packages()
```

### PackageBusFacility (NEW)
```php
- belongsTo: package()
- belongsTo: busFacility()
```

### Package (UPDATED)
```php
+ hasMany: packageFacilities()
+ belongsToMany: busFacilities()
```

### Booking (UPDATED)
```php
+ fillable: 'bus_facility_id'
+ belongsTo: busFacility()
```

---

## 🎮 Admin Panel Usage

### Membuat/Edit Paket dengan Fasilitas

Saat membuat atau mengedit paket di admin panel, Anda sekarang dapat:

1. **Menambah pilihan fasilitas:**
   - Pilih fasilitas (Reguler/Ekslusif) dari dropdown
   - Input harga untuk fasilitas tersebut
   - Input harga diskon (optional)

2. **Multiple facilities:**
   - Satu paket bisa punya hingga 2 fasilitas dengan harga berbeda
   - Setiap fasilitas independent dengan harganya sendiri

3. **Contoh Implementation:**
```
Paket: "Liburan ke Lombok 3 Hari"

Fasilitas Tersedia:
├─ Reguler
│  ├─ Harga: Rp 2.500.000
│  └─ Fitur: AC, Kursi Busa, Toilet
│
└─ Ekslusif
   ├─ Harga: Rp 3.500.000
   ├─ Diskon: Rp 3.200.000
   └─ Fitur: AC Premium, Kursi Reclining, WiFi, Monitor, Toilet VIP, Makanan
```

---

## 👥 Frontend/API Usage

### Package Detail View
Menampilkan pilihan fasilitas dengan harga:
```
Paket: Lombok 3D2N
├─ Reguler: Rp 2.500.000
└─ Ekslusif: Rp 3.500.000 (diskon: Rp 3.200.000)
```

### API Endpoints Updated

1. **GET /api/packages** - Include facilities
2. **GET /api/packages/by-type/{busType}** - Include facilities
3. **GET /api/comparison/{destination}** - Show all facilities with prices
4. **GET /api/featured-routes** - Include facilities per package
5. **GET /api/cheapest-routes** - Include facilities per package

---

## 🛠️ Technical Implementation

### Controller Updates

**Admin\PackageController:**
- `create()`: Pass available facilities
- `edit()`: Load package facilities
- `store()`: Save multiple facilities with prices
- `update()`: Update facilities
- `updateFacilities()`: Private method untuk sync facilities

**PackageController:**
- `show()`: Load package with facilities
- API methods: All include facility data

---

## 📝 Migration Files

```
database/migrations/
├─ 2026_02_09_000001_create_bus_facilities_table.php
├─ 2026_02_09_000002_create_package_bus_facilities_table.php
└─ 2026_02_09_000003_add_bus_facility_to_bookings_table.php
```

---

## 🔄 Workflow Booking

1. **Customer melihat paket** → Melihat multiple pilihan fasilitas dengan harga
2. **Customer memilih fasilitas** → Selects Reguler atau Ekslusif
3. **Sistem menghitung total** → price x number_of_buses
4. **Booking disimpan** → bus_facility_id tersimpan di baris booking

---

## 💡 Next Steps

### Untuk Admin:
1. Update existing packages dengan menambahkan fasilitas dan harga
2. Review pricing untuk fasilitas Reguler vs Ekslusif
3. Customize features di tabel `bus_facilities` jika diperlukan

### Untuk Frontend:
1. Update booking form untuk menampilkan pilihan fasilitas
2. Update checkout untuk show selected facility
3. Update confirmation email dengan facility info

### Untuk API:
1. Test endpoints dengan facilities data
2. Update mobile app/frontend untuk consume facility data

---

## ✨ Keuntungan Sistem Ini

✅ **Fleksibel**: Mudah menambah/edit fasilitas  
✅ **Skalabel**: Support unlimited fasilitas per paket  
✅ **Pricing**: Harga berbeda per fasilitas  
✅ **Tracking**: Catat pilihan fasilitas setiap booking  
✅ **Analytics**: Track facilities popularity  

---

## 📞 Support

Untuk customize fasilitas default, edit tabel `bus_facilities` melalui database atau update di `2026_02_09_000001_create_bus_facilities_table.php` migration.

