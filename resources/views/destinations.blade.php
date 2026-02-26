@extends('layouts.app')

@section('title', 'Destinasi Charter - Endah Trans')

@section('content')

{{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
<section class="relative min-h-[50vh] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920&q=80"
             alt="Destinasi" class="w-full h-full object-cover scale-105">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/70 to-primary-950/60"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-1/4 w-[400px] h-[300px] bg-secondary-600/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 w-full">
        <div class="max-w-3xl" data-aos="fade-up">
            <p class="text-primary-400 text-sm font-bold tracking-widest uppercase mb-4">Pilih Tujuan Anda</p>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-[1.05] mb-6">
                Destinasi Charter<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-secondary-400">Endah Trans</span>
            </h1>
            <p class="text-slate-400 text-base leading-relaxed max-w-xl">
                Pilih destinasi tujuan Anda dan lihat langsung estimasi harga charter armada. Klik destinasi untuk detail harga.
            </p>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     DESTINATIONS GRID dengan price panel
══════════════════════════════════════════ --}}
<section class="bg-slate-950 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-12" data-aos="fade-up">
            <div>
                <p class="text-primary-400 text-xs font-bold uppercase tracking-widest mb-2">{{ $destinations->count() }} Destinasi</p>
                <h2 class="text-3xl font-extrabold text-white">Pilih Destinasi Tujuan</h2>
                <p class="text-slate-500 text-sm mt-2">Klik destinasi → pilih kelas armada → lanjut ke form pemesanan</p>
            </div>
            <a href="{{ route('armada') }}"
               class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition">
                Lihat Kelas Armada <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        @if($destinations->isEmpty())
        <div class="text-center py-24">
            <div class="w-20 h-20 rounded-full bg-slate-800 flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-map-marker-alt text-3xl text-slate-600"></i>
            </div>
            <p class="text-slate-400 text-lg font-semibold">Destinasi belum tersedia</p>
            <p class="text-slate-600 text-sm mt-2">Silakan hubungi kami untuk informasi lebih lanjut</p>
        </div>
        @else

        {{-- x-data Alpine: selectedDest and active fleet panel --}}
        <div x-data="{ active: null }">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($destinations as $dest)
                @php
                    $priceMap = $dest->prices->pluck('price_per_day', 'fleet_type');
                    $hasPrices = $priceMap->filter(fn($p) => $p > 0)->count() > 0;
                @endphp

                <div @click="active = (active === {{ $dest->id }}) ? null : {{ $dest->id }}"
                     class="group cursor-pointer"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">

                    {{-- Card --}}
                    <div class="rounded-2xl border overflow-hidden transition-all duration-300"
                         :class="active === {{ $dest->id }}
                             ? 'border-primary-500 shadow-xl shadow-primary-500/20 bg-slate-800/80'
                             : 'border-slate-800 bg-slate-900/60 hover:border-slate-600 hover:bg-slate-800/50'">

                        {{-- Card header --}}
                        <div class="px-5 py-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition"
                                     :class="active === {{ $dest->id }} ? 'bg-primary-500' : 'bg-slate-800 group-hover:bg-slate-700'">
                                    <i class="fas fa-map-marker-alt text-sm"
                                       :class="active === {{ $dest->id }} ? 'text-white' : 'text-slate-400'"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-white text-base">{{ $dest->name }}</p>
                                    @if($dest->description)
                                    <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $dest->description }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($hasPrices)
                                <span class="text-xs text-emerald-400 font-semibold bg-emerald-500/10 px-2 py-1 rounded-full">
                                    Harga tersedia
                                </span>
                                @endif
                                <i class="fas fa-chevron-down text-slate-500 text-xs transition-transform duration-300"
                                   :class="active === {{ $dest->id }} ? 'rotate-180 text-primary-400' : ''"></i>
                            </div>
                        </div>

                        {{-- Expandable price panel --}}
                        <div x-show="active === {{ $dest->id }}"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="border-t border-slate-700">

                            <div class="px-5 pt-4 pb-2">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Estimasi Harga per Bus per Hari</p>

                                @if($hasPrices)
                                <div class="space-y-2 mb-4">
                                    @foreach($fleetTypes as $fleetKey => $fleetLabel)
                                    @php $price = $priceMap[$fleetKey] ?? 0; @endphp
                                    @if($price > 0)
                                    <div class="flex items-center justify-between py-2.5 px-3 rounded-xl bg-slate-800/80 border border-slate-700/50">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-bus text-xs text-primary-400 w-4"></i>
                                            <span class="text-sm text-slate-300 font-medium">{{ $fleetLabel }}</span>
                                        </div>
                                        <span class="text-sm font-bold text-white">
                                            Rp {{ number_format($price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @else
                                <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl px-4 py-3 mb-4">
                                    <p class="text-xs text-amber-300 flex items-center gap-2">
                                        <i class="fas fa-info-circle"></i>
                                        Harga belum diset. Tim kami akan berikan penawaran terbaik.
                                    </p>
                                </div>
                                @endif

                                <p class="text-xs text-slate-500 mb-4">Pilih kelas armada untuk lanjut ke pemesanan:</p>
                            </div>

                            {{-- Fleet buttons --}}
                            <div class="grid grid-cols-2 gap-2 px-5 pb-5">
                                @foreach($fleetTypes as $fleetKey => $fleetLabel)
                                @php $price = $priceMap[$fleetKey] ?? 0; @endphp
                                <a href="{{ route('armada.detail', $fleetKey) }}?destination={{ urlencode($dest->name) }}"
                                   @click.stop
                                   class="flex flex-col items-center gap-1 py-3 rounded-xl border text-center transition hover:-translate-y-0.5 group/btn
                                          {{ $price > 0
                                              ? 'bg-primary-600 border-primary-500 hover:bg-primary-500 text-white shadow-lg shadow-primary-500/20'
                                              : 'bg-slate-800 border-slate-700 hover:border-slate-500 text-slate-400 hover:text-white' }}">
                                    <i class="fas fa-bus text-xs"></i>
                                    <span class="text-xs font-semibold leading-tight">{{ $fleetLabel }}</span>
                                    @if($price > 0)
                                    <span class="text-[10px] opacity-80">Rp {{ number_format($price, 0, ',', '.') }}</span>
                                    @else
                                    <span class="text-[10px] opacity-50">Hubungi kami</span>
                                    @endif
                                </a>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @endif
    </div>
</section>

{{-- ══════════════════════════════════════════
     CTA
══════════════════════════════════════════ --}}
<section class="bg-slate-900 py-16 border-t border-slate-800">
    <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
        <p class="text-primary-400 text-xs font-bold uppercase tracking-widest mb-3">Destinasi Tidak Ada?</p>
        <h3 class="text-2xl md:text-3xl font-extrabold text-white mb-4">Kami Siap Antar ke Mana Pun</h3>
        <p class="text-slate-400 text-sm max-w-lg mx-auto mb-8">
            Hubungi tim kami untuk mendiskusikan rute khusus sesuai kebutuhan Anda.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/628123456789" target="_blank"
               class="inline-flex items-center gap-2.5 bg-green-500 hover:bg-green-400 text-white font-bold px-6 py-3.5 rounded-2xl transition shadow-lg">
                <i class="fab fa-whatsapp text-lg"></i> Chat WhatsApp
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2.5 bg-white/10 hover:bg-white/20 text-white font-bold px-6 py-3.5 rounded-2xl transition border border-white/20">
                <i class="fas fa-envelope"></i> Kirim Pesan
            </a>
        </div>
    </div>
</section>

@endsection
