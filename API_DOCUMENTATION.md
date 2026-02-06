# API Documentation - Endah Trans Bus Packages

## Base URL
```
http://localhost:8000/api
```

## Endpoints

### 1. Get All Packages
**Endpoint:** `GET /api/packages`

**Description:** Mengambil semua paket bus yang aktif

**Response:**
```json
{
  "success": true,
  "message": "Packages retrieved successfully",
  "data": [
    {
      "id": 1,
      "destination_id": 1,
      "name": "Big Bus - Tour dalam kota",
      "bus_type": "big",
      "capacity": 40,
      "slug": "big-bus-tour-dalam-kota",
      "description": "Paket tour Big Bus ke Tour dalam kota",
      "price": 2800000,
      ...
    }
  ]
}
```

### 2. Get Big Bus Packages
**Endpoint:** `GET /api/packages/bus/big`

**Description:** Mengambil semua paket Big Bus (kapasitas 40 penumpang)

**Response:**
```json
{
  "success": true,
  "message": "Packages retrieved successfully",
  "bus_type": "big",
  "capacity": 40,
  "count": 18,
  "data": [...]
}
```

### 3. Get Medium Bus Packages
**Endpoint:** `GET /api/packages/bus/medium`

**Description:** Mengambil semua paket Medium Bus (kapasitas 35 penumpang)

**Response:**
```json
{
  "success": true,
  "message": "Packages retrieved successfully",
  "bus_type": "medium",
  "capacity": 35,
  "count": 18,
  "data": [...]
}
```

### 4. Get Price Comparison for Destination
**Endpoint:** `GET /api/packages/destination/{slug}/comparison`

**Example:** `GET /api/packages/destination/jogja/comparison`

**Description:** Membandingkan harga Big Bus vs Medium Bus untuk destinasi tertentu

**Response:**
```json
{
  "success": true,
  "message": "Package comparison retrieved successfully",
  "destination": "jogja",
  "data": {
    "big": {
      "name": "Big Bus - Jogja",
      "capacity": 40,
      "price": 5000000,
      "slug": "big-bus-jogja",
      "id": 2
    },
    "medium": {
      "name": "Medium Bus - Jogja",
      "capacity": 35,
      "price": 4500000,
      "slug": "medium-bus-jogja",
      "id": 20
    }
  }
}
```

### 5. Get Featured Routes (Rute Populer)
**Endpoint:** `GET /api/routes/featured`

**Description:** Mengambil rute populer/unggulan (Jogja, Jakarta, Surabaya, Bandung, Lombok, Bali)

**Response:**
```json
{
  "success": true,
  "message": "Featured routes retrieved successfully",
  "count": 6,
  "data": [
    {
      "destination": "Jogja",
      "slug": "jogja",
      "description": "Destinasi Jogja",
      "big_bus": {
        "name": "Big Bus - Jogja",
        "capacity": 40,
        "price": 5000000,
        "slug": "big-bus-jogja"
      },
      "medium_bus": {
        "name": "Medium Bus - Jogja",
        "capacity": 35,
        "price": 4500000,
        "slug": "medium-bus-jogja"
      }
    },
    ...
  ]
}
```

### 6. Get Cheapest Routes (Harga Terbaik)
**Endpoint:** `GET /api/routes/cheapest`

**Description:** Mengambil semua rute diurutkan dari harga termurah, dengan pilihan Big Bus & Medium Bus untuk setiap destinasi

**Response:**
```json
{
  "success": true,
  "message": "Cheapest routes retrieved successfully",
  "count": 18,
  "data": [
    {
      "destination": "Tour dalam kota",
      "slug": "tour-dalam-kota",
      "cheapest_price": 2500000,
      "big_bus": {
        "price": 2800000,
        "capacity": 40,
        "slug": "big-bus-tour-dalam-kota"
      },
      "medium_bus": {
        "price": 2500000,
        "capacity": 35,
        "slug": "medium-bus-tour-dalam-kota"
      }
    },
    {
      "destination": "Jogja",
      "slug": "jogja",
      "cheapest_price": 4500000,
      "big_bus": {
        "price": 5000000,
        "capacity": 40,
        "slug": "big-bus-jogja"
      },
      "medium_bus": {
        "price": 4500000,
        "capacity": 35,
        "slug": "medium-bus-jogja"
      }
    },
    ...
  ]
}
```

## Data Struktur Package

```json
{
  "id": 1,
  "destination_id": 1,
  "name": "Big Bus - Tour dalam kota",
  "bus_type": "big",          // "big" atau "medium"
  "capacity": 40,              // Kapasitas penumpang
  "slug": "big-bus-tour-dalam-kota",
  "description": "Paket tour Big Bus ke Tour dalam kota",
  "price": 2800000,            // Harga dalam Rupiah
  "discount_price": null,      // Harga diskon jika ada
  "duration_days": 1,
  "max_person": 40,
  "min_person": 1,
  "image": null,
  "gallery": null,
  "departure_date": null,
  "departure_time": null,
  "meeting_point": null,
  "is_featured": false,
  "is_active": true,
  "created_at": "2026-01-30T...",
  "updated_at": "2026-01-30T...",
  "destination": {
    "id": 1,
    "name": "Tour dalam kota",
    "slug": "tour-dalam-kota",
    "description": "Destinasi Tour dalam kota",
    ...
  }
}
```

## Destinasi Tersedia (18 Tujuan)

1. Tour dalam kota
2. Jogja
3. Semarang
4. Jepara
5. Pati
6. Purwokerto
7. Tegal
8. Surabaya
9. Malang
10. Bandung
11. Cirebon
12. Jakarta
13. Bogor
14. Tangerang
15. Bekasi
16. Lampung
17. Bali
18. Lombok

## Harga Big Bus

| Destinasi | Harga |
|-----------|-------|
| Tour dalam kota | Rp 2.800.000 |
| Jogja | Rp 5.000.000 |
| Semarang | Rp 5.000.000 |
| Jepara | Rp 6.500.000 |
| Pati | Rp 6.500.000 |
| Purwokerto | Rp 7.500.000 |
| Tegal | Rp 7.500.000 |
| Surabaya | Rp 9.000.000 |
| Malang | Rp 9.500.000 |
| Bandung | Rp 11.000.000 |
| Cirebon | Rp 11.000.000 |
| Jakarta | Rp 12.000.000 |
| Bogor | Rp 12.000.000 |
| Tangerang | Rp 12.000.000 |
| Bekasi | Rp 12.000.000 |
| Lampung | Rp 15.000.000 |
| Bali | Rp 17.000.000 |
| Lombok | Rp 24.000.000 |

## Harga Medium Bus

| Destinasi | Harga |
|-----------|-------|
| Tour dalam kota | Rp 2.500.000 |
| Jogja | Rp 4.500.000 |
| Semarang | Rp 4.500.000 |
| Jepara | Rp 6.000.000 |
| Pati | Rp 6.000.000 |
| Purwokerto | Rp 6.500.000 |
| Tegal | Rp 6.500.000 |
| Surabaya | Rp 7.500.000 |
| Malang | Rp 8.000.000 |
| Bandung | Rp 9.000.000 |
| Cirebon | Rp 9.000.000 |
| Jakarta | Rp 10.000.000 |
| Bogor | Rp 10.000.000 |
| Tangerang | Rp 10.000.000 |
| Bekasi | Rp 10.000.000 |
| Lampung | Rp 12.000.000 |
| Bali | Rp 13.500.000 |
| Lombok | Rp 18.000.000 |

## Testing dengan curl

```bash
# Get all packages
curl "http://127.0.0.1:8000/api/packages"

# Get Big Bus packages
curl "http://127.0.0.1:8000/api/packages/bus/big"

# Get Medium Bus packages
curl "http://127.0.0.1:8000/api/packages/bus/medium"

# Get price comparison for Jogja
curl "http://127.0.0.1:8000/api/packages/destination/jogja/comparison"

# Get featured routes (rute populer)
curl "http://127.0.0.1:8000/api/routes/featured"

# Get cheapest routes (harga terbaik)
curl "http://127.0.0.1:8000/api/routes/cheapest"
```

## Testing dengan Postman

1. Import endpoints ke Postman
2. Set request method ke GET
3. Gunakan URLs dari dokumentasi ini
4. Kirim request dan lihat JSON response

---

## Featured Routes (Rute Populer)

Destinasi-destinasi yang ditandai sebagai **rute populer/unggulan**:
1. Jogja
2. Jakarta
3. Surabaya
4. Bandung
5. Lombok
6. Bali

Gunakan endpoint `/api/routes/featured` untuk menampilkan rute-rute ini di homepage dengan design yang menarik.

---

## Cheapest Routes (Harga Terbaik)

Endpoint `/api/routes/cheapest` menampilkan semua 18 destinasi diurutkan dari harga **paling murah ke paling mahal**. 

**Urutan (sample):**
1. Tour dalam kota - Rp 2.500.000 (Medium Bus)
2. Semarang - Rp 4.500.000 (Medium Bus)
3. Jogja - Rp 4.500.000 (Medium Bus)
4. Pati - Rp 6.000.000 (Medium Bus)
... dan seterusnya

Gunakan endpoint ini untuk:
- Halaman "Harga Terbaik" atau "Budget Friendly"
- Filter harga termurah di packages listing
- Promosi paket hemat
