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
                        <i class="fas fa-share-alt text-secondary-400"></i> Temukan Kami di Sosmed
                    </h3>
                    <div class="space-y-4">
                        <a href="https://www.instagram.com/endahtranss?igsh=MWtneTllbWJueXd3cg==" target="_blank"
                           class="flex items-center gap-4 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white p-4 rounded-2xl font-semibold transition hover:-translate-y-0.5 shadow-lg">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fab fa-instagram text-2xl"></i>
                            </div>
                            <div>
                                <div class="font-bold">Instagram</div>
                                <div class="text-sm text-white/80">@endahtranss</div>
                            </div>
                            <i class="fas fa-arrow-right ml-auto"></i>
                        </a>
                        <a href="https://www.facebook.com/share/17q46CqyBr/" target="_blank"
                           class="flex items-center gap-4 bg-blue-600/90 hover:bg-blue-700 text-white p-4 rounded-2xl font-semibold transition hover:-translate-y-0.5 border border-blue-500/30">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fab fa-facebook text-xl"></i>
                            </div>
                            <div>
                                <div class="font-bold">Facebook</div>
                                <div class="text-sm text-white/80">Endah Trans</div>
                            </div>
                            <i class="fas fa-arrow-right ml-auto"></i>
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
     STATS COUNTER
     ==================================================== --}}
<section class="py-16 bg-white border-y border-primary-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach([
                ['icon'=>'fas fa-bus','val'=>$stats['packages'],'label'=>'Unit Armada','desc'=>'Armada siap beroperasi'],
                ['icon'=>'fas fa-map-marked-alt','val'=>$stats['destinations'],'label'=>'Destinasi','desc'=>'Tujuan wisata tersedia'],
                ['icon'=>'fas fa-smile-beam','val'=>max($stats['customers'],1000),'label'=>'Penumpang Puas','desc'=>'Pelanggan setia kami'],
                ['icon'=>'fas fa-calendar-check','val'=>10,'label'=>'Tahun Beroperasi','desc'=>'Pengalaman terpercaya'],
            ] as $i => $s)
            <div class="bg-white border border-primary-100 rounded-xl p-6 flex flex-col items-center text-center hover:border-primary-300 hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <i class="{{ $s['icon'] }} text-primary-500 text-3xl mb-3"></i>
                <div class="font-extrabold text-primary-900 text-3xl leading-none counter mb-1" data-target="{{ $s['val'] }}">1</div>
                <div class="font-bold text-primary-800 text-base mb-1">{{ $s['label'] }}</div>
                <div class="text-sm text-primary-500 leading-tight">{{ $s['desc'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ====================================================
     ABOUT US
     ==================================================== --}}
<section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">


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
                    <div class="text-4xl font-extrabold"><span class="counter" data-target="10">1</span>+</div>
                    <div class="text-xs font-semibold mt-1">Tahun<br>Pengalaman</div>
                </div>
            </div>

            {{-- Text --}}
            <div data-aos="fade-left">
                <span class="inline-block bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                    <i class="fas fa-building mr-1"></i> TENTANG KAMI
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-primary-900 mb-5 leading-tight">
                    Kenali <span class="gradient-text">Endah Trans</span><br>Lebih Dekat
                </h2>
                <p class="text-primary-800 text-lg leading-relaxed mb-5">
                    <strong class="text-primary-800">PO. Endah Trans</strong> adalah perusahaan transportasi bus wisata yang telah berdiri sejak 2014. Bermarkas di <strong class="text-primary-800">Jepara, Jawa Tengah</strong>, kami melayani perjalanan wisata ke berbagai destinasi di seluruh Indonesia.
                </p>
                <p class="text-primary-800 leading-relaxed mb-8">
                    Dengan armada bus modern, driver berpengalaman dan bersertifikat, serta layanan pelanggan yang ramah, kami berkomitmen menjadikan setiap perjalanan Anda sebagai pengalaman yang berkesan dan tak terlupakan.
                </p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach([
                        ['icon'=>'fas fa-bus','color'=>'primary','title'=>'Armada Modern','sub'=>'Bus AC terbaru'],
                        ['icon'=>'fas fa-certificate','color'=>'secondary','title'=>'Driver Tersertifikat','sub'=>'Profesional & ramah'],
                        ['icon'=>'fas fa-shield-alt','color'=>'primary','title'=>'Asuransi Penuh','sub'=>'Terlindungi'],
                        ['icon'=>'fas fa-headset','color'=>'secondary','title'=>'Support 24/7','sub'=>'Selalu siap'],
                    ] as $f)
                <div class="flex items-center gap-3 p-4 border border-primary-100 rounded-xl hover:border-{{ $f['color'] }}-300 transition">
                        <i class="{{ $f['icon'] }} text-{{ $f['color'] }}-500 text-lg flex-shrink-0"></i>
                        <div>
                            <div class="font-semibold text-primary-900 text-sm">{{ $f['title'] }}</div>
                            <div class="text-sm text-primary-600">{{ $f['sub'] }}</div>
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
<section class="py-28 relative overflow-hidden">
    {{-- Background hitam pekat dengan glow pink dominan --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#080508] via-[#1a0414] to-[#080508]"></div>
    <div class="absolute inset-0" style="background-image:url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1920'); background-size:cover; opacity:0.04;"></div>
    {{-- Glow pink kuat --}}
    <div class="absolute top-0 right-0 w-[700px] h-[700px] bg-secondary-500/40 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-secondary-600/35 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary-600/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

            {{-- Kiri: heading sticky --}}
            <div class="lg:col-span-4" data-aos="fade-right">
                <span class="inline-flex items-center gap-2 bg-secondary-500/20 backdrop-blur border border-secondary-400/30 text-secondary-300 px-5 py-2 rounded-full text-sm font-bold mb-6">
                    <i class="fas fa-award text-secondary-400"></i> KENAPA KAMI
                </span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-6">
                    Mengapa<br>Memilih<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-300 to-secondary-500">Endah Trans?</span>
                </h2>
                <p class="text-white/40 text-base leading-relaxed mb-10">Standar layanan terbaik untuk setiap perjalanan wisata Anda bersama kami.</p>

                {{-- Mini stats --}}
                <div class="flex flex-col gap-4">
                    @foreach([['10+','Tahun Beroperasi'],['1000+','Penumpang Puas'],['42+','Unit Armada']] as $s)
                    <div class="flex items-center gap-4">
                        <span class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-secondary-300 to-secondary-500">{{ $s[0] }}</span>
                        <span class="text-white/50 text-sm">{{ $s[1] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Kanan: feature cards --}}
            <div class="lg:col-span-8 relative">
                <div class="absolute left-8 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-secondary-500/30 to-transparent hidden md:block"></div>

                <div class="flex flex-col gap-4">
                    @foreach([
                        ['num'=>'01','icon'=>'fas fa-shield-alt',  'from'=>'from-secondary-400', 'to'=>'to-secondary-600', 'title'=>'Aman & Terpercaya',    'desc'=>'Armada terawat dengan driver bersertifikat dan rekam jejak keselamatan yang selalu terjamin untuk Anda.'],
                        ['num'=>'02','icon'=>'fas fa-tags',         'from'=>'from-secondary-500', 'to'=>'to-primary-500',   'title'=>'Harga Bersaing',        'desc'=>'Tarif paling kompetitif tanpa mengurangi kualitas layanan dan kenyamanan penumpang di setiap perjalanan.'],
                        ['num'=>'03','icon'=>'fas fa-headset',      'from'=>'from-secondary-400', 'to'=>'to-secondary-700', 'title'=>'Customer Support 24/7', 'desc'=>'Tim kami siap membantu kapanpun Anda membutuhkan informasi maupun bantuan terkait perjalanan Anda.'],
                        ['num'=>'04','icon'=>'fas fa-medal',        'from'=>'from-primary-500',   'to'=>'to-secondary-500', 'title'=>'Pengalaman 10+ Tahun',  'desc'=>'Telah melayani ribuan perjalanan wisata di seluruh Indonesia dengan reputasi dan kepercayaan yang terjaga.'],
                    ] as $i => $w)
                    <div class="group flex items-start gap-5 bg-white/5 hover:bg-secondary-500/10 border border-white/8 hover:border-secondary-400/30 rounded-2xl p-5 transition-all duration-300 hover:-translate-x-1 hover:shadow-2xl hover:shadow-secondary-900/50 overflow-hidden relative" data-aos="fade-left" data-aos-delay="{{ $i * 100 }}">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[5rem] font-black text-white/5 group-hover:text-secondary-400/15 leading-none select-none pointer-events-none transition-all duration-500">{{ $w['num'] }}</span>

                        <div class="relative flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br {{ $w['from'] }} {{ $w['to'] }} rounded-2xl flex items-center justify-center shadow-lg shadow-secondary-900/50 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                <i class="{{ $w['icon'] }} text-white text-xl"></i>
                            </div>
                        </div>

                        <div class="relative flex-1 pt-1">
                            <div class="flex items-center gap-3 mb-1">
                                <span class="text-xs font-black tracking-widest text-secondary-500/50 group-hover:text-secondary-400 transition-colors duration-300">{{ $w['num'] }}</span>
                                <div class="h-px flex-1 bg-gradient-to-r {{ $w['from'] }} {{ $w['to'] }} opacity-30 group-hover:opacity-80 transition-opacity duration-300"></div>
                            </div>
                            <h3 class="text-lg font-extrabold text-white mb-1.5">{{ $w['title'] }}</h3>
                            <p class="text-white/45 text-sm leading-relaxed group-hover:text-white/70 transition-colors duration-300">{{ $w['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ====================================================
     FASILITAS ARMADA
     ==================================================== --}}
<section class="py-20 relative overflow-hidden bg-white">
    {{-- Aksen tipis di pojok --}}
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-secondary-50 rounded-full blur-3xl opacity-60 translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-primary-50 rounded-full blur-3xl opacity-60 -translate-x-1/4 translate-y-1/4"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-600 px-5 py-2 rounded-full text-sm font-bold mb-5">
                <i class="fas fa-star text-secondary-500"></i> FASILITAS ARMADA
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Fasilitas <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-primary-500">Lengkap</span> di Setiap Bus
            </h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">Kenyamanan maksimal dengan fasilitas modern tersedia di seluruh armada kami</p>
        </div>

        <div class="max-w-2xl mx-auto grid grid-cols-4 sm:grid-cols-6 gap-3">
            @foreach([
                ['icon'=>'fas fa-snowflake',        'label'=>'AC Full',        'alt'=>false],
                ['icon'=>'fas fa-wifi',              'label'=>'WiFi',           'alt'=>true],
                ['icon'=>'fas fa-tv',                'label'=>'LCD TV',         'alt'=>false],
                ['icon'=>'fas fa-bolt',              'label'=>'USB Charger',    'alt'=>true],
                ['icon'=>'fas fa-couch',             'label'=>'Reclining Seat', 'alt'=>false],
                ['icon'=>'fas fa-toilet',            'label'=>'Toilet',         'alt'=>true],
                ['icon'=>'fas fa-utensils',          'label'=>'Snack',          'alt'=>false],
                ['icon'=>'fas fa-music',             'label'=>'Audio System',   'alt'=>true],
                ['icon'=>'fas fa-tint',              'label'=>'Air Minum',      'alt'=>false],
                ['icon'=>'fas fa-camera',            'label'=>'CCTV',           'alt'=>true],
                ['icon'=>'fas fa-first-aid',         'label'=>'P3K',            'alt'=>false],
                ['icon'=>'fas fa-fire-extinguisher', 'label'=>'APAR',           'alt'=>true],
            ] as $i => $f)
            <div class="group text-center" data-aos="zoom-in" data-aos-delay="{{ ($i % 6) * 50 }}">
                @if($f['alt'])
                {{-- Pink --}}
                <div class="w-full aspect-square bg-secondary-50 rounded-2xl flex flex-col items-center justify-center p-2 border border-secondary-100 hover:bg-secondary-100 hover:shadow-md hover:-translate-y-1.5 transition-all duration-300 cursor-default">
                    <i class="{{ $f['icon'] }} text-2xl text-secondary-500 mb-2 group-hover:scale-110 transition-transform duration-300"></i>
                    <span class="text-gray-600 text-xs font-semibold leading-tight text-center">{{ $f['label'] }}</span>
                </div>
                @else
                {{-- Merah --}}
                <div class="w-full aspect-square bg-primary-50 rounded-2xl flex flex-col items-center justify-center p-2 border border-primary-100 hover:bg-primary-100 hover:shadow-md hover:-translate-y-1.5 transition-all duration-300 cursor-default">
                    <i class="{{ $f['icon'] }} text-2xl text-primary-500 mb-2 group-hover:scale-110 transition-transform duration-300"></i>
                    <span class="text-gray-600 text-xs font-semibold leading-tight text-center">{{ $f['label'] }}</span>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('armada') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-secondary-500 to-primary-500 text-white font-bold px-8 py-4 rounded-2xl hover:opacity-90 transition hover:-translate-y-1 shadow-lg shadow-secondary-200">
                <i class="fas fa-bus"></i> Lihat Selengkapnya Armada
            </a>
        </div>
    </div>
</section>


{{-- ====================================================
     ARMADA & RUTE BERTAB
     ==================================================== --}}
<section id="eksplorasi" class="py-16 relative bg-gray-50" x-data="{ tab: new URLSearchParams(window.location.search).get('tab') || 'armada' }">
    {{-- Aksen tipis pojok --}}
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-secondary-50 rounded-full blur-3xl opacity-70 translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-primary-50 rounded-full blur-3xl opacity-70 -translate-x-1/4 translate-y-1/4"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-600 px-5 py-2 rounded-full text-sm font-bold mb-5">
                <i class="fas fa-bus text-secondary-500"></i> EKSPLORASI
            </span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                Armada & <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-primary-500">Rute Perjalanan</span>
            </h2>
            <p class="text-gray-500 text-base max-w-xl mx-auto">Pilih armada impian Anda atau lihat video rute perjalanan kami</p>
        </div>

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap justify-center gap-3 mb-10" data-aos="fade-up">
            <button @click="tab='armada'"
                    :class="tab==='armada' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-lg shadow-secondary-200' : 'bg-white text-gray-700 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                    class="px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 text-sm">
                <i class="fas fa-bus mr-1"></i> Armada
            </button>
            <button @click="tab='rute'"
                    :class="tab==='rute' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-lg shadow-secondary-200' : 'bg-white text-gray-700 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                    class="px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 text-sm">
                <i class="fas fa-map-marked-alt mr-1"></i> Rute
            </button>
            <button @click="tab='galeri'"
                    :class="tab==='galeri' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-lg shadow-secondary-200' : 'bg-white text-gray-700 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                    class="px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 text-sm">
                <i class="fas fa-images mr-1"></i> Galeri
            </button>
            <button @click="tab='carapesan'"
                    :class="tab==='carapesan' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-lg shadow-secondary-200' : 'bg-white text-gray-700 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                    class="px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 text-sm">
                <i class="fas fa-clipboard-list mr-1"></i> Cara Pesan
            </button>
        </div>

        {{-- TAB: ARMADA --}}
        <div x-show="tab==='armada'"
             x-transition:enter="transition duration-300 ease-out"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['img'=>'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&q=80','name'=>'Big Bus Eksklusif','cap'=>'45 Kursi','type'=>'Eksklusif','badge'=>'bg-yellow-100 text-yellow-700','fitur'=>['AC Double Blower','Toilet VIP','WiFi','Reclining Full','LCD TV','Snack']],
                    ['img'=>'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=600&q=80','name'=>'Big Bus Reguler','cap'=>'45 Kursi','type'=>'Reguler','badge'=>'bg-blue-100 text-blue-700','fitur'=>['AC','WiFi','LCD TV','USB Charger','Reclining Seat']],
                    ['img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80','name'=>'Medium Bus Eksklusif','cap'=>'35 Kursi','type'=>'Eksklusif','badge'=>'bg-purple-100 text-purple-700','fitur'=>['AC Double Blower','Toilet VIP','WiFi','Reclining Full','Snack']],
                    ['img'=>'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=600&q=80','name'=>'Medium Bus Reguler','cap'=>'35 Kursi','type'=>'Reguler','badge'=>'bg-emerald-100 text-emerald-700','fitur'=>['AC','WiFi','LCD TV','USB Charger']],
                ] as $i => $bus)
                <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-secondary-200 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $bus['img'] }}" alt="{{ $bus['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <span class="absolute top-3 left-3 text-xs font-bold px-3 py-1 rounded-full {{ $bus['badge'] }}">{{ $bus['type'] }}</span>
                        <div class="absolute bottom-3 left-4 text-white">
                            <div class="font-extrabold text-lg">{{ $bus['name'] }}</div>
                            <div class="text-white/80 text-xs"><i class="fas fa-users mr-1"></i> {{ $bus['cap'] }}</div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            @foreach($bus['fitur'] as $f)
                            <span class="text-xs bg-secondary-50 text-secondary-600 border border-secondary-100 px-2 py-1 rounded-full font-medium">{{ $f }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('armada') }}" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-secondary-500 to-primary-500 text-white text-sm font-bold py-2.5 rounded-xl hover:opacity-90 transition">
                            <i class="fas fa-info-circle"></i> Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('armada') }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-secondary-300 text-secondary-600 font-bold rounded-2xl hover:bg-secondary-50 transition hover:-translate-y-1">
                    <i class="fas fa-bus"></i> Lihat Semua Armada
                </a>
            </div>
        </div>

        {{-- TAB: VIDEO RUTE --}}
        <div x-show="tab==='rute'"
             x-transition:enter="transition duration-300 ease-out"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-data="{ filterRute: 'semua' }">
            @if($routeVideos->count() > 0)
            @php
                $destinations = $routeVideos->pluck('destination')->filter()->unique()->sort()->values();
            @endphp

            {{-- Filter Destinasi --}}
            @if($destinations->count() > 0)
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                <button @click="filterRute='semua'"
                        :class="filterRute==='semua' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                        class="px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-200">
                    <i class="fas fa-globe mr-1"></i> Semua Tujuan
                </button>
                @foreach($destinations as $dest)
                <button @click="filterRute='{{ $dest }}'"
                        :class="filterRute==='{{ $dest }}' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                        class="px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-200">
                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $dest }}
                </button>
                @endforeach
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($routeVideos->take(3) as $i => $video)
                <div x-show="filterRute==='semua' || filterRute==='{{ $video->destination }}'"
                     x-transition:enter="transition duration-300 ease-out"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-secondary-200 hover:shadow-xl transition-all duration-300"
                     data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 100 }}">
                    <div class="relative aspect-video overflow-hidden">
                        <iframe src="{{ $video->embed_url }}"
                                class="w-full h-full"
                                frameborder="0" allowfullscreen
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                        </iframe>
                    </div>
                    <div class="p-4">
                        @if($video->destination)
                        <span class="inline-block text-xs bg-secondary-50 text-secondary-600 border border-secondary-100 font-semibold px-2 py-0.5 rounded-full mb-2">
                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $video->destination }}
                        </span>
                        @endif
                        <h3 class="font-bold text-gray-900 text-base leading-snug mb-1">{{ $video->title }}</h3>
                        @if($video->description)
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">{{ $video->description }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @if($routeVideos->count() > 3)
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('rute') }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-secondary-300 text-secondary-600 font-bold rounded-2xl hover:bg-secondary-50 transition hover:-translate-y-1">
                    <i class="fas fa-map-marked-alt"></i> Lihat Semua Rute
                    <span class="bg-secondary-100 text-secondary-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $routeVideos->count() }}</span>
                </a>
            </div>
            @endif
            @else
            <div class="text-center py-20">
                <i class="fas fa-video text-gray-300 text-5xl mb-4 block"></i>
                <p class="text-gray-500 font-medium">Video rute belum tersedia.</p>
                <p class="text-gray-400 text-sm mt-1">Tambahkan melalui panel admin.</p>
            </div>
            @endif
        </div>

        {{-- TAB: GALERI --}}
        <div x-show="tab==='galeri'"
             x-transition:enter="transition duration-300 ease-out"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="columns-2 md:columns-3 gap-4">
                @foreach([
                    ['url'=>'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&q=80','label'=>'Armada Eksklusif'],
                    ['url'=>'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80','label'=>'Perjalanan Pantai'],
                    ['url'=>'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=600&q=80','label'=>'Armada Medium'],
                    ['url'=>'https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=600&q=80','label'=>'Destinasi Wisata'],
                    ['url'=>'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=600&q=80','label'=>'Perjalanan Seru'],
                    ['url'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80','label'=>'Armada Premium'],
                ] as $i => $photo)
                <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">
                    <img src="{{ $photo['url'] }}" alt="{{ $photo['label'] }}"
                         class="w-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                        <span class="text-white text-xs font-bold">{{ $photo['label'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-secondary-500 to-primary-500 text-white font-bold rounded-2xl hover:opacity-90 transition hover:-translate-y-1 shadow-lg shadow-secondary-200">
                    <i class="fas fa-images"></i> Lihat Lebih Banyak
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>

        {{-- TAB: CARA PESAN --}}
        <div x-show="tab==='carapesan'"
             x-transition:enter="transition duration-300 ease-out"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['num'=>'01','icon'=>'fas fa-phone-alt','from'=>'from-secondary-400','to'=>'to-secondary-600','title'=>'Hubungi Kami','desc'=>'Kontak via WhatsApp, telepon, atau email. Ceritakan kebutuhan perjalanan Anda.'],
                    ['num'=>'02','icon'=>'fas fa-comments','from'=>'from-secondary-500','to'=>'to-primary-500','title'=>'Diskusi & Penawaran','desc'=>'Tim kami berikan rekomendasi armada, harga, dan jadwal yang paling sesuai.'],
                    ['num'=>'03','icon'=>'fas fa-file-contract','from'=>'from-primary-400','to'=>'to-secondary-500','title'=>'Konfirmasi & DP','desc'=>'Setuju? Konfirmasi dengan DP minimal 30% untuk memblokir unit armada.'],
                    ['num'=>'04','icon'=>'fas fa-bus','from'=>'from-secondary-400','to'=>'to-primary-600','title'=>'Berangkat!','desc'=>'Armada tiba tepat waktu. Pelunasan sebelum berangkat. Selamat menikmati!'],
                ] as $i => $step)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:border-secondary-200 hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="relative mb-5">
                        <div class="w-14 h-14 bg-gradient-to-br {{ $step['from'] }} {{ $step['to'] }} rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="{{ $step['icon'] }} text-white text-xl"></i>
                        </div>
                        <span class="absolute -top-2 -right-2 w-7 h-7 bg-white border-2 border-secondary-400 rounded-full flex items-center justify-center text-xs font-black text-secondary-600">{{ ($i+1) }}</span>
                    </div>
                    <div class="text-xs font-black tracking-widest text-secondary-400 mb-1">LANGKAH {{ $step['num'] }}</div>
                    <h4 class="font-extrabold text-gray-900 text-base mb-2">{{ $step['title'] }}</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="{{ route('cara-pesan') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-secondary-500 to-primary-500 text-white font-bold rounded-2xl hover:opacity-90 transition hover:-translate-y-1 shadow-lg shadow-secondary-200">
                    <i class="fas fa-clipboard-list"></i> Lihat Panduan Lengkap
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ====================================================
     TIPS PERJALANAN (Visual Cards)
     ==================================================== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10" data-aos="fade-up">
            <span class="inline-block bg-secondary-100 text-secondary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                <i class="fas fa-lightbulb mr-1"></i> TIPS & PANDUAN
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-primary-900 mb-3">
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
            <div class="group flex gap-4 p-5 rounded-xl border border-primary-100 hover:border-primary-300 bg-white hover:shadow-sm transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ ($i%3)*100 }}">
                <div class="w-11 h-11 bg-gradient-to-br {{ $tip['c'] }} rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                    <i class="{{ $tip['ico'] }} text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-primary-900 text-lg mb-2">{{ $tip['t'] }}</h3>
                    <p class="text-primary-700 text-base leading-relaxed">{{ $tip['d'] }}</p>
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
<section class="py-20 relative overflow-hidden">
    {{-- Background hitam pekat dengan glow pink dominan --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#080508] via-[#1a0414] to-[#080508]"></div>
    <div class="absolute top-0 right-0 w-[700px] h-[700px] bg-secondary-500/40 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-secondary-600/35 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary-600/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 bg-secondary-500/20 backdrop-blur border border-secondary-400/30 text-secondary-300 px-5 py-2 rounded-full text-sm font-bold mb-5">
                <i class="fas fa-heart text-secondary-400"></i> ULASAN PELANGGAN
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4">
                Apa Kata <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-300 to-secondary-500">Sahabat Endah Trans?</span>
            </h2>
            <p class="text-white/40 text-base max-w-xl mx-auto">Pengalaman nyata dari ribuan pelanggan setia kami di seluruh Indonesia</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $i => $t)
            @php
                $avatarColors = ['dc2626','be123c','9f1239','881337','e11d48','f43f5e'];
                $avc  = $avatarColors[$i % count($avatarColors)];
            @endphp
            <div class="group relative bg-white/5 hover:bg-secondary-500/10 border border-white/8 hover:border-secondary-400/30 rounded-3xl p-7 hover:shadow-2xl hover:shadow-secondary-900/50 hover:-translate-y-2 transition-all duration-400"
                 data-aos="fade-up" data-aos-delay="{{ ($i%3)*100 }}">

                {{-- Giant quote mark --}}
                <div class="absolute top-4 right-5 text-8xl font-serif text-white/10 leading-none select-none">"</div>

                {{-- Stars --}}
                <div class="flex items-center gap-1 mb-4">
                    @for($s=1;$s<=5;$s++)
                    <i class="fas fa-star {{ $s<=$t->rating ? 'text-amber-400' : 'text-white/15' }} text-sm"></i>
                    @endfor
                    <span class="ml-2 text-xs text-white/30 font-medium">{{ $t->rating }}.0</span>
                </div>

                {{-- Content --}}
                <p class="text-white/60 text-sm leading-relaxed mb-7 min-h-[72px] group-hover:text-white/80 transition-colors duration-300">"{{ $t->content }}"</p>

                {{-- Footer --}}
                <div class="flex items-center gap-3 pt-5 border-t border-white/10">
                    <div class="relative flex-shrink-0">
                        <div class="w-12 h-12 rounded-2xl p-0.5 bg-gradient-to-br from-secondary-400 to-secondary-600 shadow-lg">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($t->name) }}&background={{ $avc }}&color=fff&bold=true&size=48"
                                 alt="{{ $t->name }}" class="w-full h-full rounded-xl object-cover">
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-400 rounded-full border-2 border-gray-900 flex items-center justify-center">
                            <i class="fas fa-check text-white text-[7px]"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-bold text-secondary-300 text-sm truncate">{{ $t->name }}</div>
                        @if($t->location)
                        <div class="text-white/30 text-xs flex items-center gap-1 mt-0.5">
                            <i class="fas fa-map-marker-alt text-secondary-400 text-[10px]"></i>
                            {{ $t->location }}
                        </div>
                        @endif
                    </div>
                    <span class="flex-shrink-0 text-[10px] font-bold bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2 py-1 rounded-full">
                        ✓ Verified
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="text-center mt-16" data-aos="fade-up">
            <p class="text-white/40 text-sm mb-6">Bergabung dengan ribuan pelanggan puas Endah Trans</p>
            <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Trans,%20saya%20ingin%20memberikan%20ulasan" target="_blank"
               class="group inline-flex items-center gap-3 bg-secondary-500/20 hover:bg-secondary-500/30 border border-secondary-400/30 text-secondary-300 hover:text-white px-8 py-4 rounded-2xl font-bold hover:-translate-y-1 transition-all duration-300 text-base">
                <div class="w-9 h-9 bg-secondary-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-star text-secondary-400 text-sm"></i>
                </div>
                <span>Tulis Ulasan Anda</span>
                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>
@endif


{{-- ====================================================
     TIM PROFESIONAL
     ==================================================== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                <i class="fas fa-users mr-2"></i> Our Team
            </span>
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Tim Profesional Kami</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Orang-orang hebat di balik layanan terbaik kami</p>
        </div>

        @php $teams = \App\Models\Team::all(); @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @if($teams->count() > 0)
                @foreach($teams as $index => $member)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                        <div class="relative h-80 overflow-hidden">
                            <img src="{{ $member->image ? asset('storage/' . $member->image) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400' }}"
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                 alt="{{ $member->name }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-full group-hover:translate-y-0 transition-transform">
                                <div class="flex justify-center space-x-3">
                                    @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="w-10 h-10 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center text-white hover:bg-white hover:text-blue-600 transition">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    @endif
                                    @if($member->instagram_url)
                                    <a href="{{ $member->instagram_url }}" target="_blank" class="w-10 h-10 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center text-white hover:bg-white hover:text-pink-600 transition">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="text-xl font-bold text-gray-900 mb-1">{{ $member->name }}</h4>
                            <p class="text-primary-600 font-medium">{{ $member->role }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @foreach([['Budi Santoso','Direktur Utama'],['Siti Rahayu','Manajer Operasional'],['Ahmad Fauzi','Kepala Driver']] as $index => $m)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                        <div class="relative h-80 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400"
                                 alt="{{ $m[0] }}"
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="text-xl font-bold text-gray-900 mb-1">{{ $m[0] }}</h4>
                            <p class="text-primary-600 font-medium">{{ $m[1] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


{{-- ====================================================
     GOOGLE MAPS + INFORMASI LOKASI
     ==================================================== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Google Maps --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-block bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-bold mb-3">
                <i class="fas fa-map-marker-alt mr-1"></i> LOKASI KAMI
            </span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-primary-900 mb-3">
                Kunjungi Kantor <span class="gradient-text">Endah Trans</span>
            </h2>
            <p class="text-primary-800 text-lg max-w-2xl mx-auto">Lokasi strategis di Jepara, mudah dijangkau dari berbagai arah</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch" data-aos="fade-up">
            <div class="lg:col-span-2 rounded-3xl overflow-hidden shadow-xl border-4 border-primary-100 min-h-[420px]">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.200488506536!2d110.750231!3d-6.7453843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70ddc096dc10ad%3A0xef6083aef28b357b!2sPo.Endah%20Trans%20Jepara!5e0!3m2!1sid!2sid!4v1769998406551!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0; display:block; min-height:420px;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-8 text-white shadow-xl flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-extrabold mb-6 flex items-center gap-2">
                        <i class="fas fa-map-location-dot text-secondary-300"></i> Informasi Lokasi
                    </h3>
                    <div class="space-y-5">
                        <div class="border-b border-white/20 pb-4">
                            <p class="text-white/60 text-xs font-bold uppercase mb-1">Alamat</p>
                            <p class="font-semibold text-base leading-relaxed">Jl. Raya Jepara - Kudus, Rw. 03<br>Pelang, Kec. Mayong<br>Kab. Jepara, Jawa Tengah</p>
                        </div>
                        <div class="border-b border-white/20 pb-4">
                            <p class="text-white/60 text-xs font-bold uppercase mb-1">Telepon</p>
                            <a href="tel:+6281234567890" class="font-bold hover:text-secondary-300 transition"><i class="fas fa-phone mr-1"></i> +62 812-3456-7890</a>
                        </div>
                        <div class="border-b border-white/20 pb-4">
                            <p class="text-white/60 text-xs font-bold uppercase mb-1">Email</p>
                            <a href="mailto:info@endahtrans.com" class="font-bold hover:text-secondary-300 transition text-base"><i class="fas fa-envelope mr-1"></i> info@endahtrans.com</a>
                        </div>
                        <div>
                            <p class="text-white/60 text-xs font-bold uppercase mb-1">Jam Operasional</p>
                            <p class="text-base font-semibold">Sen–Jum: 08:00 – 17:00<br>Sabtu: 09:00 – 14:00<br><span class="text-red-300">Minggu: Tutup</span></p>
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

