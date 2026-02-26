@extends('layouts.app')

@section('title', 'Armada Bus - Endah Trans')

@section('content')



{{-- ═══════════════════════════════════════════
     HERO — cinematic full-width
     ═══════════════════════════════════════════ --}}
<section class="relative min-h-[62vh] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1920&q=80"
             alt="Hero Bus" class="w-full h-full object-cover scale-105">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/92 via-slate-950/70 to-primary-900/50"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-1/3 w-[400px] h-[300px] bg-secondary-600/15 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28">
        <div class="max-w-3xl" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur border border-white/15 text-white/80 px-4 py-2 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                <span class="w-1.5 h-1.5 bg-primary-400 rounded-full animate-pulse"></span>
                Charter & Armada Bus
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.05] mb-6">
                Armada<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 via-secondary-400 to-primary-300">Kelas Dunia</span>
            </h1>
            <p class="text-white/60 text-lg md:text-xl leading-relaxed max-w-xl mb-10">
                Empat kelas armada bus premium — dari Sleeper hingga Super Executive — untuk setiap kebutuhan perjalanan Anda.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#armada-cards"
                   onclick="event.preventDefault();document.getElementById('armada-cards').scrollIntoView({behavior:'smooth'})"
                   class="inline-flex items-center gap-2.5 bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-bold px-8 py-4 rounded-2xl shadow-xl shadow-primary-900/40 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                    <i class="fas fa-bus"></i> Pilih Kelas Armada
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2.5 bg-white/10 backdrop-blur border border-white/20 text-white font-bold px-8 py-4 rounded-2xl hover:bg-white/20 hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-phone"></i> Hubungi Kami
                </a>
            </div>
        </div>

        <div class="absolute bottom-0 right-4 sm:right-8">
            <div class="flex gap-8 bg-white/10 backdrop-blur-md border-t border-x border-white/15 rounded-t-2xl px-8 py-5">
                <div class="text-center">
                    <div class="text-2xl font-extrabold text-white">
                        <span class="stat-counter" data-target="42" data-suffix="+">0+</span>
                    </div>
                    <div class="text-xs text-white/50 font-medium mt-0.5">Unit Armada</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-extrabold text-white">
                        <span class="stat-counter" data-target="10" data-suffix="+">0+</span>
                    </div>
                    <div class="text-xs text-white/50 font-medium mt-0.5">Tahun Beroperasi</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-extrabold text-white">
                        <span class="stat-counter" data-target="1000" data-suffix="+">0+</span>
                    </div>
                    <div class="text-xs text-white/50 font-medium mt-0.5">Pelanggan Puas</div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
        (function() {
            function animateCounter(el) {
                const target = parseInt(el.dataset.target);
                const suffix = el.dataset.suffix || '';
                const duration = 1800;
                const frameRate = 16;
                const totalFrames = Math.round(duration / frameRate);
                let frame = 0;
                const counter = setInterval(() => {
                    frame++;
                    const progress = frame / totalFrames;
                    // easeOutExpo
                    const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    const current = Math.round(ease * target);
                    el.textContent = current.toLocaleString('id-ID') + suffix;
                    if (frame === totalFrames) {
                        clearInterval(counter);
                        el.textContent = target.toLocaleString('id-ID') + suffix;
                    }
                }, frameRate);
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            document.querySelectorAll('.stat-counter').forEach(el => observer.observe(el));
        })();
        </script>
        @endpush
    </div>
</section>

{{-- ═══════════════════════════════════════════
     FLEET CARDS — 2×2 modern magazine style
     ═══════════════════════════════════════════ --}}
<section id="armada-cards" class="py-24 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-14" data-aos="fade-up">
            <div>
                <span class="inline-flex items-center gap-2 text-primary-600 font-bold text-xs tracking-widest uppercase mb-3">
                    <span class="w-8 h-px bg-primary-500 inline-block"></span>
                    PILIH KELAS ARMADA
                    <span class="w-8 h-px bg-primary-500 inline-block"></span>
                </span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                    Temukan Bus<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-secondary-600">Yang Tepat</span>
                </h2>
            </div>
            <p class="text-slate-500 text-base max-w-sm leading-relaxed md:text-right">
                Klik kartu armada untuk melihat detail fasilitas dan langsung pesan.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">

            {{-- SLEEPER BUS --}}
            <a href="{{ route('armada.detail', 'eksklusif') }}"
               class="group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
               data-aos="fade-up" data-aos-delay="0">
                <div class="relative h-72 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=900&q=80"
                         alt="Sleeper Bus" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    <div class="absolute top-5 left-5 right-5 flex items-start justify-between">
                        <span class="bg-primary-600 text-white text-xs font-extrabold px-3 py-1.5 rounded-xl tracking-wider shadow-lg">
                            SLEEPER BUS
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-extrabold text-white mb-1.5">Sleeper Bus</h3>
                        <p class="text-white/60 text-sm leading-relaxed mb-4">Kursi bisa rebahan penuh. Ideal untuk perjalanan malam jarak jauh.</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['30 Kursi','Reclining Full','AC','WiFi','Toilet','Bantal & Selimut'] as $f)
                            <span class="bg-white/15 backdrop-blur text-white/90 text-xs font-semibold px-2.5 py-1 rounded-lg border border-white/10">{{ $f }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-white px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3 text-sm text-slate-500">
                        <span class="flex items-center gap-1.5"><i class="fas fa-users text-primary-500"></i> 30 Kursi</span>
                        <span class="w-px h-4 bg-slate-200"></span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-moon text-primary-500"></i> Perjalanan Malam</span>
                    </div>
                    <span class="flex items-center gap-1.5 text-sm font-extrabold text-primary-600 group-hover:gap-3 transition-all">
                        Pilih <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </a>

            {{-- EXECUTIVE --}}
            <a href="{{ route('armada.detail', 'reguler') }}"
               class="group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
               data-aos="fade-up" data-aos-delay="100">
                <div class="relative h-72 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=900&q=80"
                         alt="Executive Bus" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    <div class="absolute top-5 left-5 right-5 flex items-start justify-between">
                        <span class="bg-secondary-600 text-white text-xs font-extrabold px-3 py-1.5 rounded-xl tracking-wider shadow-lg">
                            EXECUTIVE
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-extrabold text-white mb-1.5">Executive</h3>
                        <p class="text-white/60 text-sm leading-relaxed mb-4">Kenyamanan bisnis dengan fasilitas premium untuk semua rute.</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['40 Kursi','Reclining','AC Full','WiFi','TV LCD','Toilet','Charger'] as $f)
                            <span class="bg-white/15 backdrop-blur text-white/90 text-xs font-semibold px-2.5 py-1 rounded-lg border border-white/10">{{ $f }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-white px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3 text-sm text-slate-500">
                        <span class="flex items-center gap-1.5"><i class="fas fa-users text-secondary-500"></i> 40 Kursi</span>
                        <span class="w-px h-4 bg-slate-200"></span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-route text-secondary-500"></i> Semua Rute</span>
                    </div>
                    <span class="flex items-center gap-1.5 text-sm font-extrabold text-secondary-600 group-hover:gap-3 transition-all">
                        Pilih <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </a>

            {{-- EXECUTIVE BIG TOP --}}
            <a href="{{ route('armada.detail', 'bigtop') }}"
               class="group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
               data-aos="fade-up" data-aos-delay="150">
                <div class="relative h-72 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=900&q=80"
                         alt="Executive Big Top" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    <div class="absolute top-5 left-5 right-5 flex items-start justify-between">
                        <span class="bg-secondary-700 text-white text-xs font-extrabold px-3 py-1.5 rounded-xl tracking-wider shadow-lg">
                            EXECUTIVE BIG TOP
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-extrabold text-white mb-1.5">Executive Big Top</h3>
                        <p class="text-white/60 text-sm leading-relaxed mb-4">Ruang ekstra luas, jendela panorama, pemandangan terbaik.</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['45 Kursi','Panorama Window','AC','WiFi','TV','Toilet','Charger'] as $f)
                            <span class="bg-white/15 backdrop-blur text-white/90 text-xs font-semibold px-2.5 py-1 rounded-lg border border-white/10">{{ $f }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-white px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3 text-sm text-slate-500">
                        <span class="flex items-center gap-1.5"><i class="fas fa-users text-secondary-500"></i> 45 Kursi</span>
                        <span class="w-px h-4 bg-slate-200"></span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-binoculars text-secondary-500"></i> Panorama</span>
                    </div>
                    <span class="flex items-center gap-1.5 text-sm font-extrabold text-primary-600 group-hover:gap-3 transition-all">
                        Pilih <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </a>

            {{-- SUPER EXECUTIVE --}}
            <a href="{{ route('armada.detail', 'superexec') }}"
               class="group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
               data-aos="fade-up" data-aos-delay="200">
                <div class="relative h-72 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=900&q=80"
                         alt="Super Executive" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    <div class="absolute top-5 left-5 right-5 flex items-start justify-between">
                        <div class="flex items-center gap-2">
                            <span class="bg-gradient-to-r from-amber-500 to-orange-500 text-white text-xs font-extrabold px-3 py-1.5 rounded-xl tracking-wider shadow-lg">
                                SUPER EXECUTIVE
                            </span>
                            <span class="bg-white/20 backdrop-blur text-white text-xs font-bold px-2.5 py-1.5 rounded-xl border border-white/20">⭐ VIP</span>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-extrabold text-white mb-1.5">Super Executive ⭐</h3>
                        <p class="text-white/60 text-sm leading-relaxed mb-4">Fasilitas VIP paling lengkap untuk perjalanan tak terlupakan.</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['32 Kursi VIP','Sleeper Full','AC VIP','WiFi','TV 42"','Toilet VIP','Snack & Drink'] as $f)
                            <span class="bg-amber-500/30 backdrop-blur text-amber-100 text-xs font-semibold px-2.5 py-1 rounded-lg border border-amber-400/30">{{ $f }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-white px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3 text-sm text-slate-500">
                        <span class="flex items-center gap-1.5"><i class="fas fa-users text-amber-500"></i> 32 Kursi VIP</span>
                        <span class="w-px h-4 bg-slate-200"></span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-star text-amber-500"></i> Kelas Tertinggi</span>
                    </div>
                    <span class="flex items-center gap-1.5 text-sm font-extrabold text-amber-600 group-hover:gap-3 transition-all">
                        Pilih <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </a>

        </div>
    </div>
</section>
@endsection
