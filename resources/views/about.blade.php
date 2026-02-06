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
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <span class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-6">
                        <i class="fas fa-history mr-2"></i> Cerita Kami
                    </span>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-6">
                        Siapa <span class="gradient-text">Kami?</span>
                    </h2>
                    <div class="space-y-4 text-gray-600 text-lg">
                        <p>
                            <strong class="text-primary-600">Endah Travel</strong> adalah perusahaan jasa perjalanan wisata yang didirikan pada tahun 2015 dengan satu misi sederhana: memberikan pengalaman perjalanan yang tak terlupakan.
                        </p>
                        <p>
                            Dengan tim yang berpengalaman dan armada yang terawat, kami telah melayani lebih dari <strong>10.000 pelanggan</strong> dari berbagai kota di Indonesia.
                        </p>
                        <p>
                            Kami menyediakan berbagai paket wisata menarik ke destinasi-destinasi populer di Indonesia, mulai dari wisata alam, budaya, hingga adventure. Setiap paket dirancang dengan cermat untuk memberikan pengalaman terbaik.
                        </p>
                    </div>
                    
                    <!-- Features -->
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="flex items-center p-4 bg-gray-50 rounded-2xl">
                            <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-check text-primary-600"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Harga Transparan</span>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-2xl">
                            <div class="w-10 h-10 bg-secondary-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-check text-secondary-600"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Guide Profesional</span>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-2xl">
                            <div class="w-10 h-10 bg-secondary-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-check text-secondary-600"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Armada Terawat</span>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-2xl">
                            <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-check text-primary-600"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Layanan 24/7</span>
                        </div>
                    </div>
                </div>
                
                <div class="relative" data-aos="fade-left">
                    <div class="grid grid-cols-2 gap-4">
                        <img src="https://images.unsplash.com/photo-1527631746610-bca00a040d60?w=400" 
                             alt="Travel" class="rounded-3xl shadow-2xl w-full h-64 object-cover">
                        <img src="https://images.unsplash.com/photo-1488085061387-422e29b40080?w=400" 
                             alt="Travel" class="rounded-3xl shadow-2xl w-full h-64 object-cover mt-12">
                        <img src="https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=400" 
                             alt="Travel" class="rounded-3xl shadow-2xl w-full h-64 object-cover -mt-8">
                        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400" 
                             alt="Travel" class="rounded-3xl shadow-2xl w-full h-64 object-cover mt-4">
                    </div>
                    
                    <!-- Experience Badge -->
                    <div class="absolute -bottom-6 -left-6 bg-gradient-to-br from-primary-600 to-primary-800 text-white p-6 rounded-3xl shadow-2xl shadow-primary-500/30">
                        <div class="text-4xl font-extrabold">10+</div>
                        <div class="text-sm opacity-90">Tahun Pengalaman</div>
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
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-gem mr-2"></i> Core Values
                </span>
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Prinsip yang kami pegang teguh dalam setiap pelayanan</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['icon' => 'fa-handshake', 'title' => 'Kepercayaan', 'desc' => 'Membangun kepercayaan melalui transparansi dan integritas', 'color' => 'primary'],
                    ['icon' => 'fa-award', 'title' => 'Kualitas', 'desc' => 'Selalu memberikan layanan dengan standar kualitas tinggi', 'color' => 'secondary'],
                    ['icon' => 'fa-heart', 'title' => 'Kepedulian', 'desc' => 'Peduli terhadap kebutuhan dan kepuasan setiap pelanggan', 'color' => 'accent'],
                    ['icon' => 'fa-lightbulb', 'title' => 'Inovasi', 'desc' => 'Terus berinovasi untuk pengalaman perjalanan lebih baik', 'color' => 'primary'],
                ] as $index => $value)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100 text-center h-full hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-br from-{{ $value['color'] }}-400 to-{{ $value['color'] }}-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-{{ $value['color'] }}-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas {{ $value['icon'] }} text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $value['title'] }}</h3>
                        <p class="text-gray-600">{{ $value['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600"></div>
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-secondary-400/20 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach([
                    ['number' => '10+', 'label' => 'Tahun Pengalaman', 'icon' => 'fa-calendar-alt'],
                    ['number' => $stats['destinations'], 'label' => 'Destinasi Wisata', 'icon' => 'fa-map-marker-alt'],
                    ['number' => $stats['customers'] . '+', 'label' => 'Pelanggan Puas', 'icon' => 'fa-users'],
                    ['number' => $stats['packages'] . '+', 'label' => 'Paket Wisata', 'icon' => 'fa-suitcase'],
                ] as $index => $stat)
                <div class="text-center text-white" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas {{ $stat['icon'] }} text-2xl"></i>
                    </div>
                    <div class="text-5xl font-extrabold mb-2">{{ $stat['number'] }}</div>
                    <div class="text-lg text-white/80">{{ $stat['label'] }}</div>
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
                        <a href="{{ route('packages.index') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-700 rounded-2xl font-bold hover:bg-gray-100 transition shadow-xl">
                            <i class="fas fa-compass mr-2"></i> Lihat Paket Wisata
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

