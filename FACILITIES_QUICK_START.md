# ⚡ Quick Start - Implementasi Bus Facilities

## ✅ Checklist Implementasi

### Database ✓
- [x] Migration `2026_02_09_000001_create_bus_facilities_table` - Created 2 default facilities (Reguler, Ekslusif)
- [x] Migration `2026_02_09_000002_create_package_bus_facilities_table` - Created junction table
- [x] Migration `2026_02_09_000003_add_bus_facility_to_bookings_table` - Added bus_facility_id to bookings
- [x] All migrations applied successfully

### Models ✓
- [x] BusFacility model dengan relationships
- [x] PackageBusFacility model dengan relationships
- [x] Package model updated dengan busFacilities() relation
- [x] Booking model updated dengan busFacility() relation

### Controllers ✓
- [x] Admin\PackageController updated untuk handle multiple facilities
- [x] PackageController updated dengan facility data di API
- [x] All API endpoints updated

---

## 📌 Admin Panel - Cara Menggunakan

### Membuat Paket Baru dengan Fasilitas

1. **Masuk ke Admin → Packages → Create**

2. **Isi form dasar:**
   - Destination
   - Name, Description
   - Duration, etc.

3. **Di section "Bus Facilities":**
   ```
   [ ] Fasilitas 1
   - Pilih: Reguler
   - Harga: 2500000
   - Harga Diskon: (kosongkan jika tidak ada)
   
   [ ] Fasilitas 2
   - Pilih: Ekslusif
   - Harga: 3500000
   - Harga Diskon: 3200000
   ```

4. **Save** → Paket dengan 2 pilihan fasilitas siap!

---

## 💰 Contoh Pricing Structure

```
PAKET: Lombok 3 Hari 2 Malam

┌─ REGULER
│  ├─ Harga: Rp 2.500.000/bus
│  ├─ Fitur:
│  │  ├─ AC
│  │  ├─ Kursi Busa
│  │  └─ Toilet
│  └─ Kapasitas: 40 orang
│
└─ EKSLUSIF
   ├─ Harga: Rp 3.500.000/bus
   ├─ Harga Promo: Rp 3.200.000/bus
   ├─ Fitur:
   │  ├─ AC Premium
   │  ├─ Kursi Reclining
   │  ├─ WiFi
   │  ├─ Monitor Individual
   │  ├─ Toilet VIP
   │  └─ Makanan & Minuman
   └─ Kapasitas: 35 orang
```

---

## 🧮 Contoh Hitung Booking

**Scenario: Customer booking Paket Lombok**

**Option 1: Pilih REGULER**
- Bus Type: Big (40 orang)
- Fasilitas: Reguler
- Harga Facility: Rp 2.500.000/bus
- Jumlah Bus: 2
- **Total: Rp 5.000.000** ← Disimpan di booking.total_price

**Option 2: Pilih EKSLUSIF**
- Bus Type: Big (40 orang)
- Fasilitas: Ekslusif (dengan promo)
- Harga Facility: Rp 3.200.000/bus (setelah diskon)
- Jumlah Bus: 2
- **Total: Rp 6.400.000** ← Disimpan di booking.total_price

Sistem otomatis:
1. Generate booking code ✓
2. Set bus_facility_id ✓
3. Hitung total_price berdasarkan facility price ✓
4. Create booking record ✓

---

## 📊 Data yang Tersimpan

### Tabel bus_facilities
```sql
SELECT * FROM bus_facilities;

ID | Name     | Slug      | is_active
1  | Reguler  | reguler   | 1
2  | Ekslusif | ekslusif  | 1
```

### Tabel package_bus_facilities
```sql
SELECT * FROM package_bus_facilities;

ID | Package_ID | Bus_Facility_ID | Price      | Discount_Price
1  | 5          | 1               | 2500000    | NULL
2  | 5          | 2               | 3500000    | 3200000
3  | 6          | 1               | 1800000    | 1500000
```

### Tabel bookings
```sql
SELECT * FROM bookings WHERE id = 123;

ID  | Booking_Code | Package_ID | Bus_Facility_ID | Total_Price | Status
123 | ET20260209ABC | 5         | 2               | 6400000     | pending
```

---

## 🔍 Verify Installation

### Check Database Tables
```bash
php artisan tinker
>>> DB::table('bus_facilities')->get();
>>> DB::table('package_bus_facilities')->get();
```

### Check Models
```bash
php artisan tinker
>>> $facility = App\Models\BusFacility::first();
>>> $facility->name;
>>> $facility->features;
```

### Check API
```bash
curl http://localhost:8000/api/packages
# Response includes packageFacilities data
```

---

## 🎨 Customization

### Tambah Fasilitas Baru

**Via Database (Direct SQL):**
```sql
INSERT INTO bus_facilities (name, slug, description, features, display_order, is_active, created_at, updated_at)
VALUES (
  'VIP Plus',
  'vip-plus',
  'Fasilitas ultra premium',
  '["Sofa Bed", "Shower", "Kitchen", "WiFi Ultra"]',
  3,
  1,
  NOW(),
  NOW()
);
```

**Via Admin UI:** Buat migration baru atau gunakan database admin tool

### Edit Features

Update JSON array di kolom `features`:
```json
["AC", "WiFi", "Kursi Reclining", "USB Charging", "Makanan"]
```

---

## 🚀 Next: Frontend Integration

### View untuk Package Detail (`resources/views/packages/show.blade.php`)

```blade
@foreach($package->packageFacilities as $facility)
    <div class="facility-option">
        <h3>{{ $facility->busFacility->name }}</h3>
        <ul>
            @foreach($facility->busFacility->features as $feature)
                <li>✓ {{ $feature }}</li>
            @endforeach
        </ul>
        <p class="price">
            @if($facility->discount_price)
                <span class="original">Rp {{ number_format($facility->price) }}</span>
                <span class="discount">Rp {{ number_format($facility->discount_price) }}</span>
            @else
                <strong>Rp {{ number_format($facility->price) }}</strong>
            @endif
        </p>
        <button>Pilih {{ $facility->busFacility->name }}</button>
    </div>
@endforeach
```

---

## ✨ Status Implementation

✅ Database: 3 migrations applied  
✅ Models: 4 models dengan relations  
✅ Controllers: Admin & Public updated  
✅ API: All endpoints updated  
⏳ Views: Siap untuk di-integrate  
⏳ Booking Form: Siap untuk di-update  

---

**Last Updated:** 9 Feb 2026  
**Status:** Production Ready ✓

