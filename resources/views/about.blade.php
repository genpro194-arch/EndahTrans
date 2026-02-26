@extends('layouts.app')

@section('title', 'Tentang Kami - Endah Travel')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                 class="w-full h-full object-cover" alt="Travel Background">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 via-primary-800/80 to-secondary-900/70"></div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-[10%] w-20 h-20 bg-white/10 backdrop-blur rounded-3xl flex items-center justify-center animate-bounce" style="animation-duration: 4s;">
                <i class="fas fa-plane text-white/80 text-2xl"></i>
            </div>
            <div class="absolute bottom-32 right-[15%] w-16 h-16 bg-secondary-500/30 backdrop-blur rounded-2xl flex items-center justify-center animate-bounce" style="animation-duration: 3s; animation-delay: 1s;">
                <i class="fas fa-heart text-white/80 text-xl"></i>
            </div>
            <div class="absolute top-1/3 right-[10%] w-14 h-14 bg-white/10 backdrop-blur rounded-xl flex items-center justify-center animate-bounce" style="animation-duration: 5s; animation-delay: 2s;">
                <i class="fas fa-star text-white/80"></i>
            </div>
        </div>
        
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <span class="inline-flex items-center px-5 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-medium mb-6" data-aos="fade-down">
                <i class="fas fa-info-circle mr-2"></i> Sejak 2015
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6" data-aos="fade-up">
                Tentang <span class="text-secondary-300">Endah Travel</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/80 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Mitra perjalanan terpercaya yang telah melayani ribuan pelanggan di seluruh Indonesia
            </p>
            
            <!-- Trust Badges -->
            <div class="flex flex-wrap justify-center gap-6 mt-12" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center bg-white/10 backdrop-blur px-5 py-3 rounded-2xl">
                    <i class="fas fa-award text-secondary-400 text-xl mr-3"></i>
                    <span class="text-white font-semibold">Terpercaya</span>
                </div>
                <div class="flex items-center bg-white/10 backdrop-blur px-5 py-3 rounded-2xl">
                    <i class="fas fa-shield-alt text-secondary-400 text-xl mr-3"></i>
                    <span class="text-white font-semibold">Berlisensi</span>
                </div>
                <div class="flex items-center bg-white/10 backdrop-blur px-5 py-3 rounded-2xl">
                    <i class="fas fa-users text-secondary-400 text-xl mr-3"></i>
                    <span class="text-white font-semibold">10K+ Pelanggan</span>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                {{-- Image Collage (kiri) --}}
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

                {{-- Teks (kanan) --}}
                <div data-aos="fade-left">
                    <span class="inline-block bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                        <i class="fas fa-history mr-1"></i> CERITA KAMI
                    </span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-primary-900 mb-5 leading-tight">
                        Siapa <span class="gradient-text">Endah Trans?</span>
                    </h2>
                    <p class="text-primary-800 text-lg leading-relaxed mb-4">
                        <strong class="text-primary-800">PO. Endah Trans</strong> adalah perusahaan transportasi bus wisata yang telah berdiri sejak 2014. Bermarkas di <strong class="text-primary-800">Jepara, Jawa Tengah</strong>, kami melayani perjalanan wisata ke berbagai destinasi di seluruh Indonesia.
                    </p>
                    <p class="text-primary-800 leading-relaxed mb-8">
                        Dengan armada bus modern, driver berpengalaman dan bersertifikat, serta layanan pelanggan yang ramah, kami berkomitmen menjadikan setiap perjalanan Anda sebagai pengalaman yang berkesan dan tak terlupakan.
                    </p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        @foreach([
                            ['icon'=>'fas fa-tags',       'color'=>'primary',   'title'=>'Harga Transparan',    'sub'=>'Tidak ada biaya tersembunyi'],
                            ['icon'=>'fas fa-user-tie',   'color'=>'secondary', 'title'=>'Guide Profesional',   'sub'=>'Berpengalaman & ramah'],
                            ['icon'=>'fas fa-bus',         'color'=>'secondary', 'title'=>'Armada Terawat',      'sub'=>'Bus AC modern terbaru'],
                            ['icon'=>'fas fa-headset',    'color'=>'primary',   'title'=>'Layanan 24/7',         'sub'=>'Selalu siap membantu'],
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

                    {{-- Stats strip pembeda --}}
                    <div class="flex items-center gap-6 pt-2">
                        <div class="text-center">
                            <div class="text-2xl font-extrabold text-primary-700"><span class="counter" data-target="42">1</span>+</div>
                            <div class="text-xs text-gray-500 font-medium">Unit Armada</div>
                        </div>
                        <div class="w-px h-10 bg-primary-100"></div>
                        <div class="text-center">
                            <div class="text-2xl font-extrabold text-secondary-600"><span class="counter" data-target="21">1</span>+</div>
                            <div class="text-xs text-gray-500 font-medium">Destinasi</div>
                        </div>
                        <div class="w-px h-10 bg-primary-100"></div>
                        <div class="text-center">
                            <div class="text-2xl font-extrabold text-primary-700"><span class="counter" data-target="1000">1</span>+</div>
                            <div class="text-xs text-gray-500 font-medium">Penumpang Puas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-flex items-center px-4 py-2 bg-secondary-100 text-secondary-700 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-compass mr-2"></i> Arah Kami
                </span>
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Visi & Misi</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100 relative overflow-hidden group" data-aos="fade-right">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-700 rounded-3xl flex items-center justify-center mb-8 shadow-lg shadow-primary-500/30">
                            <i class="fas fa-eye text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Menjadi perusahaan jasa perjalanan wisata <strong>terdepan di Indonesia</strong> yang memberikan pengalaman perjalanan berkualitas dengan harga terjangkau untuk semua kalangan masyarakat.
                        </p>
                    </div>
                </div>
                
                <div class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100 relative overflow-hidden group" data-aos="fade-left">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-secondary-100 to-secondary-200 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-secondary-500 to-secondary-700 rounded-3xl flex items-center justify-center mb-8 shadow-lg shadow-secondary-500/30">
                            <i class="fas fa-bullseye text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                        <ul class="space-y-4 text-gray-600">
                            @foreach([
                                'Menyediakan paket wisata dengan harga kompetitif',
                                'Memberikan pelayanan prima dan profesional',
                                'Mengutamakan keselamatan dan kenyamanan',
                                'Membangun hubungan jangka panjang dengan pelanggan'
                            ] as $misi)
                            <li class="flex items-start">
                                <div class="w-6 h-6 bg-secondary-100 rounded-full flex items-center justify-center flex-shrink-0 mr-3 mt-0.5">
                                    <i class="fas fa-check text-secondary-600 text-xs"></i>
                                </div>
                                <span>{{ $misi }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-24 relative overflow-hidden">
        {{-- Background gelap gradient --}}
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-primary-950 to-gray-900"></div>
        <div class="absolute inset-0" style="background-image:url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1920'); background-size:cover; opacity:0.04;"></div>
        {{-- Glow kiri-kanan --}}
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[500px] h-[500px] bg-primary-700/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 right-0 -translate-y-1/2 w-[500px] h-[500px] bg-secondary-700/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header tengah --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white border border-white/20 px-5 py-2 rounded-full text-sm font-bold mb-5">
                    <i class="fas fa-gem text-secondary-400"></i> CORE VALUES
                </span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white leading-tight">
                    Nilai-Nilai <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-secondary-400">Kami</span>
                </h2>
                <p class="text-white/40 text-base mt-3 max-w-md mx-auto">Prinsip yang kami pegang teguh dalam setiap pelayanan.</p>
            </div>

            {{-- Bento Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach([
                    ['num'=>'01','icon'=>'fas fa-handshake','from'=>'from-primary-500','to'=>'to-primary-700','glow'=>'shadow-primary-700/50',  'title'=>'Kepercayaan','desc'=>'Membangun kepercayaan melalui transparansi dan integritas dalam setiap langkah perjalanan bersama Anda.'],
                    ['num'=>'02','icon'=>'fas fa-award',    'from'=>'from-secondary-400','to'=>'to-secondary-600','glow'=>'shadow-secondary-700/50','title'=>'Kualitas',   'desc'=>'Selalu memberikan layanan dengan standar kualitas tinggi dan memastikan kepuasan di atas segalanya.'],
                    ['num'=>'03','icon'=>'fas fa-heart',    'from'=>'from-primary-600','to'=>'to-secondary-500','glow'=>'shadow-primary-700/50',  'title'=>'Kepedulian', 'desc'=>'Peduli terhadap kebutuhan dan kenyamanan setiap pelanggan seperti keluarga sendiri.'],
                    ['num'=>'04','icon'=>'fas fa-lightbulb','from'=>'from-secondary-500','to'=>'to-primary-600','glow'=>'shadow-secondary-700/50','title'=>'Inovasi',    'desc'=>'Terus berinovasi untuk menghadirkan pengalaman perjalanan yang lebih modern dan berkesan.'],
                ] as $i => $v)
                <div class="group relative bg-white/5 backdrop-blur border border-white/10 rounded-3xl overflow-hidden hover:bg-white/10 hover:border-white/20 transition-all duration-400 hover:-translate-y-1 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="{{ $i * 120 }}">
                    {{-- Nomor raksasa transparan di background --}}
                    <span class="absolute -bottom-6 -right-4 text-[9rem] font-black text-white/5 leading-none select-none pointer-events-none group-hover:text-white/10 transition-all duration-500">{{ $v['num'] }}</span>

                    <div class="relative flex gap-0">
                        {{-- Panel kiri — strip gradient dengan ikon --}}
                        <div class="flex-shrink-0 w-24 bg-gradient-to-b {{ $v['from'] }} {{ $v['to'] }} flex flex-col items-center justify-center py-8 gap-3">
                            <i class="{{ $v['icon'] }} text-white text-3xl group-hover:scale-125 group-hover:-rotate-6 transition-transform duration-300"></i>
                            <span class="text-white/70 text-xs font-bold tracking-widest -rotate-90 mt-4">{{ $v['num'] }}</span>
                        </div>

                        {{-- Panel kanan — teks --}}
                        <div class="flex-1 p-7">
                            <div class="w-8 h-1 bg-gradient-to-r {{ $v['from'] }} {{ $v['to'] }} rounded-full mb-4 group-hover:w-16 transition-all duration-300"></div>
                            <h3 class="text-xl font-extrabold text-white mb-3">{{ $v['title'] }}</h3>
                            <p class="text-white/50 text-sm leading-relaxed group-hover:text-white/70 transition-colors duration-300">{{ $v['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-users mr-2"></i> Our Team
                </span>
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Tim Profesional Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Orang-orang hebat di balik layanan terbaik kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($teams as $index => $member)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                        <div class="relative h-80 overflow-hidden">
                            <img src="{{ $member['image'] ? asset('storage/' . $member['image']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400' }}"
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                 alt="{{ $member['name'] }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-full group-hover:translate-y-0 transition-transform">
                                <div class="flex justify-center space-x-3">
                                    @if($member['linkedin_url'])
                                    <a href="{{ $member['linkedin_url'] }}" target="_blank" class="w-10 h-10 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center text-white hover:bg-white hover:text-blue-600 transition">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    @endif
                                    @if($member['instagram_url'])
                                    <a href="{{ $member['instagram_url'] }}" target="_blank" class="w-10 h-10 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center text-white hover:bg-white hover:text-pink-600 transition">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="text-xl font-bold text-gray-900 mb-1">{{ $member['name'] }}</h4>
                            <p class="text-primary-600 font-medium">{{ $member['role'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 rounded-[3rem] p-12 md:p-16 text-center relative overflow-hidden" data-aos="zoom-in">
                <div class="absolute inset-0">
                    <div class="absolute top-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mt-24 blur-2xl"></div>
                    <div class="absolute bottom-0 right-0 w-64 h-64 bg-secondary-400/20 rounded-full -mr-32 -mb-32 blur-2xl"></div>
                </div>
                
                <div class="relative">
                    <span class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-medium mb-6">
                        <i class="fas fa-rocket mr-2"></i> Mulai Petualangan
                    </span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">Siap Untuk Petualangan?</h2>
                    <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                        Mari jelajahi keindahan Indonesia bersama Endah Travel. Pengalaman tak terlupakan menanti Anda!
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('armada') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-700 rounded-2xl font-bold hover:bg-gray-100 transition shadow-xl">
                            <i class="fas fa-bus mr-2"></i> Lihat Armada
                        </a>
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-white/20 backdrop-blur text-white border-2 border-white/50 rounded-2xl font-bold hover:bg-white/30 transition">
                            <i class="fas fa-phone mr-2"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

