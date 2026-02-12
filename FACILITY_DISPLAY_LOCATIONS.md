# 🎯 Lokasi PILIHAN REGULER & EKSLUSIF

## 📍 **TEMPAT-TEMPAT FACILITIES MUNCUL**

---

### 1️⃣ **HALAMAN DETAIL PAKET** 
**URL:** http://yoursite.com/paket/[paket-slug]

**SIDEBAR KANAN (Sticky Panel):**
```
▶ Top of sidebar (sticky = ngikuti scroll)

┌────────────────────────────────────┐
│   PILIH FASILITAS BUS             │
│   🚌 + Dropdown Icon              │
├────────────────────────────────────┤
│                                    │
│  ◯ REGULER          [Select]      │  ← OPTION 1
│  ├─ ✅ AC                         │
│  ├─ ✅ Kursi Busa                │
│  ├─ ✅ Toilet                    │
│  │                                │
│  └─ Rp 2.500.000/orang           │
│                                    │
│  ─────────────────────────────────  ← Divider
│                                    │
│  ◯ EKSLUSIF         [Select]      │  ← OPTION 2 (Default)
│  ├─ ✅ AC Premium                │
│  ├─ ✅ Kursi Reclining           │
│  ├─ ✅ WiFi                      │
│  ├─ ✅ Monitor Individual        │
│  ├─ ✅ Toilet VIP                │
│  ├─ ✅ Makanan & Minuman         │
│  │                                │
│  ├─ Rp 3.500.000 ╱ (Strikethrough)
│  ├─ Rp 3.200.000 (Bold)          │
│  └─ [Hemat 8%] Badge             │
│                                    │
├────────────────────────────────────┤
│   [Pesan Sekarang] Button          │  ← Green Button
│   [Tanya via WhatsApp] Button      │  ← Green Button
└────────────────────────────────────┘
```

**Implementasi Files:**
- `resources/views/packages/show.blade.php` (Lines ~245-298)
- Database query: `$package->packageFacilities()`

---

### 2️⃣ **HALAMAN FORM BOOKING**
**URL:** http://yoursite.com/booking/[paket-slug]

**MAIN FORM AREA (2-Column Grid):**
```
▼ SETELAH SECTION "Jumlah Bus" ▼

┌──────────────────────────────────────────────┐
│  PILIH FASILITAS BUS                        │
│  🚌 Info                                    │
├──────────────────────────────────────────────┤
│                                              │
│  ┌─────────────────────┐ ┌────────────────┐│
│  │   REGULER (Option)  │ │ EKSLUSIF (V)   ││
│  │   [Selected_border] │ │ [Highlight]    ││
│  │                     │ │                ││
│  │  ✅ AC              │ │ ✅ AC Premium  ││
│  │  ✅ Kursi Busa      │ │ ✅ Reclining   ││
│  │  ✅ Toilet          │ │ ✅ WiFi        ││
│  │  ✅ + 3 features    │ │ ✅ Monitor     ││
│  │                     │ │ ✅ Toilet VIP  ││
│  │  Rp 2.5M (Gray)     │ │ ✅ Makanan     ││
│  │  per orang          │ │                ││
│  │                     │ │ Rp 3.2M (Bold)││
│  │                     │ │ per orang      ││
│  │                     │ │ [Hemat 8%]    ││
│  └─────────────────────┘ └────────────────┘│
│                                              │
└──────────────────────────────────────────────┘

▼ SEBELUM SECTION "Data Pemesan" ▼
```

**Implementasi Files:**
- `resources/views/booking/create.blade.php` (Lines ~172-236)
- Radio buttons: `name="bus_facility_id"`
- JavaScript trigger: Hitung total price

---

### 3️⃣ **HALAMAN KONFIRMASI**
**URL:** http://yoursite.com/booking/confirmation/[booking-code]

**SECTION "BOOKING DETAILS" CARD:**
```
┌────────────────────────────────────────┐
│ PACKAGE IMAGE + INFO                   │
├────────────────────────────────────────┤
│ 📅 09 Feb 2025                         │
│ 🕐 20:00 WIB                           │
│ 🚌 2 Bus (80 Penumpang)                │
│ ✅ EKSLUSIF ← FASILITAS PILIHAN        │  ← VISIBLE HERE
│                                        │
│ Rincian Biaya:                         │
│ Harga x 2 bus: Rp 6.400.000            │
│ Total: Rp 6.400.000 ✅                 │
└────────────────────────────────────────┘
```

**Implementasi Files:**
- `resources/views/booking/confirmation.blade.php` (Lines ~42-48)
- Data from: `$booking->busFacility->name`

---

## 🔄 **FLOW DATA**

```
📱 Customer di Detail Paket
    ↓
    └─→ Lihat 2 pilihan: Reguler & Ekslusif
    └─→ Baca fitur masing-masing
    └─→ Lihat harga berbeda
    └─→ KLIK "Pesan Sekarang"
    
🎫 Form Booking
    ↓
    └─→ Lihat pilihan facilities LAGI
    └─→ CONFIRM pilihan (bisa ganti)
    └─→ Input data pemesan
    └─→ SUBMIT
         └─→ Backend: Ambil harga dari selected facility
         └─→ Backend: Simpan bus_facility_id
    
✅ Confirmation
    ↓
    └─→ Lihat pilihan facility yg dipilih
    └─→ Lihat total harga (sudah include)
    └─→ Instruksi pembayaran
```

---

## 📋 **CHECKLIST INTEGRASI**

### ✅ Backend (Completed)
- [x] Migrations created (3 tables)
- [x] Models created (BusFacility, PackageBusFacility)
- [x] Package model updated (relations)
- [x] Booking model updated (bus_facility_id column)
- [x] BookingController updated (validate & save facility_id)
- [x] Admin PackageController updated (save multiple facilities)

### ✅ Frontend (Completed)
- [x] Detail page sidebar (facility selection)
- [x] Booking form (facility selection)
- [x] Confirmation page (show selected facility)
- [x] Blade files syntax validation

### ⏳ Optional Enhancements
- [ ] JavaScript: Real-time total price update when facility changes
- [ ] Admin: UI for managing facilities per package
- [ ] Email: Include facility info in booking notification
- [ ] Dashboard: Analytics - most selected facilities

---

## 🎨 **STYLING REFERENCE**

### Card Styling:
```blade
border-2 border-gray-200
hover:border-primary-300
rounded-2xl p-4-5
transition-all

Selected state:
border-primary-500
bg-primary-50
```

### Features List:
```blade
🟢 Green checkmark icon (text-green-500)
Fas fa-check-circle
text-xs
```

### Price Display:
```blade
Primary: text-2xl font-bold text-primary-600
Discount: text-lg text-gray-500 line-through
Percentage: text-xs font-bold text-secondary-600 bg-secondary-100 px-3 py-1 rounded-full
```

---

## 🚀 **QUICK LINKS**

- **Package Detail Page:** `resources/views/packages/show.blade.php#L245`
- **Booking Form:** `resources/views/booking/create.blade.php#L172`
- **Confirmation Page:** `resources/views/booking/confirmation.blade.php#L42`
- **Booking Controller:** `app/Http/Controllers/BookingController.php#L21`
- **Models:** `app/Models/BusFacility.php`, `PackageBusFacility.php`

