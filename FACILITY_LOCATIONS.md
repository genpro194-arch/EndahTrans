# 📍 Lokasi Menampilkan Pilihan Fasilitas Bus

## 1️⃣ **Halaman Detail Paket** (`/paket/{slug}`)
**Lokasi:** Sidebar kanan (Sticky Panel)

```
┌─────────────────────────────────┐
│    Pilih Fasilitas Bus          │
│                                 │
│  ☐ REGULER                      │
│    ✓ AC                         │
│    ✓ Kursi Busa                 │
│    ✓ Toilet                     │
│    Rp 2.500.000/orang           │
│                                 │
│  ☑ EKSLUSIF                     │
│    ✓ AC Premium                 │
│    ✓ Kursi Reclining            │
│    ✓ WiFi                       │
│    ✓ Monitor Individual         │
│    ✓ Toilet VIP                 │
│    ✓ Makanan & Minuman          │
│    Hemat 8%                     │
│    Rp 3.500.000  ← Coret        │
│    Rp 3.200.000 ← Harga Promo   │
│                                 │
│    [Pesan Sekarang]             │
│    [Tanya via WhatsApp]         │
└─────────────────────────────────┘
```

**File:** `resources/views/packages/show.blade.php` (Lines 245-298)

**Yang ditampilkan:**
- ✅ Nama fasilitas (Reguler/Ekslusif)
- ✅ Daftar fitur dengan icon ✓
- ✅ Harga per orang
- ✅ Harga diskon (jika ada)
- ✅ Persentase diskon
- ✅ Radio button untuk memilih
- ✅ Custom styling dengan border highlight ketika dipilih

---

## 2️⃣ **Halaman Form Booking** (`/booking/{package_slug}`)
**Lokasi:** Setelah input Jumlah Bus, sebelum Data Pemesan

```
┌─────────────────────────────────────────┐
│  Pilih Fasilitas Bus                    │
│                                         │
│  [REGULER] │ [EKSLUSIF]                │
│  ─────────────────────────────────────  │
│  ☑ REGULER                     EKSLUSIF │
│   ✓ AC            │  ✓ AC Premium       │
│   ✓ Kursi Busa    │  ✓ Kursi Reclining │
│   ✓ Toilet        │  ✓ WiFi             │
│                   │  ✓ Monitor Individual
│   Rp 2.500.000    │  ✓ Toilet VIP       │
│   per orang       │  ✓ Makanan & Minuman│
│                   │                     │
│                   │  Rp 3.200.000       │
│                   │  per orang          │
│                   │  (Hemat 8%)         │
└─────────────────────────────────────────┘
```

**File:** `resources/views/booking/create.blade.php` (Lines 172-236)

**Yang ditampilkan:**
- ✅ 2 grid layout (untuk Reguler & Ekslusif yang terpisah)
- ✅ Facility cards dengan border/background yang interaktif
- ✅ Daftar fitur dengan checklist
- ✅ Kalkulasi harga real-time saat dipilih
- ✅ Validasi error jika facility belum dipilih

---

## 3️⃣ **Halaman Konfirmasi Pemesanan** (`/booking/confirmation/{code}`)
**Lokasi:** Bagian ringkasan booking info

```
┌─────────────────────────────────┐
│ Paket: Lombok 3D2N              │
│ 📅 09 Feb 2025                  │
│ 🕐 20:00 WIB                    │
│ 🚌 2 Bus (80 Penumpang)         │
│ ✓ Ekslusif                      │ ← Fasilitas yg dipilih
│                                 │
│ Rincian Biaya:                  │
│ Harga x 2 bus: Rp 6.400.000    │
│ Total: Rp 6.400.000             │
└─────────────────────────────────┘
```

**File:** `resources/views/booking/confirmation.blade.php` (Lines 42-48)

**Yang ditampilkan:**
- ✅ Nama fasilitas yang dipilih
- ✅ Total harga sudah include harga facility
- ✅ Info lengkap perjalanan

---

## 📊 **Data Flow Diagram**

```
┌─ PACKAGE DETAIL PAGE ─────────────────┐
│ 1. Load package dengan facilities     │
│ 2. Tampilkan pilihan facilities       │ 
│ 3. Customer pilih 1 facility          │
│                                       │
└─────────────────┬─────────────────────┘
                  │
                  └──→ "Pesan Sekarang" button
                       (pass via form)
                       │
                       ▼
┌─ BOOKING FORM PAGE ───────────────────┐
│ 1. Show facilities pilihan lagi       │
│ 2. Customer confirm facility choice   │
│ 3. Input data pemesan                 │
│ 4. Submit booking (dengan facility_id)│
│                                       │
└─────────────────┬─────────────────────┘
                  │
                  └──→ BookingController
                       (store method)
                       │
                       ▼ Hitung harga:
                       - Ambil dari PackageBusFacility
                       - Multiply dengan num_of_buses
                       - Multiply dengan duration_days
                       │
                       ▼
┌─ CONFIRMATION PAGE ───────────────────┐
│ 1. Show selected facility             │
│ 2. Show total price (sudah include)   │
│ 3. Payment instructions               │
│                                       │
└───────────────────────────────────────┘
```

---

## 🔧 **Perubahan Backend**

### Affected Controllers:
1. **PackageController** (`show()`)
   - Load `packageFacilities.busFacility`
   - Pass ke view

2. **BookingController** (`create()`)
   - Load package dengan facilities
   
3. **BookingController** (`store()`)
   - Validasi `bus_facility_id`
   - Ambil price dari `PackageBusFacility`
   - Calculate total price berdasarkan facility price
   - Save `bus_facility_id` ke booking

### Database:
- ✅ `bus_facilities` - Master data facilities
- ✅ `package_bus_facilities` - Relasi paket ↔ facilities dengan pricing
- ✅ `bookings` - Tambah kolom `bus_facility_id`

---

## 🚀 **Testing Checklist**

- [ ] Halaman package detail menampilkan facilities
- [ ] Bisa pilih antara Reguler dan Ekslusif
- [ ] Harga berubah saat pilihan facility berubah
- [ ] Form booking menampilkan facilities pilihan
- [ ] Facility selection required (tidak bisa skip)
- [ ] Total harga dihitung dengan benar
- [ ] Booking saved dengan facility_id yang benar
- [ ] Confirmation page menampilkan selected facility
- [ ] Email notifikasi include facility info

---

## 💡 **Notes untuk Development Lebih Lanjut**

### Frontend:
- Tambahkan JavaScript untuk real-time price update
- Toast notification saat facility dipilih
- Smooth transition saat switch facility

### Admin Panel:
- Halaman kelola multiple facilities per package
- Bulk edit pricing untuk semua packages
- Report: Facilities paling sering dipilih

### API:
- `/api/packages/{id}/facilities` - List facilities with pricing
- `/api/facilities` - Master facilities

