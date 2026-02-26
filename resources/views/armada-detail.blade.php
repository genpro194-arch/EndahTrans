@extends('layouts.app')

@section('title', $detail['label'] . ' - Armada Endah Trans')

@section('content')

<div x-data="bookingForm()">

{{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     HERO â€” mini with back button
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<section class="relative min-h-[52vh] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $detail['imgs'][0] }}"
             alt="{{ $detail['label'] }}" class="w-full h-full object-cover scale-105">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/92 via-slate-950/70 to-slate-900/60"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] {{ $detail['glowColor'] }}/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-1/3 w-[400px] h-[300px] {{ $detail['glowColor2'] }}/15 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 w-full">

        {{-- Breadcrumb / back --}}
        <div class="mb-8" data-aos="fade-down">
            <a href="{{ route('armada') }}"
               class="inline-flex items-center gap-2 bg-white/10 backdrop-blur border border-white/20 text-white/70 hover:text-white hover:bg-white/20 px-4 py-2 rounded-xl text-sm font-semibold transition">
                <i class="fas fa-arrow-left text-xs"></i>
                Kembali ke Armada
            </a>
        </div>

        <div class="max-w-3xl" data-aos="fade-up">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-[1.05] mb-10">
                {{ $detail['label'] }}
                @if($detail['vip'])<span class="text-amber-400">â­</span>@endif
            </h1>

            <a href="#form-pemesanan"
               onclick="event.preventDefault();document.getElementById('form-pemesanan').scrollIntoView({behavior:'smooth'})"
               class="inline-flex items-center gap-2.5 bg-gradient-to-r {{ $detail['btnClass'] }} text-white font-bold px-8 py-4 rounded-2xl shadow-xl hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                <i class="fas fa-calendar-check"></i> Pesan Sekarang
            </a>
        </div>
    </div>
</section>

{{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     FLEET DETAIL â€” dark section
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<div class="relative overflow-hidden">

    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] {{ $detail['glowColor'] }} rounded-full blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] {{ $detail['glowColor2'] }} rounded-full blur-3xl opacity-10"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

        {{-- Section header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5 mb-14" data-aos="fade-up">
            <div>
                <p class="text-xs font-bold tracking-[0.3em] uppercase mb-2 {{ $detail['iconColor'] }}">
                    Detail Armada
                </p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white">
                    {{ $detail['label'] }}@if($detail['vip']) <span class="text-amber-400">â­</span>@endif
                </h2>
            </div>
            <a href="{{ route('armada') }}"
               class="self-start flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/15 text-white/70 hover:text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition">
                <i class="fas fa-th text-xs"></i> Pilih Kelas Lain
            </a>
        </div>

        {{-- Images + stats + facilities --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start" data-aos="fade-up">
            {{-- Images --}}
            <div class="lg:col-span-3 space-y-3">
                <div class="rounded-2xl overflow-hidden h-72">
                    <img src="{{ $detail['imgs'][0] }}" alt="{{ $detail['label'] }}"
                         class="w-full h-full object-cover hover:scale-105 transition duration-700">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-2xl overflow-hidden h-44">
                        <img src="{{ $detail['imgs'][1] }}" alt="{{ $detail['label'] }}"
                             class="w-full h-full object-cover hover:scale-105 transition duration-700">
                    </div>
                    <div class="rounded-2xl overflow-hidden h-44">
                        <img src="{{ $detail['imgs'][2] }}" alt="{{ $detail['label'] }}"
                             class="w-full h-full object-cover hover:scale-105 transition duration-700">
                    </div>
                </div>
            </div>
            {{-- Info --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="grid grid-cols-3 gap-3">
                    @foreach($detail['stats'] as [$ic, $lb, $vl])
                    <div class="{{ $detail['cardBg'] }} border {{ $detail['cardBorder'] }} rounded-2xl p-4 text-center">
                        <i class="fas {{ $ic }} {{ $detail['iconColor'] }} text-base mb-2 block"></i>
                        <p class="text-white/40 text-xs font-medium">{{ $lb }}</p>
                        <p class="text-white font-extrabold text-sm mt-0.5">{{ $vl }}</p>
                    </div>
                    @endforeach
                </div>
                <div>
                    <p class="text-white/40 text-xs font-bold uppercase tracking-widest mb-3">Fasilitas</p>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($detail['fasilitas'] as [$ic, $lb])
                        <div class="flex items-center gap-2.5 {{ $detail['cardBg'] }} hover:bg-white/10 border {{ $detail['cardBorder'] }} rounded-xl px-3 py-2.5 transition">
                            <i class="fas {{ $ic }} {{ $detail['iconColor'] }} text-xs w-4 text-center flex-shrink-0"></i>
                            <span class="text-white/80 text-sm font-medium">{{ $lb }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <a href="#form-pemesanan"
                   onclick="event.preventDefault();document.getElementById('form-pemesanan').scrollIntoView({behavior:'smooth'})"
                   class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r {{ $detail['btnClass'] }} text-white font-bold py-4 rounded-2xl hover:opacity-90 transition shadow-2xl text-base">
                    <i class="fas fa-calendar-check"></i> Pesan Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

{{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     BOOKING FORM â€” professional layout
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
<section id="form-pemesanan" class="py-20 bg-[#f1f5f9]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section heading --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 text-primary-600 font-bold text-xs tracking-widest uppercase mb-3">
                <span class="w-8 h-px bg-primary-500 inline-block"></span>
                FORM PEMESANAN CHARTER
                <span class="w-8 h-px bg-primary-500 inline-block"></span>
            </span>
            <h2 class="text-4xl font-extrabold text-slate-900">
                Pesan <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-secondary-600">{{ $detail['label'] }}</span>
            </h2>
            <p class="text-slate-500 mt-2 text-sm">Isi formulir dengan lengkap, tim kami akan menghubungi Anda dalam 1Ã—24 jam.</p>
        </div>

        {{-- Progress steps --}}
        <div class="flex items-center justify-center gap-0 mb-10" data-aos="fade-up">
            <div class="flex items-center gap-3">
                <div :class="step >= 1 ? 'bg-primary-600 text-white shadow-lg shadow-primary-200' : 'bg-white text-slate-400 border border-slate-200'"
                     class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-extrabold transition-all duration-300">1</div>
                <div :class="step >= 1 ? 'text-slate-800' : 'text-slate-400'"
                     class="text-sm font-bold transition-colors duration-300 hidden sm:block">Data Pemesan</div>
            </div>
            <div :class="step >= 2 ? 'bg-primary-500' : 'bg-slate-200'"
                 class="w-16 sm:w-24 h-0.5 mx-3 transition-all duration-500"></div>
            <div class="flex items-center gap-3">
                <div :class="step >= 2 ? 'bg-primary-600 text-white shadow-lg shadow-primary-200' : 'bg-white text-slate-400 border border-slate-200'"
                     class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-extrabold transition-all duration-300">2</div>
                <div :class="step >= 2 ? 'text-slate-800' : 'text-slate-400'"
                     class="text-sm font-bold transition-colors duration-300 hidden sm:block">Konfirmasi</div>
            </div>
        </div>

        {{-- Messages --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl text-sm text-green-700 font-semibold flex items-center gap-2 max-w-4xl mx-auto">
            <i class="fas fa-check-circle text-green-500 text-lg"></i>
            <div><p class="font-bold">Pemesanan berhasil!</p><p class="font-normal text-green-600">{{ session('success') }}</p></div>
        </div>
        @endif
        @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl max-w-4xl mx-auto">
            <p class="text-sm font-bold text-red-700 mb-2 flex items-center gap-2"><i class="fas fa-exclamation-circle"></i> Mohon perbaiki kesalahan berikut:</p>
            <ul class="text-sm text-red-600 space-y-1 list-disc list-inside">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('charter.store') }}">
            @csrf
            <input type="hidden" name="fleet_type" value="{{ $kelas }}">
            <input type="hidden" name="num_buses" :value="numBuses">
            <input type="hidden" name="duration_days" :value="durationDays">
            <input type="hidden" name="payment_method" :value="paymentMethod">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- ===== LEFT: FORM ===== --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- STEP 1 --}}
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">

                        {{-- Section: Identitas --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary-50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-primary-600 text-xs"></i>
                                </div>
                                <h3 class="font-bold text-slate-800 text-sm">Identitas Pemesan</h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fas fa-user text-xs"></i></span>
                                            <input type="text" name="customer_name" required placeholder="Nama lengkap Anda"
                                                   autocomplete="off"
                                                   x-model="customerName"
                                                   :class="errors.customerName ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-400' : 'border-slate-200 bg-slate-50 focus:ring-primary-500 focus:border-primary-500 focus:bg-white'"
                                                   class="w-full pl-10 pr-4 py-3.5 rounded-xl text-slate-900 text-sm border transition outline-none">
                                        <p x-show="errors.customerName" x-text="errors.customerName" class="field-error text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> <span x-text="errors.customerName"></span></p>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-2">Email <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fas fa-envelope text-xs"></i></span>
                                            <input type="email" name="customer_email" required placeholder="Alamat email Anda"
                                                   autocomplete="off"
                                                   x-model="customerEmail"
                                                   :class="errors.customerEmail ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-400' : 'border-slate-200 bg-slate-50 focus:ring-primary-500 focus:border-primary-500 focus:bg-white'"
                                                   class="w-full pl-10 pr-4 py-3.5 rounded-xl text-slate-900 text-sm border transition outline-none">
                                        <p x-show="errors.customerEmail" class="field-error text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> <span x-text="errors.customerEmail"></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 mb-2">Nomor WhatsApp / Telepon <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fab fa-whatsapp text-sm"></i></span>
                                        <input type="text" name="customer_phone" required placeholder="Nomor WhatsApp aktif"
                                               autocomplete="off"
                                               x-model="customerPhone"
                                               :class="errors.customerPhone ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-400' : 'border-slate-200 bg-slate-50 focus:ring-primary-500 focus:border-primary-500 focus:bg-white'"
                                               class="w-full pl-10 pr-4 py-3.5 rounded-xl text-slate-900 text-sm border transition outline-none">
                                        <p x-show="errors.customerPhone" class="field-error text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> <span x-text="errors.customerPhone"></span></p>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-1.5"><i class="fas fa-info-circle mr-1"></i> Konfirmasi pemesanan akan dikirim ke nomor ini.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Section: Detail Perjalanan --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary-50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-route text-primary-600 text-xs"></i>
                                </div>
                                <h3 class="font-bold text-slate-800 text-sm">Detail Perjalanan</h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 mb-2">Tujuan / Destinasi <span class="text-red-500">*</span></label>
                                    <div class="relative" x-on:click.outside="destOpen = false">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 z-10 pointer-events-none"><i class="fas fa-map-marker-alt text-xs"></i></span>
                                        <input type="text" name="destination" required placeholder="Cari destinasi..."
                                               x-model="destination"
                                               @focus="destOpen = true"
                                               @input="destOpen = true"
                                               autocomplete="off"
                                               :class="errors.destination ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-400' : 'border-slate-200 bg-slate-50 focus:ring-primary-500 focus:border-primary-500 focus:bg-white'"
                                               class="w-full pl-10 pr-4 py-3.5 rounded-xl text-slate-900 text-sm border transition outline-none">
                                        {{-- Dropdown --}}
                                        <div x-show="destOpen && filteredDest.length > 0"
                                             x-transition:enter="transition ease-out duration-150"
                                             x-transition:enter-start="opacity-0 -translate-y-1"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             class="absolute z-50 left-0 right-0 mt-1 bg-white rounded-xl shadow-xl border border-slate-200 max-h-52 overflow-y-auto">
                                            <template x-for="dest in filteredDest" :key="dest">
                                                <button type="button"
                                                        @click="selectDest(dest)"
                                                        class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-primary-50 hover:text-primary-700 flex items-center gap-2.5 transition"
                                                        :class="destination === dest ? 'bg-primary-50 text-primary-700 font-semibold' : ''">
                                                    <i class="fas fa-map-marker-alt text-xs text-slate-400 w-3 flex-shrink-0"></i>
                                                    <span x-text="dest"></span>
                                                </button>
                                            </template>
                                        </div>
                                        <p x-show="errors.destination" class="field-error text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> <span x-text="errors.destination"></span></p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-2">Tanggal Berangkat <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fas fa-calendar text-xs"></i></span>
                                            <input type="date" name="departure_date" required min="{{ date('Y-m-d') }}"
                                                   x-model="departureDate"
                                                   :class="errors.departureDate ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-400' : 'border-slate-200 bg-slate-50 focus:ring-primary-500 focus:border-primary-500 focus:bg-white'"
                                                   class="w-full pl-10 pr-4 py-3.5 rounded-xl text-slate-900 text-sm border transition outline-none">
                                        <p x-show="errors.departureDate" class="field-error text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> <span x-text="errors.departureDate"></span></p>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-2">Jam Berangkat <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fas fa-clock text-xs"></i></span>
                                            <input type="time" name="departure_time" required
                                                   x-model="departureTime"
                                                   :class="errors.departureTime ? 'border-red-400 bg-red-50 focus:ring-red-500 focus:border-red-400' : 'border-slate-200 bg-slate-50 focus:ring-primary-500 focus:border-primary-500 focus:bg-white'"
                                                   class="w-full pl-10 pr-4 py-3.5 rounded-xl text-slate-900 text-sm border transition outline-none">
                                        <p x-show="errors.departureTime" class="field-error text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> <span x-text="errors.departureTime"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Section: Armada & Durasi --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                <div class="w-8 h-8 bg-secondary-50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-bus text-secondary-600 text-xs"></i>
                                </div>
                                <h3 class="font-bold text-slate-800 text-sm">Armada & Durasi</h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-3">Jumlah Bus <span class="text-red-500">*</span></label>
                                        <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-xl overflow-hidden h-14">
                                            <button type="button" @click="if(numBuses>1) numBuses--"
                                                    class="w-14 h-full flex items-center justify-center text-slate-500 hover:text-primary-600 hover:bg-primary-50 transition text-lg font-bold border-r border-slate-200">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            <div class="flex-1 text-center">
                                                <span x-text="numBuses" class="text-2xl font-extrabold text-slate-900"></span>
                                                <span class="text-xs text-slate-400 block -mt-0.5">unit bus</span>
                                            </div>
                                            <button type="button" @click="if(numBuses<20) numBuses++"
                                                    class="w-14 h-full flex items-center justify-center text-slate-500 hover:text-primary-600 hover:bg-primary-50 transition text-lg font-bold border-l border-slate-200">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-3">Durasi Sewa <span class="text-red-500">*</span></label>
                                        <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-xl overflow-hidden h-14">
                                            <button type="button" @click="if(durationDays>1) durationDays--"
                                                    class="w-14 h-full flex items-center justify-center text-slate-500 hover:text-primary-600 hover:bg-primary-50 transition text-lg font-bold border-r border-slate-200">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            <div class="flex-1 text-center">
                                                <span x-text="durationDays" class="text-2xl font-extrabold text-slate-900"></span>
                                                <span class="text-xs text-slate-400 block -mt-0.5">hari</span>
                                            </div>
                                            <button type="button" @click="if(durationDays<30) durationDays++"
                                                    class="w-14 h-full flex items-center justify-center text-slate-500 hover:text-primary-600 hover:bg-primary-50 transition text-lg font-bold border-l border-slate-200">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Section: Catatan --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-sticky-note text-amber-500 text-xs"></i>
                                </div>
                                <h3 class="font-bold text-slate-800 text-sm">Catatan Tambahan <span class="font-normal text-slate-400">(opsional)</span></h3>
                            </div>
                            <div class="p-6">
                                <textarea name="special_requests" rows="3"
                                          placeholder="Permintaan khusus: dekorasi, sound system tambahan, rute spesifik, kebutuhan khusus penumpang, dsb..."
                                          class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition outline-none resize-none">{{ old('special_requests') }}</textarea>
                            </div>
                        </div>

                        {{-- CTA Step 1 --}}
                        {{-- Ringkasan error --}}
                        <div x-show="Object.keys(errors).length > 0"
                             x-transition
                             class="bg-red-50 border border-red-200 rounded-2xl p-4 flex gap-3">
                            <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 flex-shrink-0"></i>
                            <div>
                                <p class="text-sm font-bold text-red-700">Mohon lengkapi semua field yang wajib diisi:</p>
                                <ul class="text-xs text-red-600 mt-1 space-y-0.5 list-disc list-inside">
                                    <template x-for="msg in Object.values(errors)" :key="msg">
                                        <li x-text="msg"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>

                        <button type="button"
                                @click="goToStep2()"
                                class="w-full py-4 rounded-2xl text-white font-bold bg-gradient-to-r {{ $detail['btnClass'] }} hover:opacity-90 active:scale-[.98] transition shadow-lg flex items-center justify-center gap-2 text-base">
                            Lanjut ke Konfirmasi <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                    {{-- STEP 2 --}}
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <div id="step2-anchor"></div>

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-secondary-50 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-clipboard-check text-secondary-600 text-xs"></i>
                                    </div>
                                    <h3 class="font-bold text-slate-800 text-sm">Ringkasan Pesanan</h3>
                                </div>
                                <button type="button" @click="step = 1"
                                        class="flex items-center gap-1.5 text-xs text-primary-600 hover:text-primary-700 font-bold transition">
                                    <i class="fas fa-edit text-xs"></i> Ubah Data
                                </button>
                            </div>
                            <div class="divide-y divide-slate-100">
                                <div class="px-6 py-4 flex items-center justify-between">
                                    <span class="text-sm text-slate-500 flex items-center gap-2"><i class="fas fa-bus w-4 text-center text-slate-400"></i> Kelas Armada</span>
                                    <span class="font-bold text-slate-900 text-sm">{{ $detail['label'] }}@if($detail['vip']) â­@endif</span>
                                </div>
                                <div class="px-6 py-4 flex items-center justify-between">
                                    <span class="text-sm text-slate-500 flex items-center gap-2"><i class="fas fa-layer-group w-4 text-center text-slate-400"></i> Jumlah Bus</span>
                                    <span x-text="numBuses + ' unit'" class="font-bold text-slate-900 text-sm"></span>
                                </div>
                                <div class="px-6 py-4 flex items-center justify-between">
                                    <span class="text-sm text-slate-500 flex items-center gap-2"><i class="fas fa-calendar-day w-4 text-center text-slate-400"></i> Durasi</span>
                                    <span x-text="durationDays + ' hari'" class="font-bold text-slate-900 text-sm"></span>
                                </div>
                                <div class="px-6 py-4 flex items-center justify-between">
                                    <span class="text-sm text-slate-500 flex items-center gap-2"><i class="fas fa-credit-card w-4 text-center text-slate-400"></i> Pembayaran</span>
                                    <span class="font-bold text-slate-900 text-sm capitalize"
                                          x-text="{'qris':'QRIS','transfer_bca':'Transfer BCA','transfer_mandiri':'Transfer Mandiri','transfer_bni':'Transfer BNI','transfer_bri':'Transfer BRI'}[paymentMethod]"></span>
                                </div>

                                {{-- Harga dinamis --}}
                                <template x-if="priceSet">
                                    <div>
                                        <div class="px-6 py-4 flex items-center justify-between">
                                            <span class="text-sm text-slate-500 flex items-center gap-2"><i class="fas fa-tag w-4 text-center text-slate-400"></i> Harga/Bus/Hari</span>
                                            <span x-text="rp(rate)" class="font-bold text-primary-600 text-sm"></span>
                                        </div>
                                        <div class="px-6 py-4 flex items-center justify-between bg-primary-50">
                                            <span class="text-sm font-bold text-slate-700 flex items-center gap-2"><i class="fas fa-coins w-4 text-center text-primary-500"></i> Total Estimasi</span>
                                            <span x-text="rp(total)" class="font-extrabold text-primary-700 text-base"></span>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!priceSet">
                                    <div class="px-6 py-4 bg-amber-50">
                                        <p class="text-xs text-amber-700 flex items-center gap-2">
                                            <i class="fas fa-info-circle text-amber-500"></i>
                                            <span x-text="destination ? 'Harga untuk destinasi ini belum diset, tim kami akan konfirmasi.' : 'Pilih destinasi untuk melihat estimasi harga.'"></span>
                                        </p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- ═══════════════════════════════════════
                             METODE PEMBAYARAN
                        ═══════════════════════════════════════ --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mt-5">
                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary-50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-credit-card text-primary-600 text-xs"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800 text-sm">Metode Pembayaran</h3>
                                    <p class="text-xs text-slate-400">Pilih cara pembayaran DP 30%</p>
                                </div>
                            </div>
                            <div class="p-5 space-y-3">

                                {{-- QRIS --}}
                                <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200"
                                       :class="paymentMethod === 'qris' ? 'border-blue-500 bg-blue-50' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                    <input type="radio" name="_pm" value="qris" x-model="paymentMethod" class="hidden">
                                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors"
                                         :class="paymentMethod === 'qris' ? 'bg-blue-500' : 'bg-slate-100'">
                                        <i class="fas fa-qrcode text-lg" :class="paymentMethod === 'qris' ? 'text-white' : 'text-slate-500'"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-slate-800 text-sm">QRIS</p>
                                        <p class="text-xs text-slate-500 mt-0.5">GoPay · OVO · Dana · ShopeePay · m-Banking</p>
                                    </div>
                                    <div class="flex items-center gap-1 flex-shrink-0">
                                        <span class="text-xs bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded-full">Paling Mudah</span>
                                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-colors"
                                             :class="paymentMethod === 'qris' ? 'border-blue-500 bg-blue-500' : 'border-slate-300'">
                                            <i class="fas fa-check text-white text-[9px]" x-show="paymentMethod === 'qris'"></i>
                                        </div>
                                    </div>
                                </label>

                                {{-- Transfer BCA --}}
                                <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200"
                                       :class="paymentMethod === 'transfer_bca' ? 'border-blue-500 bg-blue-50' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                    <input type="radio" name="_pm" value="transfer_bca" x-model="paymentMethod" class="hidden">
                                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 font-extrabold text-sm transition-colors"
                                         :class="paymentMethod === 'transfer_bca' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-700'">BCA</div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-slate-800 text-sm">Transfer BCA</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Bank Central Asia · Rek. 1234 5678 90</p>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-colors"
                                         :class="paymentMethod === 'transfer_bca' ? 'border-blue-500 bg-blue-500' : 'border-slate-300'">
                                        <i class="fas fa-check text-white text-[9px]" x-show="paymentMethod === 'transfer_bca'"></i>
                                    </div>
                                </label>

                                {{-- Transfer Mandiri --}}
                                <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200"
                                       :class="paymentMethod === 'transfer_mandiri' ? 'border-blue-500 bg-blue-50' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                    <input type="radio" name="_pm" value="transfer_mandiri" x-model="paymentMethod" class="hidden">
                                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 font-extrabold text-[10px] transition-colors"
                                         :class="paymentMethod === 'transfer_mandiri' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-700'">MDR</div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-slate-800 text-sm">Transfer Mandiri</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Bank Mandiri · Rek. 1400-0123-4567-89</p>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-colors"
                                         :class="paymentMethod === 'transfer_mandiri' ? 'border-blue-500 bg-blue-500' : 'border-slate-300'">
                                        <i class="fas fa-check text-white text-[9px]" x-show="paymentMethod === 'transfer_mandiri'"></i>
                                    </div>
                                </label>

                                {{-- Transfer BNI --}}
                                <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200"
                                       :class="paymentMethod === 'transfer_bni' ? 'border-blue-500 bg-blue-50' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                    <input type="radio" name="_pm" value="transfer_bni" x-model="paymentMethod" class="hidden">
                                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 font-extrabold text-sm transition-colors"
                                         :class="paymentMethod === 'transfer_bni' ? 'bg-orange-500 text-white' : 'bg-orange-100 text-orange-700'">BNI</div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-slate-800 text-sm">Transfer BNI</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Bank Negara Indonesia · Rek. 0123 4567 89</p>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-colors"
                                         :class="paymentMethod === 'transfer_bni' ? 'border-blue-500 bg-blue-500' : 'border-slate-300'">
                                        <i class="fas fa-check text-white text-[9px]" x-show="paymentMethod === 'transfer_bni'"></i>
                                    </div>
                                </label>

                                {{-- Transfer BRI --}}
                                <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200"
                                       :class="paymentMethod === 'transfer_bri' ? 'border-blue-500 bg-blue-50' : 'border-slate-200 hover:border-slate-300 bg-white'">
                                    <input type="radio" name="_pm" value="transfer_bri" x-model="paymentMethod" class="hidden">
                                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 font-extrabold text-sm transition-colors"
                                         :class="paymentMethod === 'transfer_bri' ? 'bg-sky-600 text-white' : 'bg-sky-100 text-sky-700'">BRI</div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-slate-800 text-sm">Transfer BRI</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Bank Rakyat Indonesia · Rek. 0123-01-123456-78-9</p>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-colors"
                                         :class="paymentMethod === 'transfer_bri' ? 'border-blue-500 bg-blue-500' : 'border-slate-300'">
                                        <i class="fas fa-check text-white text-[9px]" x-show="paymentMethod === 'transfer_bri'"></i>
                                    </div>
                                </label>

                                {{-- Detail rekening yang dipilih --}}
                                <div class="mt-4 rounded-xl overflow-hidden border border-slate-200">

                                    {{-- QRIS detail --}}
                                    <div x-show="paymentMethod === 'qris'"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                         class="bg-gradient-to-r from-blue-600 to-indigo-600 p-5">
                                        <p class="text-white/70 text-xs font-bold uppercase tracking-widest mb-3">Scan QRIS</p>
                                        <div class="flex items-center gap-4">
                                            <div class="w-20 h-20 bg-white rounded-xl flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-qrcode text-slate-800 text-4xl"></i>
                                            </div>
                                            <div>
                                                <p class="text-white font-bold text-sm">PT. Endah Trans Wisata</p>
                                                <p class="text-white/60 text-xs mt-1">Scan QR dengan aplikasi apapun:</p>
                                                <div class="flex flex-wrap gap-1.5 mt-2">
                                                    <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full font-medium">GoPay</span>
                                                    <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full font-medium">OVO</span>
                                                    <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full font-medium">Dana</span>
                                                    <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full font-medium">ShopeePay</span>
                                                    <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full font-medium">m-Banking</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-white/40 text-xs mt-4">
                                            <i class="fas fa-info-circle mr-1"></i> QR akan dikirim via WhatsApp setelah konfirmasi pemesanan.
                                        </p>
                                    </div>

                                    {{-- BCA detail --}}
                                    <div x-show="paymentMethod === 'transfer_bca'"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                         class="bg-slate-900 p-5">
                                        <p class="text-white/50 text-xs font-bold uppercase tracking-widest mb-3">Rekening BCA</p>
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center font-extrabold text-white flex-shrink-0">BCA</div>
                                            <div>
                                                <p class="text-white/50 text-xs">No. Rekening</p>
                                                <p class="text-white font-mono text-xl font-bold tracking-widest">1234 5678 90</p>
                                                <p class="text-white/40 text-xs mt-0.5">a/n PT. Endah Trans Wisata</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Mandiri detail --}}
                                    <div x-show="paymentMethod === 'transfer_mandiri'"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                         class="bg-slate-900 p-5">
                                        <p class="text-white/50 text-xs font-bold uppercase tracking-widest mb-3">Rekening Mandiri</p>
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center font-extrabold text-white text-xs flex-shrink-0">MDR</div>
                                            <div>
                                                <p class="text-white/50 text-xs">No. Rekening</p>
                                                <p class="text-white font-mono text-xl font-bold tracking-widest">1400-0123-4567-89</p>
                                                <p class="text-white/40 text-xs mt-0.5">a/n PT. Endah Trans Wisata</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- BNI detail --}}
                                    <div x-show="paymentMethod === 'transfer_bni'"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                         class="bg-slate-900 p-5">
                                        <p class="text-white/50 text-xs font-bold uppercase tracking-widest mb-3">Rekening BNI</p>
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center font-extrabold text-white flex-shrink-0">BNI</div>
                                            <div>
                                                <p class="text-white/50 text-xs">No. Rekening</p>
                                                <p class="text-white font-mono text-xl font-bold tracking-widest">0123 4567 89</p>
                                                <p class="text-white/40 text-xs mt-0.5">a/n PT. Endah Trans Wisata</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- BRI detail --}}
                                    <div x-show="paymentMethod === 'transfer_bri'"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                         class="bg-slate-900 p-5">
                                        <p class="text-white/50 text-xs font-bold uppercase tracking-widest mb-3">Rekening BRI</p>
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-sky-600 rounded-xl flex items-center justify-center font-extrabold text-white flex-shrink-0">BRI</div>
                                            <div>
                                                <p class="text-white/50 text-xs">No. Rekening</p>
                                                <p class="text-white font-mono text-xl font-bold tracking-widest">0123-01-123456-78-9</p>
                                                <p class="text-white/40 text-xs mt-0.5">a/n PT. Endah Trans Wisata</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-slate-800 px-5 py-3">
                                        <p class="text-white/30 text-xs leading-relaxed">
                                            <i class="fas fa-info-circle mr-1 text-white/40"></i>
                                            Transfer <span class="text-white/60 font-bold">DP 30%</span> setelah konfirmasi dari tim kami. Sisa dilunasi <span class="text-white/60 font-bold">H-3</span> sebelum keberangkatan.
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mt-4 flex gap-3">
                            <i class="fas fa-shield-alt text-amber-500 mt-0.5 flex-shrink-0"></i>
                            <p class="text-xs text-amber-700 leading-relaxed">
                                Dengan mengirim formulir ini, Anda menyetujui <span class="font-bold">syarat &amp; ketentuan</span> sewa armada Endah Trans. Harga bersifat estimasi dan dapat berubah sesuai kesepakatan.
                            </p>
                        </div>

                        <button type="submit"
                                class="w-full py-4 rounded-2xl text-white font-bold bg-gradient-to-r {{ $detail['btnClass'] }} hover:opacity-90 active:scale-[.98] transition shadow-xl flex items-center justify-center gap-2 text-base mt-5">
                            <i class="fas fa-paper-plane"></i> Kirim Pemesanan
                        </button>
                    </div>

                </div>

                {{-- ===== RIGHT: SIDEBAR SUMMARY ===== --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-4">

                        {{-- Fleet card --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                            <div class="relative h-32">
                                <img src="{{ $detail['imgs'][0] }}" alt="{{ $detail['label'] }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
                                <div class="absolute bottom-3 left-4">
                                    <span class="text-white font-extrabold text-base">{{ $detail['label'] }}</span>
                                    @if($detail['vip'])<span class="text-amber-400 ml-1">â­</span>@endif
                                </div>
                            </div>
                            <div class="p-4 space-y-2.5">
                                {{-- Live: Nama pemesan --}}
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-400 flex items-center gap-1.5"><i class="fas fa-user text-xs w-3"></i> Pemesan</span>
                                    <span x-text="customerName || '—'" class="font-semibold text-slate-700 text-right max-w-[130px] truncate"></span>
                                </div>
                                {{-- Live: Destinasi --}}
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-400 flex items-center gap-1.5"><i class="fas fa-map-marker-alt text-xs w-3"></i> Tujuan</span>
                                    <span x-text="destination || '—'" class="font-semibold text-slate-700 text-right max-w-[130px] truncate"></span>
                                </div>
                                {{-- Live: Tanggal & Jam --}}
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-400 flex items-center gap-1.5"><i class="fas fa-calendar text-xs w-3"></i> Berangkat</span>
                                    <span class="font-semibold text-slate-700">
                                        <span x-text="departureDate ? formatDate(departureDate) : '—'"></span>
                                        <span x-show="departureTime" x-text="', ' + departureTime" class="text-slate-500"></span>
                                    </span>
                                </div>
                                <div class="h-px bg-slate-100"></div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-500">Jumlah bus</span>
                                    <span class="font-bold text-slate-900" x-text="numBuses + ' unit'"></span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-500">Durasi</span>
                                    <span class="font-bold text-slate-900" x-text="durationDays + ' hari'"></span>
                                </div>
                                <div class="h-px bg-slate-100"></div>

                                {{-- Harga dinamis sidbar --}}
                                <div x-show="priceLoading" class="flex items-center gap-2 text-xs text-slate-500 py-1">
                                    <svg class="animate-spin h-3 w-3 text-primary-500" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                    </svg>
                                    Memuat harga...
                                </div>
                                <template x-if="!priceLoading && priceSet">
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-slate-500">Harga/bus/hari</span>
                                            <span x-text="rp(rate)" class="font-bold text-primary-600"></span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm pt-2 border-t border-slate-100">
                                            <span class="font-bold text-slate-700">Total Estimasi</span>
                                            <span x-text="rp(total)" class="font-extrabold text-primary-700 text-base"></span>
                                        </div>
                                        <p class="text-xs text-slate-400" x-text="numBuses + ' bus × ' + durationDays + ' hari'"></p>
                                    </div>
                                </template>
                                <template x-if="!priceLoading && !priceSet">
                                    <div class="bg-amber-50 border border-amber-200 rounded-xl px-3 py-2.5 text-xs text-amber-700 flex items-start gap-2">
                                        <i class="fas fa-info-circle mt-0.5 flex-shrink-0"></i>
                                        <span x-text="destination ? 'Harga untuk destinasi ini belum diset. Tim kami akan konfirmasi.' : 'Pilih destinasi untuk melihat estimasi harga.'"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Kontak cepat --}}
                        <div class="bg-green-50 border border-green-200 rounded-2xl p-4">
                            <p class="text-xs font-bold text-green-700 uppercase tracking-widest mb-3">Butuh Bantuan?</p>
                            <a href="https://wa.me/628123456789" target="_blank"
                               class="flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-xl transition text-sm">
                                <i class="fab fa-whatsapp text-lg"></i>
                                Chat via WhatsApp
                            </a>
                            <p class="text-xs text-green-600 mt-2 text-center">Respon cepat di jam kerja (07.00â€“21.00)</p>
                        </div>

                        {{-- Fasilitas mini list --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Fasilitas Termasuk</p>
                            <div class="space-y-2">
                                @foreach(array_slice($detail['fasilitas'], 0, 6) as [$ic, $lb])
                                <div class="flex items-center gap-2.5 text-sm">
                                    <i class="fas {{ $ic }} {{ $detail['iconColor'] }} text-xs w-4 text-center flex-shrink-0"></i>
                                    <span class="text-slate-600">{{ $lb }}</span>
                                </div>
                                @endforeach
                                @if(count($detail['fasilitas']) > 6)
                                <p class="text-xs text-slate-400 pt-1">+ {{ count($detail['fasilitas']) - 6 }} fasilitas lainnya</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>{{-- /grid --}}
        </form>

    </div>
</section>

</div>{{-- /x-data --}}

@endsection

@push('scripts')
<script>
function bookingForm() {
    return {
        step: 1,
        numBuses: 1,
        durationDays: 1,
        rate: 0,                // price per bus per day (from DB, 0 = not set)
        paymentMethod: 'transfer_bca',
        priceLoading: false,
        priceSet: false,
        fleetKey: '{{ $kelas }}',
        customerName: @json(old('customer_name', '')),
        customerEmail: @json(old('customer_email', '')),
        customerPhone: @json(old('customer_phone', '')),
        destination: @json(old('destination', request('destination', ''))),
        departureDate: @json(old('departure_date', '')),
        departureTime: @json(old('departure_time', '07:00')),
        errors: {},
        destOpen: false,
        allDestinations: @json($destinations),
        get filteredDest() {
            if (!this.destination.trim()) return this.allDestinations;
            const q = this.destination.toLowerCase();
            return this.allDestinations.filter(d => d.toLowerCase().includes(q));
        },
        selectDest(name) {
            this.destination = name;
            this.destOpen = false;
            this.fetchPrice();
        },
        init() {
            // Auto-fetch price if destination is pre-filled from URL param
            if (this.destination.trim()) {
                this.$nextTick(() => this.fetchPrice());
            }
        },
        get total() { return this.rate * this.numBuses * this.durationDays; },
        rp(n) {
            if (!n || n <= 0) return '—';
            return 'Rp\u00a0' + parseInt(n).toLocaleString('id-ID');
        },
        formatDate(d) {
            if (!d) return '-';
            const [y, m, dd] = d.split('-');
            const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
            return dd + ' ' + months[parseInt(m) - 1] + ' ' + y;
        },
        fetchPrice() {
            if (!this.destination.trim()) return;
            this.priceLoading = true;
            this.priceSet = false;
            fetch(`/charter-price?destination=${encodeURIComponent(this.destination)}&fleet=${encodeURIComponent(this.fleetKey)}`)
                .then(r => r.json())
                .then(data => {
                    this.rate = data.price || 0;
                    this.priceSet = this.rate > 0;
                    this.priceLoading = false;
                })
                .catch(() => { this.priceLoading = false; });
        },
        validateStep1() {
            this.errors = {};
            if (!this.customerName.trim()) this.errors.customerName = 'Nama lengkap wajib diisi';
            if (!this.customerEmail.trim()) this.errors.customerEmail = 'Email wajib diisi';
            else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.customerEmail)) this.errors.customerEmail = 'Format email tidak valid';
            if (!this.customerPhone.trim()) this.errors.customerPhone = 'Nomor WhatsApp wajib diisi';
            else if (!/^[0-9+() -]{8,20}$/.test(this.customerPhone.trim())) this.errors.customerPhone = 'Nomor telepon tidak valid';
            if (!this.destination.trim()) this.errors.destination = 'Destinasi wajib diisi';
            if (!this.departureDate) this.errors.departureDate = 'Tanggal berangkat wajib diisi';
            if (!this.departureTime) this.errors.departureTime = 'Jam berangkat wajib diisi';
            return Object.keys(this.errors).length === 0;
        },
        goToStep2() {
            if (this.validateStep1()) {
                this.step = 2;
                this.$nextTick(() => document.getElementById('step2-anchor').scrollIntoView({ behavior: 'smooth' }));
            } else {
                this.$nextTick(() => {
                    const el = document.querySelector('.field-error');
                    if (el) el.closest('.bg-white').scrollIntoView({ behavior: 'smooth', block: 'center' });
                });
            }
        }
    };
}
</script>
@endpush
