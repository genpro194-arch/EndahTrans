@extends('layouts.app')

@section('title', 'Pesan ' . $package->name . ' - Endah Travel')

@section('content')
    <!-- Hero Header -->
    <section class="relative py-8 bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary-400/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="text-sm mb-2">
                        <a href="{{ route('home') }}" class="text-white/70 hover:text-white transition">Beranda</a>
                        <span class="mx-2 text-white/50">/</span>
                        <a href="{{ route('packages.index') }}" class="text-white/70 hover:text-white transition">Paket Wisata</a>
                        <span class="mx-2 text-white/50">/</span>
                        <span class="text-white">Pemesanan</span>
                    </nav>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">Form Pemesanan</h1>
                </div>
                <div class="hidden md:flex items-center bg-white/20 backdrop-blur rounded-2xl px-6 py-3">
                    <i class="fas fa-shield-alt text-white text-2xl mr-3"></i>
                    <div class="text-white">
                        <p class="text-sm font-semibold">Transaksi Aman</p>
                        <p class="text-xs text-white/80">Data Anda terlindungi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stepper -->
    <section class="bg-white border-b sticky top-16 z-40 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-center">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white rounded-full font-bold shadow-lg">
                        1
                    </div>
                    <span class="ml-2 font-semibold text-primary-600 hidden sm:block">Pilih Paket</span>
                </div>
                <div class="w-12 md:w-24 h-1 bg-primary-600 mx-2 md:mx-4 rounded"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white rounded-full font-bold shadow-lg animate-pulse">
                        2
                    </div>
                    <span class="ml-2 font-semibold text-primary-600 hidden sm:block">Isi Data</span>
                </div>
                <div class="w-12 md:w-24 h-1 bg-gray-200 mx-2 md:mx-4 rounded"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-400 rounded-full font-bold">
                        3
                    </div>
                    <span class="ml-2 font-medium text-gray-400 hidden sm:block">Pembayaran</span>
                </div>
                <div class="w-12 md:w-24 h-1 bg-gray-200 mx-2 md:mx-4 rounded"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-400 rounded-full font-bold">
                        4
                    </div>
                    <span class="ml-2 font-medium text-gray-400 hidden sm:block">Selesai</span>
                </div>
            </div>
        </div>
    </section>

    <div class="py-8 bg-gray-50 min-h-screen"
        x-data='{
            buses: 1,
            selectedFacility: "{{ $package->packageFacilities->first()->id ?? 1 }}",
            facilities: @json($package->packageFacilities->mapWithKeys(function($f) { return [$f->id => (int)($f->discount_price ?? $f->price)]; })),
            durationDays: {{ $package->duration_days ?? 1 }},
            capacity: {{ $package->capacity ?? 40 }},
            get pricePerBus() {
                let price = this.facilities[this.selectedFacility];
                return price ? price : 0;
            },
            get total() {
                return this.buses * this.pricePerBus * this.durationDays;
            },
            get totalCapacity() {
                return this.buses * this.capacity;
            },
            increase() {
                if (this.buses < 10) this.buses++;
            },
            decrease() {
                if (this.buses > 1) this.buses--;
            },
            format(num) {
                return new Intl.NumberFormat("id-ID").format(num);
            }
        }'>>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Main Form -->
                <div class="lg:w-2/3 space-y-6">
                    
                    <!-- Package Info Card -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                        <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <i class="fas fa-suitcase-rolling mr-2"></i> Detail Paket Wisata
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="md:w-1/3">
                                    <img src="{{ $package->image_url }}" alt="{{ $package->name }}" 
                                         class="w-full h-48 md:h-full object-cover rounded-xl shadow-md"
                                         onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400'">
                                </div>
                                <div class="md:w-2/3">
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        <span class="inline-flex items-center bg-secondary-100 text-secondary-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $package->destination->name ?? 'Indonesia' }}
                                        </span>
                                        @if($package->is_featured)
                                        <span class="inline-flex items-center bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            <i class="fas fa-star mr-1"></i> Best Seller
                                        </span>
                                        @endif
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $package->name }}</h4>
                                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $package->description }}</p>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                                            <i class="fas fa-calendar-alt text-primary-500 text-lg mb-1"></i>
                                            <p class="text-xs text-gray-500">Durasi</p>
                                            <p class="font-bold text-gray-900">{{ $package->duration_days }}H/{{ $package->duration_nights }}M</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                                            <i class="fas fa-users text-primary-500 text-lg mb-1"></i>
                                            <p class="text-xs text-gray-500">Kapasitas Bus</p>
                                            <p class="font-bold text-gray-900">{{ $package->capacity }} Orang</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">

                        <!-- Display All Errors -->
                        @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                                <div>
                                    <p class="font-semibold text-red-700 mb-2">Terjadi kesalahan:</p>
                                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Date & Bus Card -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-6">
                            <div class="bg-gradient-to-r from-secondary-500 to-secondary-600 px-6 py-4">
                                <h3 class="text-lg font-bold text-white flex items-center">
                                    <i class="fas fa-calendar-check mr-2"></i> Pilih Tanggal, Jam & Jumlah Bus
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Date Picker -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-calendar text-primary-500 mr-1"></i> Tanggal Keberangkatan
                                        </label>
                                        <div class="relative">
                                            <input type="date" name="booking_date" 
                                                   value="{{ old('booking_date', $package->departure_date?->format('Y-m-d') ?? date('Y-m-d')) }}" 
                                                   required
                                                   min="{{ date('Y-m-d') }}"
                                                   class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all text-lg font-medium @error('booking_date') border-red-500 @enderror">
                                            @error('booking_date')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <p class="text-xs text-gray-400 mt-2"><i class="fas fa-info-circle mr-1"></i> Minimal pemesanan H-1</p>
                                    </div>

                                    <!-- Time Picker -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-clock text-primary-500 mr-1"></i> Jam Keberangkatan
                                        </label>
                                        <div class="relative">
                                            <input type="time" name="departure_time" 
                                                   value="{{ old('departure_time', $package->departure_time?->format('H:i') ?? '20:00') }}" 
                                                   required
                                                   class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all text-lg font-medium @error('departure_time') border-red-500 @enderror">
                                            @error('departure_time')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <p class="text-xs text-gray-400 mt-2"><i class="fas fa-info-circle mr-1"></i> Format: HH:MM</p>
                                    </div>

                                    <!-- Bus Counter -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-bus text-primary-500 mr-1"></i> Jumlah Bus
                                        </label>
                                        <div class="flex items-center bg-gray-50 border-2 border-gray-200 rounded-xl p-2">
                                            <button type="button" @click="decrease()" 
                                                    class="w-12 h-12 bg-white rounded-lg shadow flex items-center justify-center text-primary-600 hover:bg-primary-50 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                                    :disabled="buses <= 1">
                                                <i class="fas fa-minus text-lg"></i>
                                            </button>
                                            <div class="flex-1">
                                                <div class="text-center">
                                                    <input type="hidden" name="number_of_buses" :value="buses">
                                                    <span class="text-3xl font-bold text-gray-900" x-text="buses"></span>
                                                    <p class="text-xs text-gray-500">Bus <span x-text="capacity"></span> Penumpang</p>
                                                </div>
                                            </div>
                                            <button type="button" @click="increase()" 
                                                    class="w-12 h-12 bg-white rounded-lg shadow flex items-center justify-center text-primary-600 hover:bg-primary-50 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                                    :disabled="buses >= 10">
                                                <i class="fas fa-plus text-lg"></i>
                                            </button>
                                        </div>
                                        <p class="text-xs text-gray-400 mt-2"><i class="fas fa-info-circle mr-1"></i> Min 1, Max 10 bus</p>
                                    </div>
                                </div>

                                <!-- Total Capacity -->
                                <div class="mt-6 bg-primary-50 border border-primary-200 rounded-xl p-4">
                                    <p class="text-sm text-gray-600 mb-2">Total Kapasitas Penumpang:</p>
                                    <p class="text-2xl font-bold text-primary-600" x-text="totalCapacity + ' Penumpang'"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Facility Selection -->
                        @if($package->packageFacilities && $package->packageFacilities->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-6">
                            <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-4">
                                <h3 class="text-lg font-bold text-white flex items-center">
                                    <i class="fas fa-bus mr-2"></i> Pilih Fasilitas Bus
                                </h3>
                            </div>
                            <div class="p-6">
                                @if ($errors->has('bus_facility_id'))
                                <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-4">
                                    <p class="text-red-600 text-sm"><i class="fas fa-exclamation-circle mr-1"></i> {{ $errors->first('bus_facility_id') }}</p>
                                </div>
                                @endif

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($package->packageFacilities as $facility)
                                    <div class="relative">
                                        <input type="radio" name="bus_facility_id" id="facility_{{ $facility->id }}" 
                                               value="{{ $facility->id }}" 
                                               class="hidden peer"
                                               @if($loop->first) checked @endif
                                               @change="selectedFacility = $el.value"
                                               @error('bus_facility_id') checked @enderror>
                                        
                                        <div class="border-2 border-gray-200 rounded-2xl p-5 transition-all cursor-default peer-checked:border-primary-500 peer-checked:bg-primary-50">
                                            
                                            <!-- Facility Name & Radio -->
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-900 text-lg">{{ $facility->busFacility->name }}</h4>
                                                    <p class="text-xs text-gray-500 mt-1"><i class="fas fa-chair mr-1"></i> Kapasitas: {{ $package->capacity ?? '40' }} orang</p>
                                                </div>
                                                <label for="facility_{{ $facility->id }}" 
                                                       class="w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 cursor-pointer hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-primary-500 transition-all">
                                                    <i class="fas fa-check text-white text-xs hidden peer-checked:inline"></i>
                                                </label>
                                            </div>
                                            
                                            <!-- Features List -->
                                            <div class="mb-4 pb-4 border-b border-gray-100">
                                                @php
                                                    $displayFeatures = $facility->features ?? $facility->busFacility->features;
                                                @endphp
                                                @if($displayFeatures)
                                                <ul class="space-y-2">
                                                    @foreach((array) $displayFeatures as $feature)
                                                        @if($feature)
                                                        <li class="text-xs text-gray-600 flex items-center">
                                                            <i class="fas fa-check-circle text-green-500 mr-2 text-xs"></i>
                                                            <span>{{ is_array($feature) ? implode(', ', $feature) : $feature }}</span>
                                                        </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                            
                                            <!-- Price Display -->
                                            <div class="flex items-end justify-between">
                                                <div>
                                                    @if($facility->discount_price)
                                                        <p class="text-xs text-gray-500 line-through mb-1">Rp {{ number_format($facility->price, 0, ',', '.') }}</p>
                                                        <p class="text-2xl font-bold text-primary-600">Rp {{ number_format($facility->discount_price, 0, ',', '.') }}</p>
                                                    @else
                                                        <p class="text-2xl font-bold text-primary-600">Rp {{ number_format($facility->price, 0, ',', '.') }}</p>
                                                    @endif
                                                    <p class="text-xs text-gray-500 mt-1">per orang</p>
                                                </div>
                                                @if($facility->discount_price)
                                                <div class="text-right">
                                                    @php
                                                        $discountPercent = round((($facility->price - $facility->discount_price) / $facility->price) * 100);
                                                    @endphp
                                                    <span class="text-xs font-bold text-secondary-600 bg-secondary-100 px-3 py-1 rounded-full">
                                                        Hemat {{ $discountPercent }}%
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Contact Person Card -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-6">
                            <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-4">
                                <h3 class="text-lg font-bold text-white flex items-center">
                                    <i class="fas fa-user-circle mr-2"></i> Data Pemesan (Contact Person)
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                                    <div class="flex items-start">
                                        <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                                        <p class="text-sm text-blue-700">Data pemesan akan digunakan untuk konfirmasi dan pengiriman e-ticket. Pastikan data yang diisi valid.</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-user text-primary-500 mr-1"></i> Nama Lengkap <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                               class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all @error('customer_name') border-red-500 @enderror"
                                               placeholder="Nama sesuai KTP/Identitas">
                                        @error('customer_name')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-envelope text-primary-500 mr-1"></i> Email <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" name="customer_email" value="{{ old('customer_email') }}" required
                                               class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all @error('customer_email') border-red-500 @enderror"
                                               placeholder="email@contoh.com">
                                        @error('customer_email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fab fa-whatsapp text-green-500 mr-1"></i> No. WhatsApp <span class="text-red-500">*</span>
                                        </label>
                                        <div class="flex">
                                            <span class="inline-flex items-center px-4 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-l-xl text-gray-500 font-medium">
                                                +62
                                            </span>
                                            <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required
                                                   class="flex-1 px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-r-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all @error('customer_phone') border-red-500 @enderror"
                                                   placeholder="812xxxxxxxx">
                                        </div>
                                        @error('customer_phone')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-map-marker-alt text-primary-500 mr-1"></i> Alamat
                                        </label>
                                        <input type="text" name="customer_address" value="{{ old('customer_address') }}"
                                               class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all"
                                               placeholder="Alamat lengkap (opsional)">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Special Request Card -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-6">
                            <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                                <h3 class="text-lg font-bold text-white flex items-center">
                                    <i class="fas fa-comment-dots mr-2"></i> Permintaan Khusus (Opsional)
                                </h3>
                            </div>
                            <div class="p-6">
                                <textarea name="special_requests" rows="3"
                                          class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all resize-none"
                                          placeholder="Contoh: Alergi makanan tertentu, butuh kursi roda, request kamar connecting, dll.">{{ old('special_requests') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button (Mobile) -->
                        <div class="lg:hidden">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all flex items-center justify-center">
                                <i class="fas fa-lock mr-2"></i> Lanjutkan Pembayaran
                                <span class="ml-2 bg-white/20 px-3 py-1 rounded-full text-sm" x-text="'Rp ' + format(total)"></span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Sidebar - Price Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 sticky top-36 overflow-hidden">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-primary-600 to-secondary-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <i class="fas fa-receipt mr-2"></i> Ringkasan Pemesanan
                            </h3>
                        </div>
                        
                        <div class="p-6">
                            <!-- Price Breakdown -->
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Harga Per Bus</span>
                                    <span class="font-semibold text-gray-900" x-text="'Rp ' + format(pricePerBus)"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Jumlah Bus</span>
                                    <span class="font-semibold text-gray-900">
                                        <span x-text="buses"></span> bus
                                    </span>
                                </div>
                                <div class="flex justify-between items-center bg-blue-50 p-3 rounded-lg border border-blue-200">
                                    <span class="text-gray-600 text-sm">Durasi (Perjalanan Malam)</span>
                                    <span class="font-semibold text-blue-600">
                                        <span x-text="durationDays"></span>x
                                    </span>
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t-2 border-gray-200">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-semibold text-gray-900">
                                        <span x-text="'Rp ' + format(buses * pricePerBus * durationDays)"></span>
                                    </span>
                                </div>
                                @if($package->discount_price)
                                <div class="flex justify-between items-center text-secondary-600">
                                    <span>Diskon</span>
                                    <span class="font-semibold">- Rp <span x-text="format(buses * durationDays * {{ $package->price - ($package->discount_price ?? $package->price) }})"></span></span>
                                </div>
                                @endif
                            </div>

                            <!-- Total -->
                            <div class="border-t-2 border-dashed border-gray-200 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                                    <span class="text-2xl font-extrabold text-primary-600" x-text="'Rp ' + format(total)"></span>
                                </div>
                                <p class="text-xs text-gray-400 mt-1">*Sudah termasuk pajak dan biaya layanan</p>
                            </div>

                            <!-- Submit Button (Desktop) -->
                            <button type="button" onclick="document.getElementById('booking-form').submit()"
                                    class="hidden lg:flex w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all items-center justify-center group">
                                <i class="fas fa-lock mr-2 group-hover:animate-bounce"></i> Lanjutkan Pembayaran
                            </button>

                            <!-- Payment Methods -->
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <p class="text-xs text-gray-500 mb-3 text-center">Metode Pembayaran</p>
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <span class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600">BCA</span>
                                    <span class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600">Mandiri</span>
                                    <span class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600">BNI</span>
                                    <span class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600">BRI</span>
                                </div>
                            </div>
                        </div>

                        <!-- Guarantee Badge -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-t border-green-100">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-semibold text-green-800 text-sm">Jaminan Harga Terbaik</p>
                                    <p class="text-xs text-green-600">100% uang kembali jika menemukan harga lebih murah</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Help Card -->
                    <div class="mt-6 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-headset text-primary-500 mr-2"></i> Butuh Bantuan?
                        </h4>
                        <p class="text-sm text-gray-600 mb-4">Tim kami siap membantu 24/7</p>
                        <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Endah Travel, saya butuh bantuan untuk pemesanan paket: ' . $package->name) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold transition-all">
                            <i class="fab fa-whatsapp mr-2 text-xl"></i> Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection