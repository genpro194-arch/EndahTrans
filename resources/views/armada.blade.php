@extends('layouts.app')

@section('title', 'Charter Armada - Endah Trans')

@section('content')

{{-- HERO --}}
<section class="relative bg-primary-900 py-24 overflow-hidden">
    <div class="absolute -top-20 -right-20 w-80 h-80 border border-white/5 rounded-full"></div>
    <div class="absolute -bottom-10 -left-10 w-56 h-56 border border-white/5 rounded-full"></div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <p class="text-xs font-bold tracking-[0.3em] text-primary-300 uppercase mb-4">
            <i class="fas fa-bus mr-2"></i>CHARTER ARMADA
        </p>
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-5 leading-tight">
            Pilih Kelas <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-300 to-secondary-300">Perjalanan</span> Anda
        </h1>
        <p class="text-primary-200 text-lg max-w-2xl mx-auto leading-relaxed">
            Dua pilihan armada — Eksklusif dan Reguler — dirancang untuk setiap kebutuhan grup dan anggaran Anda.
        </p>
    </div>
</section>

{{-- INTERACTIVE FLEET SELECTOR (Alpine.js) --}}
<div x-data="{
    fleet: null,
    step: 1,
    numBuses: 1,
    durationDays: 1,
    rates: { eksklusif: 4500000, reguler: 2500000 },
    get rate()  { return this.rates[this.fleet] ?? 0 },
    get total() { return this.rate * this.numBuses * this.durationDays },
    get fleetLabel() { return this.fleet === 'eksklusif' ? 'Eksklusif' : 'Reguler' },
    rp(n) { return 'Rp\u00a0' + parseInt(n).toLocaleString('id-ID') },
    select(type) {
        this.fleet = type;
        this.step  = 1;
        this.$nextTick(() => {
            const el = document.getElementById('fleet-detail');
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }
}">

{{-- SELECTOR CARDS --}}
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-sm font-bold tracking-widest text-primary-500 text-center uppercase mb-10">Tentukan Kelas Bus Charter</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- EKSKLUSIF --}}
            <button @click="select('eksklusif')" type="button"
                :class="fleet === 'eksklusif'
                    ? 'ring-2 ring-primary-500 bg-primary-50 shadow-2xl scale-[1.02]'
                    : 'ring-1 ring-slate-200 bg-white hover:ring-primary-300 hover:shadow-lg hover:scale-[1.01]'"
                class="text-left rounded-2xl p-8 transition-all duration-300 cursor-pointer relative overflow-hidden focus:outline-none">
                <div x-show="fleet === 'eksklusif'" x-transition
                     class="absolute top-4 right-4 bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                    DIPILIH
                </div>
                <div class="flex items-start gap-5">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-600 flex items-center justify-center flex-shrink-0 shadow-md">
                        <i class="fas fa-crown text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold tracking-widest text-primary-500 uppercase mb-1">Kelas</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">Eksklusif</h3>
                        <p class="text-slate-500 text-sm mt-1 leading-relaxed">Big Bus 45 kursi &middot; Fasilitas premium untuk kenyamanan perjalanan jarak jauh terbaik.</p>
                    </div>
                </div>
                <div class="mt-6 pt-5 border-t border-slate-100 flex items-end justify-between">
                    <div class="space-y-1">
                        <p class="text-xs text-slate-400 font-medium">Mulai dari</p>
                        <p class="text-3xl font-extrabold text-primary-600">Rp&nbsp;4.500.000<span class="text-sm font-normal text-slate-400">/bus/hari</span></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary-600">
                        Lihat Detail <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </button>

            {{-- REGULER --}}
            <button @click="select('reguler')" type="button"
                :class="fleet === 'reguler'
                    ? 'ring-2 ring-secondary-500 bg-secondary-50 shadow-2xl scale-[1.02]'
                    : 'ring-1 ring-slate-200 bg-white hover:ring-secondary-300 hover:shadow-lg hover:scale-[1.01]'"
                class="text-left rounded-2xl p-8 transition-all duration-300 cursor-pointer relative overflow-hidden focus:outline-none">
                <div x-show="fleet === 'reguler'" x-transition
                     class="absolute top-4 right-4 bg-secondary-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                    DIPILIH
                </div>
                <div class="flex items-start gap-5">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-secondary-400 to-secondary-600 flex items-center justify-center flex-shrink-0 shadow-md">
                        <i class="fas fa-bus text-white text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold tracking-widest text-secondary-500 uppercase mb-1">Kelas</p>
                        <h3 class="text-2xl font-extrabold text-slate-900">Reguler</h3>
                        <p class="text-slate-500 text-sm mt-1 leading-relaxed">Medium Bus 35 kursi &middot; Nyaman dan ekonomis untuk rombongan wisata maupun korporat.</p>
                    </div>
                </div>
                <div class="mt-6 pt-5 border-t border-slate-100 flex items-end justify-between">
                    <div class="space-y-1">
                        <p class="text-xs text-slate-400 font-medium">Mulai dari</p>
                        <p class="text-3xl font-extrabold text-secondary-600">Rp&nbsp;2.500.000<span class="text-sm font-normal text-slate-400">/bus/hari</span></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-secondary-600">
                        Lihat Detail <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </button>
        </div>
    </div>
</section>

{{-- FLEET DETAIL --}}
<div id="fleet-detail" x-show="fleet !== null"
     x-transition:enter="transition ease-out duration-400"
     x-transition:enter-start="opacity-0 translate-y-6"
     x-transition:enter-end="opacity-100 translate-y-0"
     class="bg-slate-50 border-t border-slate-100">

    {{-- EKSKLUSIF DETAIL --}}
    <div x-show="fleet === 'eksklusif'" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <span class="inline-block bg-primary-100 text-primary-700 text-xs font-bold px-3 py-1 rounded-full mb-2 tracking-widest uppercase">
                    <i class="fas fa-crown mr-1"></i> Kelas Eksklusif
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900">Big Bus &middot; 45 Kursi Reclining</h2>
                <p class="text-slate-500 mt-1">Armada premium untuk perjalanan wisata VIP, MICE, dan antar-kota jarak jauh.</p>
            </div>
            <button @click="fleet = null" class="flex items-center gap-2 text-sm text-slate-400 hover:text-primary-600 transition font-semibold">
                <i class="fas fa-times-circle"></i> Ganti pilihan
            </button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-2 rounded-2xl overflow-hidden h-56">
                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=900&q=80" alt="Bus Eksklusif" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
                <div class="rounded-xl overflow-hidden h-32">
                    <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=600&q=80" alt="Interior Eksklusif" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
                <div class="rounded-xl overflow-hidden h-32">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80" alt="Bus Eksklusif" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
            </div>
            <div class="space-y-7">
                <div class="grid grid-cols-3 gap-3">
                    @foreach([['fas fa-users','Kapasitas','45 Kursi'],['fas fa-ruler-combined','Panjang','12 m'],['fas fa-road','Jarak Maks','&le; 1.000 km']] as [$icon,$label,$val])
                    <div class="bg-white rounded-xl p-4 text-center border border-slate-100">
                        <i class="{{ $icon }} text-primary-500 mb-2 block"></i>
                        <p class="text-xs text-slate-400 font-medium">{{ $label }}</p>
                        <p class="text-sm font-extrabold text-slate-900 mt-0.5">{!! $val !!}</p>
                    </div>
                    @endforeach
                </div>
                <div>
                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">Fasilitas Lengkap</p>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach([['fas fa-snowflake','AC Double Blower'],['fas fa-wifi','WiFi Gratis'],['fas fa-tv','LCD TV 42"'],['fas fa-bolt','USB Charger/Kursi'],['fas fa-couch','Kursi Reclining Full'],['fas fa-restroom','Toilet VIP'],['fas fa-music','Audio Premium'],['fas fa-video','CCTV'],['fas fa-suitcase','Bagasi Extra Large'],['fas fa-utensils','Snack & Minuman'],['fas fa-bed','Bantal & Selimut'],['fas fa-user-tie','Guide Opsional']] as [$icon,$label])
                        <div class="flex items-center gap-2.5 bg-white rounded-lg px-3 py-2.5 border border-slate-100">
                            <i class="{{ $icon }} text-primary-500 text-xs w-4 text-center"></i>
                            <span class="text-sm text-slate-700 font-medium">{{ $label }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <a href="#form-pemesanan" onclick="event.preventDefault();document.getElementById('form-pemesanan').scrollIntoView({behavior:'smooth'})"
                   class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-bold py-4 rounded-xl hover:opacity-90 transition shadow-lg shadow-primary-500/30">
                    <i class="fas fa-calendar-check"></i> Pesan Bus Eksklusif
                </a>
            </div>
        </div>
    </div>

    {{-- REGULER DETAIL --}}
    <div x-show="fleet === 'reguler'" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <span class="inline-block bg-secondary-100 text-secondary-700 text-xs font-bold px-3 py-1 rounded-full mb-2 tracking-widest uppercase">
                    <i class="fas fa-bus mr-1"></i> Kelas Reguler
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900">Medium Bus &middot; 35 Kursi</h2>
                <p class="text-slate-500 mt-1">Pilihan ekonomis tanpa mengorbankan kenyamanan untuk rombongan wisata dan korporat.</p>
            </div>
            <button @click="fleet = null" class="flex items-center gap-2 text-sm text-slate-400 hover:text-secondary-600 transition font-semibold">
                <i class="fas fa-times-circle"></i> Ganti pilihan
            </button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-2 rounded-2xl overflow-hidden h-56">
                    <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=900&q=80" alt="Bus Reguler" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
                <div class="rounded-xl overflow-hidden h-32">
                    <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=600&q=80" alt="Bus Reguler" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
                <div class="rounded-xl overflow-hidden h-32">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80" alt="Interior Reguler" class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
            </div>
            <div class="space-y-7">
                <div class="grid grid-cols-3 gap-3">
                    @foreach([['fas fa-users','Kapasitas','35 Kursi'],['fas fa-ruler-combined','Panjang','9 m'],['fas fa-road','Jarak Maks','&le; 800 km']] as [$icon,$label,$val])
                    <div class="bg-white rounded-xl p-4 text-center border border-slate-100">
                        <i class="{{ $icon }} text-secondary-500 mb-2 block"></i>
                        <p class="text-xs text-slate-400 font-medium">{{ $label }}</p>
                        <p class="text-sm font-extrabold text-slate-900 mt-0.5">{!! $val !!}</p>
                    </div>
                    @endforeach
                </div>
                <div>
                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">Fasilitas Tersedia</p>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach([['fas fa-snowflake','AC Full'],['fas fa-tv','LCD TV 24"'],['fas fa-bolt','USB Charger'],['fas fa-chair','Kursi Standar'],['fas fa-restroom','Toilet'],['fas fa-music','Audio System'],['fas fa-video','CCTV'],['fas fa-suitcase','Bagasi Luas'],['fas fa-first-aid','P3K'],['fas fa-id-badge','Driver Bersertifikat']] as [$icon,$label])
                        <div class="flex items-center gap-2.5 bg-white rounded-lg px-3 py-2.5 border border-slate-100">
                            <i class="{{ $icon }} text-secondary-500 text-xs w-4 text-center"></i>
                            <span class="text-sm text-slate-700 font-medium">{{ $label }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <a href="#form-pemesanan" onclick="event.preventDefault();document.getElementById('form-pemesanan').scrollIntoView({behavior:'smooth'})"
                   class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-secondary-500 to-secondary-700 text-white font-bold py-4 rounded-xl hover:opacity-90 transition shadow-lg shadow-secondary-500/30">
                    <i class="fas fa-calendar-check"></i> Pesan Bus Reguler
                </a>
            </div>
        </div>
    </div>
</div>

{{-- BOOKING FORM (2-step) --}}
<section id="form-pemesanan"
         x-show="fleet !== null"
         x-transition:enter="transition ease-out duration-400 delay-100"
         x-transition:enter-start="opacity-0 translate-y-8"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="py-16 bg-white border-t border-slate-100">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Step Indicator --}}
        <div class="flex items-center justify-center mb-10">
            <div class="flex items-center">
                <div :class="step >= 1 ? 'bg-primary-600 text-white' : 'bg-slate-200 text-slate-500'"
                     class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition">1</div>
                <span :class="step >= 1 ? 'text-slate-800' : 'text-slate-400'"
                      class="ml-2 text-sm font-semibold hidden sm:inline">Detail Perjalanan</span>
            </div>
            <div class="w-16 sm:w-24 h-px bg-slate-200 mx-3"></div>
            <div class="flex items-center">
                <div :class="step >= 2 ? 'bg-primary-600 text-white' : 'bg-slate-200 text-slate-500'"
                     class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition">2</div>
                <span :class="step >= 2 ? 'text-slate-800' : 'text-slate-400'"
                      class="ml-2 text-sm font-semibold hidden sm:inline">Konfirmasi &amp; Bayar</span>
            </div>
        </div>

        @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700 font-semibold">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <p class="text-sm font-bold text-red-700 mb-2"><i class="fas fa-exclamation-circle mr-1"></i> Mohon perbaiki kesalahan berikut:</p>
            <ul class="text-sm text-red-600 space-y-1 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('charter.store') }}" id="charter-form">
            @csrf
            <input type="hidden" name="fleet_type" :value="fleet">
            <input type="hidden" name="num_buses" :value="numBuses">
            <input type="hidden" name="duration_days" :value="durationDays">

            {{-- STEP 1 --}}
            <div x-show="step === 1">
                <h3 class="text-xl font-extrabold text-slate-900 mb-6">
                    Isi Detail Perjalanan
                    <span x-text="'— ' + fleetLabel"
                          :class="fleet === 'eksklusif' ? 'text-primary-600' : 'text-secondary-600'"
                          class="text-base font-bold ml-1"></span>
                </h3>
                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="customer_name" required placeholder="Budi Santoso"
                                   value="{{ old('customer_name') }}"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="customer_email" required placeholder="budi@email.com"
                                   value="{{ old('customer_email') }}"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Nomor WhatsApp / Telepon <span class="text-red-500">*</span></label>
                        <input type="text" name="customer_phone" required placeholder="08123456789"
                               value="{{ old('customer_phone') }}"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Tujuan / Destinasi <span class="text-red-500">*</span></label>
                        <input type="text" name="destination" required placeholder="Contoh: Dieng, Wonosobo"
                               value="{{ old('destination') }}"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Tanggal Keberangkatan <span class="text-red-500">*</span></label>
                            <input type="date" name="departure_date" required min="{{ date('Y-m-d') }}"
                                   value="{{ old('departure_date') }}"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Jam Berangkat <span class="text-red-500">*</span></label>
                            <input type="time" name="departure_time" required value="{{ old('departure_time', '07:00') }}"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Durasi <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-3">
                                <button type="button" @click="if(durationDays>1) durationDays--"
                                        class="w-10 h-10 rounded-lg border border-slate-200 bg-white flex items-center justify-center text-slate-600 hover:border-primary-400 hover:text-primary-600 transition font-bold">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <div class="flex-1 text-center">
                                    <span x-text="durationDays" class="text-2xl font-extrabold text-slate-900"></span>
                                    <span class="text-sm text-slate-500 ml-1">hari</span>
                                </div>
                                <button type="button" @click="if(durationDays<30) durationDays++"
                                        class="w-10 h-10 rounded-lg border border-slate-200 bg-white flex items-center justify-center text-slate-600 hover:border-primary-400 hover:text-primary-600 transition font-bold">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Jumlah Bus <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-3">
                                <button type="button" @click="if(numBuses>1) numBuses--"
                                        class="w-10 h-10 rounded-lg border border-slate-200 bg-white flex items-center justify-center text-slate-600 hover:border-primary-400 hover:text-primary-600 transition font-bold">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <div class="flex-1 text-center">
                                    <span x-text="numBuses" class="text-2xl font-extrabold text-slate-900"></span>
                                    <span class="text-sm text-slate-500 ml-1">unit</span>
                                </div>
                                <button type="button" @click="if(numBuses<20) numBuses++"
                                        class="w-10 h-10 rounded-lg border border-slate-200 bg-white flex items-center justify-center text-slate-600 hover:border-primary-400 hover:text-primary-600 transition font-bold">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5">Catatan Tambahan</label>
                        <textarea name="special_requests" rows="3" placeholder="Permintaan khusus, rute detail, atau informasi lainnya..."
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition resize-none">{{ old('special_requests') }}</textarea>
                    </div>
                </div>

                {{-- Live Price Preview --}}
                <div :class="fleet === 'eksklusif' ? 'bg-primary-50 border-primary-200' : 'bg-secondary-50 border-secondary-200'"
                     class="mt-6 p-5 rounded-xl border flex items-center justify-between">
                    <div class="text-sm text-slate-600 space-y-0.5">
                        <div x-text="rp(rate) + ' /bus/hari'" class="text-xs text-slate-400 font-medium"></div>
                        <div>
                            <span x-text="numBuses + ' bus'"></span>
                            <span class="text-slate-400 mx-1">&times;</span>
                            <span x-text="durationDays + ' hari'"></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-400 font-medium">Estimasi Total</p>
                        <p :class="fleet === 'eksklusif' ? 'text-primary-700' : 'text-secondary-700'"
                           class="text-xl font-extrabold" x-text="rp(total)"></p>
                    </div>
                </div>

                <button type="button"
                        @click="step = 2; $nextTick(() => { document.getElementById('step2-anchor').scrollIntoView({behavior:'smooth'}) })"
                        :class="fleet === 'eksklusif' ? 'bg-gradient-to-r from-primary-600 to-secondary-600 shadow-primary-500/30' : 'bg-gradient-to-r from-secondary-500 to-secondary-700 shadow-secondary-500/30'"
                        class="mt-6 w-full py-4 rounded-xl text-white font-bold shadow-lg hover:opacity-90 transition flex items-center justify-center gap-2">
                    Lanjut ke Konfirmasi <i class="fas fa-arrow-right"></i>
                </button>
            </div>

            {{-- STEP 2 (Review + Submit) --}}
            <div x-show="step === 2">
                <div id="step2-anchor"></div>
                <div class="flex items-center gap-3 mb-6">
                    <button type="button" @click="step = 1" class="flex items-center gap-1.5 text-sm text-slate-400 hover:text-slate-700 transition font-semibold">
                        <i class="fas fa-arrow-left text-xs"></i> Kembali
                    </button>
                    <h3 class="text-xl font-extrabold text-slate-900">Konfirmasi Pemesanan</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Detail Armada</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Kelas</span>
                                <span x-text="fleetLabel" class="font-extrabold text-slate-900"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Jumlah Bus</span>
                                <span x-text="numBuses + ' unit'" class="font-bold text-slate-900"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Durasi</span>
                                <span x-text="durationDays + ' hari'" class="font-bold text-slate-900"></span>
                            </div>
                            <div class="flex justify-between border-t border-slate-200 pt-2 mt-2">
                                <span class="text-slate-500">Harga Satuan</span>
                                <span x-text="rp(rate) + '/bus/hari'" class="font-bold text-slate-900"></span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Info Pembayaran</p>
                        <div class="space-y-2.5 text-sm">
                            <p class="text-slate-500 text-xs">Transfer ke rekening berikut:</p>
                            <div class="bg-white rounded-lg p-3 border border-slate-200">
                                <p class="font-extrabold text-slate-900 text-base">Bank BCA</p>
                                <p class="text-slate-700 font-mono text-lg mt-0.5">1234 5678 90</p>
                                <p class="text-slate-400 text-xs mt-0.5">a/n PT. Endah Trans Wisata</p>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Setelah transfer, konfirmasi via WhatsApp ke nomor kami dengan menyertakan bukti bayar.</p>
                        </div>
                    </div>
                </div>

                <div :class="fleet === 'eksklusif' ? 'border-primary-200 bg-primary-50' : 'border-secondary-200 bg-secondary-50'"
                     class="rounded-xl border p-5 flex items-center justify-between mb-6">
                    <div>
                        <span class="font-semibold text-slate-700">Total yang Harus Dibayar</span>
                        <p class="text-xs text-slate-400 mt-0.5">Belum termasuk biaya tambahan (jika ada)</p>
                    </div>
                    <span :class="fleet === 'eksklusif' ? 'text-primary-700' : 'text-secondary-700'"
                          class="text-2xl font-extrabold" x-text="rp(total)"></span>
                </div>

                <p class="text-xs text-slate-400 mb-5 leading-relaxed">
                    Dengan menekan tombol di bawah, Anda menyetujui syarat &amp; ketentuan charter Endah Trans. Nota pemesanan resmi akan dikirimkan ke email Anda.
                </p>

                <button type="submit"
                        :class="fleet === 'eksklusif' ? 'bg-gradient-to-r from-primary-600 to-secondary-600 shadow-primary-500/30' : 'bg-gradient-to-r from-secondary-500 to-secondary-700 shadow-secondary-500/30'"
                        class="w-full py-4 rounded-xl text-white font-bold shadow-lg hover:opacity-90 transition flex items-center justify-center gap-2 text-lg">
                    <i class="fas fa-check-circle"></i> Konfirmasi &amp; Buat Pemesanan
                </button>
            </div>
        </form>
    </div>
</section>

</div>{{-- /x-data --}}

@endsection