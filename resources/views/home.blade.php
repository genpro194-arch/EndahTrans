@extends('layouts.app')

@section('title', 'Endah Trans - Armada Bus Wisata Terpercaya Jepara')

@section('content')

{{-- ====================================================
     HERO SECTION - Full Screen Slider
     ==================================================== --}}
<section class="relative min-h-screen flex items-center overflow-hidden"
         x-data="{
             activeSlide: 0,
             slides: [
                 { img: 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1920&q=80', tag: 'Armada Terbaik', title: 'Perjalanan Nyaman\nBersama Endah Trans', sub: 'Armada bus modern dengan fasilitas lengkap untuk semua kebutuhan wisata Anda' },
                 { img: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920&q=80', tag: 'Destinasi Impian', title: 'Jelajahi Keindahan\nIndonesia', sub: 'Ratusan destinasi wisata tersedia dengan panduan perjalanan profesional kami' },
                 { img: 'https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=1920&q=80', tag: 'Layanan Premium', title: 'Wisata Aman\n& Terpercaya', sub: 'Lebih dari 10 tahun melayani ribuan pelanggan puas di seluruh Indonesia' }
             ],
             init() { setInterval(() => { this.activeSlide = (this.activeSlide + 1) % this.slides.length }, 5000) }
         }">

    {{-- Slides --}}
    <template x-for="(slide, i) in slides" :key="i">
        <div class="absolute inset-0 transition-opacity duration-1000"
             :class="activeSlide === i ? 'opacity-100' : 'opacity-0'">
            <img :src="slide.img" alt="slide" class="w-full h-full object-cover scale-105">
        </div>
    </template>

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-primary-900/85 via-primary-800/70 to-secondary-900/60"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 70% 50%, rgba(219,39,119,0.15) 0%, transparent 60%)"></div>

    {{-- Floating Shapes --}}
    <div class="absolute top-20 right-20 w-64 h-64 rounded-full bg-white/5 blur-3xl animate-pulse-slow hidden lg:block"></div>
    <div class="absolute bottom-20 left-20 w-96 h-96 rounded-full bg-secondary-500/10 blur-3xl animate-pulse-slow hidden lg:block" style="animation-delay:2s"></div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Left: Text --}}
            <div>
                <template x-for="(slide, i) in slides" :key="'t'+i">
                    <div x-show="activeSlide === i" x-transition:enter="transition duration-700 ease-out" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                        <span class="inline-flex items-center bg-white/15 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold mb-6 border border-white/20">
                            <span class="w-2 h-2 bg-secondary-400 rounded-full animate-pulse mr-2"></span>
                            <span x-text="slide.tag"></span>
                        </span>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 whitespace-pre-line" x-text="slide.title"></h1>
                        <p class="text-lg md:text-xl text-white/85 leading-relaxed mb-8 max-w-xl" x-text="slide.sub"></p>
                    </div>
                </template>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('contact') }}" class="group inline-flex items-center justify-center btn-gradient text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-primary-500/40 hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-phone mr-3 group-hover:rotate-12 transition-transform"></i> Hubungi Kami
                    </a>
                    <a href="{{ route('armada') }}" class="group inline-flex items-center justify-center bg-white/15 backdrop-blur-sm text-white border border-white/30 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/25 transition-all duration-300 hover:-translate-y-1">
                        <i class="fas fa-bus mr-3"></i> Lihat Armada
                    </a>
                </div>

                {{-- Trust Badges --}}
                <div class="mt-10 flex flex-wrap gap-6">
                    <div class="flex items-center gap-2 text-white/80">
                        <div class="flex -space-x-2">
                            @for($i=1;$i<=4;$i++) <img src="https://i.pravatar.cc/32?img={{ $i }}" class="w-8 h-8 rounded-full border-2 border-white" alt=""> @endfor
                        </div>
                        <span class="text-sm font-medium">10K+ Travelers</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80">
                        <div class="flex gap-0.5">@for($i=0;$i<5;$i++)<i class="fas fa-star text-secondary-300 text-sm"></i>@endfor</div>
                        <span class="text-sm font-medium">Rating 4.9</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80">
                        <i class="fas fa-shield-alt text-secondary-400"></i>
                        <span class="text-sm font-medium">Asuransi Penumpang</span>
                    </div>
                </div>
            </div>

            {{-- Right: Quick Contact Card --}}
            <div class="hidden lg:block" data-aos="fade-left">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 shadow-2xl">
                    <h3 class="text-white font-bold text-xl mb-6 flex items-center gap-2">
                        <i class="fas fa-comments text-secondary-400"></i> Hubungi Kami Sekarang
                    </h3>
                    <div class="space-y-4">
                        <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Trans" target="_blank"
                           class="flex items-center gap-4 bg-green-500/90 hover:bg-green-600 text-white p-4 rounded-2xl font-semibold transition hover:-translate-y-0.5 shadow-lg">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fab fa-whatsapp text-2xl"></i>
                            </div>
                            <div>
                                <div class="font-bold">WhatsApp</div>
                                <div class="text-sm text-white/80">+62 812-3456-7890</div>
                            </div>
                            <i class="fas fa-arrow-right ml-auto"></i>
                        </a>
                        <a href="tel:+6281234567890"
                           class="flex items-center gap-4 bg-white/15 hover:bg-white/25 text-white p-4 rounded-2xl font-semibold transition hover:-translate-y-0.5 border border-white/20">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-phone text-xl"></i>
                            </div>
                            <div>
                                <div class="font-bold">Telepon</div>
                                <div class="text-sm text-white/80">Jam 08.00 - 17.00 WIB</div>
                            </div>
                        </a>
                        <a href="{{ route('contact') }}"
                           class="flex items-center gap-4 bg-white/15 hover:bg-white/25 text-white p-4 rounded-2xl font-semibold transition hover:-translate-y-0.5 border border-white/20">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div>
                                <div class="font-bold">Email</div>
                                <div class="text-sm text-white/80">info@endahtrans.com</div>
                            </div>
                        </a>
                    </div>
                    <div class="mt-6 pt-6 border-t border-white/20 flex items-center justify-between">
                        <div class="text-white/70 text-sm"><i class="fas fa-clock mr-1 text-secondary-400"></i> Sen–Sab: 08:00 – 17:00</div>
                        <div class="text-white/70 text-sm"><i class="fas fa-map-marker-alt mr-1 text-secondary-400"></i> Jepara, Jateng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slide Dots --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-20">
        <template x-for="(s,i) in slides" :key="'d'+i">
            <button @click="activeSlide=i"
                    :class="activeSlide===i ? 'w-8 bg-white' : 'w-3 bg-white/40'"
                    class="h-3 rounded-full transition-all duration-300"></button>
        </template>
    </div>
</section>


{{-- ====================================================
     QUICK FEATURES BAR
     ==================================================== --}}
<section class="relative z-20 -mt-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                ['icon'=>'fas fa-phone-alt','color'=>'from-primary-500 to-primary-600','title'=>'Pesan Sekarang','desc'=>'Reservasi mudah & cepat'],
                ['icon'=>'fas fa-info-circle','color'=>'from-secondary-500 to-secondary-600','title'=>'Informasi Lengkap','desc'=>'Detail armada & fasilitas'],
                ['icon'=>'fas fa-magic','color'=>'from-primary-600 to-primary-700','title'=>'Praktis & Mudah','desc'=>'Cukup hubungi kami'],
                ['icon'=>'fas fa-headset','color'=>'from-secondary-600 to-secondary-700','title'=>'Support 24/7','desc'=>'Siap bantu kapan saja'],
            ] as $f)
            <div class="bg-white rounded-2xl shadow-xl p-5 flex items-center gap-4 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up">
                <div class="w-12 h-12 bg-gradient-to-br {{ $f['color'] }} rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                    <i class="{{ $f['icon'] }} text-white text-xl"></i>
                </div>
                <div>
                    <div class="font-bold text-gray-900 text-sm">{{ $f['title'] }}</div>
                    <div class="text-xs text-gray-500">{{ $f['desc'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ====================================================
     STATS COUNTER
     ==================================================== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach([
                ['icon'=>'fas fa-bus','from'=>'primary','val'=>$stats['packages'],'label'=>'Unit Armada','suffix'=>'+'],
                ['icon'=>'fas fa-map-marked-alt','from'=>'secondary','val'=>$stats['destinations'],'label'=>'Destinasi','suffix'=>'+'],
                ['icon'=>'fas fa-smile-beam','from'=>'primary','val'=>max($stats['customers'],1000),'label'=>'Penumpang Puas','suffix'=>'+'],
                ['icon'=>'fas fa-calendar-check','from'=>'secondary','val'=>10,'label'=>'Tahun Beroperasi','suffix'=>'+'],
            ] as $s)
            <div class="text-center" data-aos="fade-up">
                <div class="w-20 h-20 bg-gradient-to-br from-{{ $s['from'] }}-500 to-{{ $s['from'] }}-700 rounded-3xl flex items-center justify-center mx-auto mb-5 shadow-xl shadow-{{ $s['from'] }}-500/30 transform hover:rotate-6 transition-transform">
                    <i class="{{ $s['icon'] }} text-white text-3xl"></i>
                </div>
                <div class="text-5xl font-extrabold gradient-text mb-2 counter" data-target="{{ $s['val'] }}">0</div>
                <div class="text-gray-600 font-semibold text-base">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ====================================================
     ABOUT US
     ==================================================== --}}
<section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-secondary-500/5 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Image Collage --}}
            <div class="relative" data-aos="fade-right">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="rounded-3xl overflow-hidden shadow-xl h-52">
                            <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=600&q=80" alt="Bus" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="rounded-3xl overflow-hidden shadow-xl h-36">
                            <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=600&q=80" alt="Journey" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                    <div class="space-y-4 mt-8">
                        <div class="rounded-3xl overflow-hidden shadow-xl h-36">
                            <img src="https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=600&q=80" alt="Trip" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="rounded-3xl overflow-hidden shadow-xl h-52">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80" alt="Destination" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>
                {{-- Floating Badge --}}
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-gradient-to-br from-primary-600 to-secondary-600 text-white rounded-3xl p-5 shadow-2xl text-center z-10 border-4 border-white">
                    <div class="text-4xl font-extrabold">10+</div>
                    <div class="text-xs font-semibold mt-1">Tahun<br>Pengalaman</div>
                </div>
            </div>

            {{-- Text --}}
            <div data-aos="fade-left">
                <span class="inline-block bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                    <i class="fas fa-building mr-1"></i> TENTANG KAMI
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-5 leading-tight">
                    Kenali <span class="gradient-text">Endah Trans</span><br>Lebih Dekat
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-5">
                    <strong class="text-gray-800">PO. Endah Trans</strong> adalah perusahaan transportasi bus wisata yang telah berdiri sejak 2014. Bermarkas di <strong class="text-gray-800">Jepara, Jawa Tengah</strong>, kami melayani perjalanan wisata ke berbagai destinasi di seluruh Indonesia.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Dengan armada bus modern, driver berpengalaman dan bersertifikat, serta layanan pelanggan yang ramah, kami berkomitmen menjadikan setiap perjalanan Anda sebagai pengalaman yang berkesan dan tak terlupakan.
                </p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach([
                        ['icon'=>'fas fa-bus','color'=>'primary','title'=>'Armada Modern','sub'=>'Bus AC terbaru'],
                        ['icon'=>'fas fa-certificate','color'=>'secondary','title'=>'Driver Tersertifikat','sub'=>'Profesional & ramah'],
                        ['icon'=>'fas fa-shield-alt','color'=>'primary','title'=>'Asuransi Penuh','sub'=>'Terlindungi'],
                        ['icon'=>'fas fa-headset','color'=>'secondary','title'=>'Support 24/7','sub'=>'Selalu siap'],
                    ] as $f)
                    <div class="flex items-center gap-3 p-4 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-10 h-10 bg-{{ $f['color'] }}-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="{{ $f['icon'] }} text-{{ $f['color'] }}-600"></i>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">{{ $f['title'] }}</div>
                            <div class="text-xs text-gray-500">{{ $f['sub'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('about') }}" class="inline-flex items-center btn-gradient text-white px-8 py-4 rounded-2xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    Selengkapnya <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ====================================================
     MENGAPA MEMILIH KAMI
     ==================================================== --}}
<section class="py-20 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block bg-secondary-100 text-secondary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                <i class="fas fa-award mr-1"></i> KENAPA KAMI
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Mengapa Memilih <span class="gradient-text">Endah Trans?</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Kami hadir dengan standar layanan terbaik untuk setiap perjalanan wisata Anda</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon'=>'fas fa-shield-alt','color'=>'primary','title'=>'Aman & Terpercaya','desc'=>'Armada terawat, driver bersertifikat dengan rekam jejak keselamatan terjamin.'],
                ['icon'=>'fas fa-tags','color'=>'secondary','title'=>'Harga Bersaing','desc'=>'Tarif kompetitif tanpa mengurangi kualitas layanan dan kenyamanan.'],
                ['icon'=>'fas fa-headset','color'=>'primary','title'=>'Layanan 24/7','desc'=>'Tim customer service kami siap membantu kapanpun Anda membutuhkan.'],
                ['icon'=>'fas fa-medal','color'=>'secondary','title'=>'Pengalaman 10+ Tahun','desc'=>'Telah melayani ribuan perjalanan wisata dengan reputasi yang terjaga.'],
            ] as $i => $w)
            <div class="group relative bg-gradient-to-br from-{{ $w['color'] }}-50 via-white to-{{ $w['color'] }}-50 rounded-3xl p-8 border border-{{ $w['color'] }}-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $i*100 }}">
                <div class="w-20 h-20 bg-gradient-to-br from-{{ $w['color'] }}-500 to-{{ $w['color'] }}-700 rounded-2xl flex items-center justify-center mb-6 shadow-xl shadow-{{ $w['color'] }}-500/30 transform group-hover:rotate-6 transition-transform duration-500">
                    <i class="{{ $w['icon'] }} text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-3">{{ $w['title'] }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ $w['desc'] }}</p>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-{{ $w['color'] }}-500 to-{{ $w['color'] }}-600 rounded-b-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ====================================================
     FASILITAS ARMADA
     ==================================================== --}}
<section class="py-20 relative overflow-hidden">
    {{-- BG --}}
    <div class="absolute inset-0 bg-gradient-to-br from-primary-900 via-primary-800 to-secondary-900"></div>
    <div class="absolute inset-0" style="background-image:url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1920'); background-size:cover; background-position:center; opacity:0.08;"></div>
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 30% 50%, rgba(239,68,68,0.15) 0%, transparent 60%)"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block bg-white/15 backdrop-blur text-white px-4 py-2 rounded-full text-sm font-bold mb-4 border border-white/20">
                <i class="fas fa-star mr-1"></i> FASILITAS ARMADA
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4">
                Fasilitas <span class="text-secondary-300">Lengkap</span> di Setiap Bus
            </h2>
            <p class="text-white/75 text-lg max-w-2xl mx-auto">Kenyamanan maksimal dengan fasilitas modern tersedia di seluruh armada kami</p>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4 md:gap-6">
            @foreach([
                ['icon'=>'fas fa-snowflake','label'=>'AC Full'],
                ['icon'=>'fas fa-wifi','label'=>'WiFi'],
                ['icon'=>'fas fa-tv','label'=>'LCD TV'],
                ['icon'=>'fas fa-bolt','label'=>'USB Charger'],
                ['icon'=>'fas fa-couch','label'=>'Reclining Seat'],
                ['icon'=>'fas fa-toilet','label'=>'Toilet'],
                ['icon'=>'fas fa-utensils','label'=>'Snack'],
                ['icon'=>'fas fa-music','label'=>'Audio System'],
                ['icon'=>'fas fa-tint','label'=>'Air Minum'],
                ['icon'=>'fas fa-camera','label'=>'CCTV'],
                ['icon'=>'fas fa-first-aid','label'=>'P3K'],
                ['icon'=>'fas fa-fire-extinguisher','label'=>'APAR'],
            ] as $i => $f)
            <div class="group text-center" data-aos="zoom-in" data-aos-delay="{{ ($i % 6) * 50 }}">
                <div class="w-full aspect-square bg-white/10 backdrop-blur-sm rounded-2xl flex flex-col items-center justify-center p-3 border border-white/15 hover:bg-white/20 hover:border-white/30 hover:-translate-y-2 transition-all duration-300 cursor-default shadow-lg">
                    <i class="{{ $f['icon'] }} text-2xl sm:text-3xl text-white mb-2 group-hover:text-secondary-300 transition-colors"></i>
                    <span class="text-white/85 text-xs font-semibold leading-tight text-center">{{ $f['label'] }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('armada') }}" class="inline-flex items-center bg-white text-primary-700 font-bold px-8 py-4 rounded-2xl hover:bg-gray-100 transition hover:-translate-y-1 shadow-xl hover:shadow-2xl">
                <i class="fas fa-bus mr-2"></i> Lihat Selengkapnya Armada
            </a>
        </div>
    </div>
</section>


{{-- ====================================================
     ARTIKEL BERTAB (inspired by New Shantika)
     ==================================================== --}}
<section class="py-20 bg-gray-50"
         x-data="{ tab: 'semua' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10" data-aos="fade-up">
            <span class="inline-block bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                <i class="fas fa-newspaper mr-1"></i> ARTIKEL
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Artikel & <span class="gradient-text">Tips Wisata</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Informasi terbaru, tips perjalanan, dan panduan wisata untuk Anda</p>
        </div>

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap justify-center gap-3 mb-10" data-aos="fade-up">
            @foreach([['key'=>'semua','label'=>'Semua'],['key'=>'tips','label'=>'Tips'],['key'=>'armada','label'=>'Armada'],['key'=>'rute','label'=>'Rute']] as $t)
            <button @click="tab='{{ $t['key'] }}'"
                    :class="tab==='{{ $t['key'] }}' ? 'btn-gradient text-white shadow-lg shadow-primary-500/30' : 'bg-white text-gray-600 border border-gray-200 hover:border-primary-300 hover:text-primary-600'"
                    class="px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 text-sm">
                {{ $t['label'] }}
            </button>
            @endforeach
        </div>

        {{-- Articles Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $articles = [
                ['tab'=>'tips','img'=>'https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=600&q=80','cat'=>'Tips','date'=>'20 Feb 2026','title'=>'10 Tips Wisata Rombongan Agar Perjalanan Lancar','exc'=>'Perjalanan wisata bersama rombongan bisa jadi tantangan. Berikut tips agar perjalanan berjalan mulus.'],
                ['tab'=>'armada','img'=>'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&q=80','cat'=>'Armada','date'=>'15 Feb 2026','title'=>'Keunggulan Big Bus untuk Wisata Rombongan Besar','exc'=>'Big bus hadir dengan kapasitas 45 kursi dan fasilitas premium untuk perjalanan jauh yang nyaman.'],
                ['tab'=>'rute','img'=>'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=600&q=80','cat'=>'Rute','date'=>'10 Feb 2026','title'=>'Destinasi Wisata Populer dari Jepara yang Wajib Dikunjungi','exc'=>'Jawa Tengah menyimpan banyak destinasi wisata indah yang bisa dijangkau dari Jepara dengan bus kami.'],
                ['tab'=>'tips','img'=>'https://images.unsplash.com/photo-1495562569060-2eec283d3391?w=600&q=80','cat'=>'Tips','date'=>'5 Feb 2026','title'=>'Tips Hemat Wisata Grup Tanpa Mengorbankan Kenyamanan','exc'=>'Wisata grup tak harus mahal. Dengan perencanaan tepat, Anda bisa menikmati perjalanan berkualitas.'],
                ['tab'=>'armada','img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80','cat'=>'Armada','date'=>'1 Feb 2026','title'=>'Medium Bus: Pilihan Tepat untuk Rombongan Menengah','exc'=>'Medium bus 35 kursi lebih lincah dan fleksibel untuk destinasi yang tak bisa dijangkau big bus.'],
                ['tab'=>'rute','img'=>'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&q=80','cat'=>'Rute','date'=>'25 Jan 2026','title'=>'Panduan Memilih Rute Wisata yang Tepat untuk Keluarga','exc'=>'Pilih rute wisata yang sesuai usia dan kondisi anggota keluarga untuk perjalanan yang menyenangkan.'],
            ];
            @endphp

            @foreach($articles as $i => $a)
            <div x-show="tab==='semua' || tab==='{{ $a['tab'] }}'"
                 x-transition:enter="transition duration-300 ease-out"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="group bg-white rounded-3xl shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 border border-gray-100"
                 data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 100 }}">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ $a['img'] }}" alt="{{ $a['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    <span class="absolute top-4 left-4 bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $a['cat'] }}</span>
                </div>
                <div class="p-6">
                    <p class="text-xs text-gray-400 mb-2"><i class="fas fa-calendar mr-1"></i> {{ $a['date'] }}</p>
                    <h3 class="font-extrabold text-gray-900 text-lg mb-3 leading-snug line-clamp-2 group-hover:text-primary-600 transition-colors">{{ $a['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-4">{{ $a['exc'] }}</p>
                    <a href="{{ route('artikel') }}" class="inline-flex items-center text-primary-600 font-bold text-sm hover:gap-3 gap-2 transition-all">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('artikel') }}" class="inline-flex items-center px-8 py-4 border-2 border-primary-500 text-primary-600 font-bold rounded-2xl hover:bg-primary-50 transition hover:-translate-y-1">
                <i class="fas fa-book-open mr-2"></i> Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>


{{-- ====================================================
     TIPS PERJALANAN (Visual Cards)
     ==================================================== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block bg-secondary-100 text-secondary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                <i class="fas fa-lightbulb mr-1"></i> TIPS & PANDUAN
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Tips <span class="gradient-text">Perjalanan</span> Terbaik
            </h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['ico'=>'fas fa-calendar-check','c'=>'from-primary-500 to-primary-700','t'=>'Pesan Jauh Hari','d'=>'Reservasi minimal 1-2 minggu sebelum keberangkatan untuk ketersediaan armada & harga terbaik.'],
                ['ico'=>'fas fa-map-marked-alt','c'=>'from-secondary-500 to-secondary-700','t'=>'Riset Destinasi','d'=>'Pelajari cuaca, tempat menarik, budaya lokal, dan waktu terbaik sebelum berangkat.'],
                ['ico'=>'fas fa-suitcase-rolling','c'=>'from-primary-500 to-primary-700','t'=>'Bawa Secukupnya','d'=>'Bawa barang sesuai kebutuhan. Perhatikan kapasitas bagasi dan sertakan dokumen penting.'],
                ['ico'=>'fas fa-users','c'=>'from-secondary-500 to-secondary-700','t'=>'Koordinasi Tim','d'=>'Sinkronkan jadwal dan rencana dengan semua anggota rombongan agar perjalanan tepat waktu.'],
                ['ico'=>'fas fa-first-aid','c'=>'from-primary-600 to-primary-800','t'=>'Siapkan P3K','d'=>'Bawa obat-obatan pribadi dan P3K. Konsultasikan kesehatan sebelum perjalanan jauh.'],
                ['ico'=>'fas fa-camera','c'=>'from-secondary-600 to-secondary-800','t'=>'Abadikan Momen','d'=>'Isi daya kamera dan ponsel. Siapkan memori cukup untuk semua momen berharga perjalanan.'],
            ] as $i => $tip)
            <div class="group flex gap-5 p-6 rounded-3xl bg-gradient-to-br from-gray-50 to-white border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ ($i%3)*100 }}">
                <div class="w-14 h-14 bg-gradient-to-br {{ $tip['c'] }} rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                    <i class="{{ $tip['ico'] }} text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-gray-900 text-lg mb-2">{{ $tip['t'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $tip['d'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ====================================================
     TESTIMONIAL
     ==================================================== --}}
@if($testimonials->count() > 0)
<section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, #ef4444 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                <i class="fas fa-heart mr-1"></i> ULASAN PELANGGAN
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Apa Kata <span class="gradient-text">Sahabat Endah Trans?</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Berikut adalah penilaian dari pelanggan setia kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $i => $t)
            <div class="group bg-white rounded-3xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden" data-aos="fade-up" data-aos-delay="{{ ($i%3)*100 }}">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-primary-500/10 to-secondary-500/10 rounded-full -translate-y-8 translate-x-8"></div>
                <div class="flex items-center mb-5 gap-1">
                    @for($s=1;$s<=5;$s++)
                    <i class="fas fa-star {{ $s<=$t->rating ? 'text-secondary-400' : 'text-gray-200' }} text-lg"></i>
                    @endfor
                    <span class="ml-2 text-sm text-gray-400 font-medium">({{ $t->rating }}.0)</span>
                </div>
                <i class="fas fa-quote-left text-5xl text-primary-100 mb-3 block"></i>
                <p class="text-gray-600 leading-relaxed italic mb-6">"{{ $t->content }}"</p>
                <div class="flex items-center gap-4 pt-5 border-t border-gray-100">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($t->name) }}&background=ef4444&color=fff&bold=true&size=56" alt="{{ $t->name }}" class="w-14 h-14 rounded-2xl shadow-md">
                    <div>
                        <div class="font-extrabold text-gray-900">{{ $t->name }}</div>
                        @if($t->location) <div class="text-xs text-gray-500 flex items-center gap-1"><i class="fas fa-map-marker-alt text-primary-500"></i> {{ $t->location }}</div> @endif
                    </div>
                    <div class="ml-auto w-9 h-9 bg-primary-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-primary-600 text-sm"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-14" data-aos="fade-up">
            <p class="text-gray-500 mb-4 text-lg">Pernah berwisata bersama kami?</p>
            <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Trans,%20saya%20ingin%20memberikan%20ulasan" target="_blank"
               class="inline-flex items-center btn-gradient text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all text-lg">
                <i class="fas fa-star mr-3 text-secondary-200"></i> Bagikan Ulasan Anda
            </a>
        </div>
    </div>
</section>
@endif


{{-- ====================================================
     TIM PROFESIONAL
     ==================================================== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block bg-secondary-100 text-secondary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                <i class="fas fa-users mr-1"></i> TIM PROFESIONAL
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Dikelola oleh Tim <span class="gradient-text">Berpengalaman</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Orang-orang terbaik di balik layanan prima Endah Trans</p>
        </div>
        @php $teams = \App\Models\Team::all(); @endphp
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8">
            @if($teams->count() > 0)
                @foreach($teams as $i => $tm)
                <div class="group text-center" data-aos="fade-up" data-aos-delay="{{ ($i%4)*100 }}">
                    <div class="relative w-36 h-36 mx-auto mb-4 overflow-hidden rounded-3xl shadow-xl">
                        <img src="{{ $tm->image ? asset('storage/'.$tm->image) : 'https://ui-avatars.com/api/?name='.urlencode($tm->name).'&background=ef4444&color=fff&bold=true&size=144' }}" alt="{{ $tm->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/70 via-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-3">
                            <div class="flex gap-2">
                                @if($tm->instagram_url)<a href="{{ $tm->instagram_url }}" target="_blank" class="w-8 h-8 bg-secondary-600 rounded-full flex items-center justify-center"><i class="fab fa-instagram text-white text-xs"></i></a>@endif
                                @if($tm->linkedin_url)<a href="{{ $tm->linkedin_url }}" target="_blank" class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center"><i class="fab fa-linkedin text-white text-xs"></i></a>@endif
                            </div>
                        </div>
                    </div>
                    <h3 class="font-extrabold text-gray-900 mb-0.5">{{ $tm->name }}</h3>
                    <p class="text-sm text-primary-600 font-semibold">{{ $tm->role }}</p>
                </div>
                @endforeach
            @else
                @foreach([['Budi Santoso','Direktur Utama'],['Siti Rahayu','Manajer Operasional'],['Ahmad Fauzi','Kepala Driver'],['Dewi Kusuma','Customer Service']] as $i => $m)
                <div class="group text-center" data-aos="fade-up" data-aos-delay="{{ $i*100 }}">
                    <div class="relative w-36 h-36 mx-auto mb-4 overflow-hidden rounded-3xl shadow-xl">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($m[0]) }}&background=ef4444&color=fff&bold=true&size=144" alt="{{ $m[0] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-extrabold text-gray-900 mb-0.5">{{ $m[0] }}</h3>
                    <p class="text-sm text-primary-600 font-semibold">{{ $m[1] }}</p>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


{{-- ====================================================
     KEANGGOTAAN / JADI AGEN
     ==================================================== --}}
<section class="py-20 bg-gradient-to-br from-gray-900 via-primary-900 to-gray-900 relative overflow-hidden">
    <div class="absolute inset-0" style="background-image:url('https://images.unsplash.com/photo-1560264280-88b68371db39?w=1920'); background-size:cover; opacity:0.07;"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-secondary-500/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <span class="inline-block bg-white/10 text-white px-4 py-2 rounded-full text-sm font-bold mb-5 border border-white/20">
                    <i class="fas fa-handshake mr-1"></i> BERGABUNG BERSAMA KAMI
                </span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-5 leading-tight">
                    Jadilah Bagian<br>dari <span class="text-secondary-400">Keluarga Endah Trans</span>
                </h2>
                <p class="text-white/75 text-lg leading-relaxed mb-8">
                    Bergabung sebagai agen resmi kami dan dapatkan komisi menarik, pelatihan gratis, serta dukungan penuh dari tim profesional kami.
                </p>
                <div class="space-y-4 mb-8">
                    @foreach(['Komisi hingga 10% per transaksi','Pelatihan produk & sistem gratis','Dukungan tim 24/7','Materi promosi lengkap','Bonus & reward bulanan'] as $b)
                    <div class="flex items-center gap-3 text-white/85">
                        <div class="w-6 h-6 bg-secondary-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        {{ $b }}
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('agen') }}" class="inline-flex items-center bg-gradient-to-r from-secondary-500 to-secondary-600 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-secondary-500/40 hover:-translate-y-1 transition-all">
                    <i class="fas fa-user-plus mr-3"></i> Daftar Jadi Agen
                </a>
            </div>

            <div class="grid grid-cols-2 gap-5" data-aos="fade-left">
                @foreach([
                    ['icon'=>'fas fa-percentage','c'=>'from-secondary-400 to-secondary-600','t'=>'Komisi Menarik','d'=>'Hingga 10%\nper booking'],
                    ['icon'=>'fas fa-graduation-cap','c'=>'from-primary-400 to-primary-600','t'=>'Training Gratis','d'=>'Pelatihan\nlengkap'],
                    ['icon'=>'fas fa-headset','c'=>'from-primary-500 to-primary-700','t'=>'Support 24/7','d'=>'Siap bantu\nkapan saja'],
                    ['icon'=>'fas fa-trophy','c'=>'from-secondary-500 to-secondary-700','t'=>'Bonus Reward','d'=>'Hadiah\nbulanan'],
                ] as $c)
                <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-3xl p-6 text-center hover:bg-white/20 transition-all hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br {{ $c['c'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="{{ $c['icon'] }} text-white text-xl"></i>
                    </div>
                    <h4 class="font-extrabold text-white mb-1">{{ $c['t'] }}</h4>
                    <p class="text-white/60 text-sm whitespace-pre-line">{{ $c['d'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ====================================================
     MARI DISKUSI
     ==================================================== --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-700 rounded-[2.5rem] p-10 md:p-16 overflow-hidden shadow-2xl" data-aos="zoom-in">
            <div class="absolute inset-0" style="background-image:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920'); background-size:cover; opacity:0.1;"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary-500/20 rounded-full blur-3xl"></div>
            <div class="relative text-center">
                <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                    <i class="fas fa-comments text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                    Mari Diskusi <span class="text-secondary-300">Perjalanan Anda!</span>
                </h2>
                <p class="text-white/85 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                    Tim kami siap membantu merencanakan perjalanan impian Anda. Konsultasi gratis, tanpa syarat!
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Trans,%20saya%20mau%20diskusi%20perjalanan" target="_blank"
                       class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold text-lg transition hover:-translate-y-1 shadow-xl">
                        <i class="fab fa-whatsapp mr-3 text-2xl"></i> Chat WhatsApp
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center justify-center bg-white text-primary-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition hover:-translate-y-1 shadow-xl">
                        <i class="fas fa-envelope mr-3"></i> Kirim Pesan
                    </a>
                    <a href="tel:+6281234567890"
                       class="inline-flex items-center justify-center bg-white/15 border border-white/30 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/25 transition hover:-translate-y-1">
                        <i class="fas fa-phone mr-3"></i> Telepon
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ====================================================
     SIAP PETUALANGAN + GOOGLE MAPS
     ==================================================== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- CTA Petualangan --}}
        <div class="relative rounded-3xl overflow-hidden mb-16 shadow-2xl" data-aos="fade-up">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1920&q=80" alt="Wisata" class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 via-primary-800/75 to-transparent"></div>
            <div class="relative p-12 md:p-20 max-w-2xl">
                <span class="inline-block bg-white/20 text-white px-3 py-1.5 rounded-full text-sm font-bold mb-4">
                    <i class="fas fa-gift mr-1"></i> Promo Spesial Hingga 30%
                </span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4 leading-tight">
                    Siap untuk<br><span class="text-secondary-300">Petualangan Berikutnya?</span>
                </h2>
                <p class="text-white/85 text-lg mb-8">Hubungi kami dan dapatkan penawaran terbaik untuk perjalanan impian Anda!</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('contact') }}" class="inline-flex items-center bg-white text-primary-700 px-7 py-3.5 rounded-2xl font-bold hover:bg-gray-100 transition shadow-lg hover:-translate-y-1">
                        <i class="fas fa-compass mr-2"></i> Hubungi Kami
                    </a>
                    <a href="{{ route('armada') }}" class="inline-flex items-center bg-secondary-500 text-white px-7 py-3.5 rounded-2xl font-bold hover:bg-secondary-600 transition shadow-lg hover:-translate-y-1">
                        <i class="fas fa-bus mr-2"></i> Lihat Armada
                    </a>
                </div>
            </div>
        </div>

        {{-- Google Maps --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-block bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-bold mb-3">
                <i class="fas fa-map-marker-alt mr-1"></i> LOKASI KAMI
            </span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                Kunjungi Kantor <span class="gradient-text">Endah Trans</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Lokasi strategis di Jepara, mudah dijangkau dari berbagai arah</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch" data-aos="fade-up">
            <div class="lg:col-span-2 rounded-3xl overflow-hidden shadow-xl border-4 border-primary-100">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.200488506536!2d110.750231!3d-6.7453843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70ddc096dc10ad%3A0xef6083aef28b357b!2sPo.Endah%20Trans%20Jepara!5e0!3m2!1sid!2sid!4v1769998406551!5m2!1sid!2sid"
                        width="100%" height="420" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-8 text-white shadow-xl flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-extrabold mb-6 flex items-center gap-2">
                        <i class="fas fa-map-location-dot text-secondary-300"></i> Informasi Lokasi
                    </h3>
                    <div class="space-y-5">
                        <div class="border-b border-white/20 pb-4">
                            <p class="text-white/60 text-xs font-bold uppercase mb-1">Alamat</p>
                            <p class="font-semibold text-sm leading-relaxed">Jl. Raya Jepara - Kudus, Rw. 03<br>Pelang, Kec. Mayong<br>Kab. Jepara, Jawa Tengah</p>
                        </div>
                        <div class="border-b border-white/20 pb-4">
                            <p class="text-white/60 text-xs font-bold uppercase mb-1">Telepon</p>
                            <a href="tel:+6281234567890" class="font-bold hover:text-secondary-300 transition"><i class="fas fa-phone mr-1"></i> +62 812-3456-7890</a>
                        </div>
                        <div class="border-b border-white/20 pb-4">
                            <p class="text-white/60 text-xs font-bold uppercase mb-1">Email</p>
                            <a href="mailto:info@endahtrans.com" class="font-bold hover:text-secondary-300 transition text-sm"><i class="fas fa-envelope mr-1"></i> info@endahtrans.com</a>
                        </div>
                        <div>
                            <p class="text-white/60 text-xs font-bold uppercase mb-1">Jam Operasional</p>
                            <p class="text-sm font-semibold">Sen–Jum: 08:00 – 17:00<br>Sabtu: 09:00 – 14:00<br><span class="text-red-300">Minggu: Tutup</span></p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 space-y-3">
                    <a href="https://maps.app.goo.gl/SQ1EFkbtUonSbyha7" target="_blank" class="w-full flex items-center justify-center bg-white text-primary-700 py-3 rounded-2xl font-bold hover:bg-gray-100 transition text-sm">
                        <i class="fas fa-directions mr-2"></i> Google Maps
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="w-full flex items-center justify-center bg-green-500 text-white py-3 rounded-2xl font-bold hover:bg-green-600 transition text-sm">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
