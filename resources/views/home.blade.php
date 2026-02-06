@extends('layouts.app')

@section('title', 'Endah Travel - Perjalanan Wisata Terpercaya')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden">
        <!-- Background Image with Parallax Effect -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                 alt="Beautiful Indonesia Landscape" 
                 class="w-full h-full object-cover scale-105">
        </div>
        <div class="hero-gradient absolute inset-0"></div>
        
        <!-- Animated Decorations -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-1/4 right-1/4 animate-float hidden lg:block">
            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                <i class="fas fa-plane text-white text-2xl"></i>
            </div>
        </div>
        <div class="absolute bottom-1/3 left-1/4 animate-float hidden lg:block" style="animation-delay: 1s;">
            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                <i class="fas fa-umbrella-beach text-white text-xl"></i>
            </div>
        </div>
        <div class="absolute top-1/3 left-1/6 animate-float hidden lg:block" style="animation-delay: 2s;">
            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                <i class="fas fa-camera text-white text-lg"></i>
            </div>
        </div>
        
        <!-- Hero Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-3xl" data-aos="fade-up">
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full mb-6">
                    <span class="w-2 h-2 bg-secondary-400 rounded-full animate-pulse mr-2"></span>
                    <span class="text-sm font-medium">Trusted by 10,000+ Happy Travelers</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                    Jelajahi Keindahan
                    <span class="block mt-2">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-300 via-primary-400 to-secondary-300">
                            Indonesia
                        </span>
                    </span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/90 mb-10 leading-relaxed max-w-2xl">
                    Perjalanan wisata nyaman, aman, dan tak terlupakan. Wujudkan liburan impian Anda bersama Endah Travel.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('packages.index') }}" 
                       class="group inline-flex items-center justify-center bg-white text-primary-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <i class="fas fa-compass mr-3 group-hover:rotate-45 transition-transform duration-300"></i> 
                        Explore Paket Wisata
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Travel,%20saya%20ingin%20bertanya%20tentang%20paket%20wisata" target="_blank"
                       class="group inline-flex items-center justify-center bg-secondary-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-secondary-600 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <i class="fab fa-whatsapp mr-3 text-xl"></i> 
                        Chat Sekarang
                    </a>
                </div>
                
                <!-- Trust Badges -->
                <div class="mt-12 flex flex-wrap items-center gap-8">
                    <div class="flex items-center text-white/80">
                        <div class="flex -space-x-2">
                            <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full border-2 border-white" alt="">
                            <img src="https://i.pravatar.cc/40?img=2" class="w-10 h-10 rounded-full border-2 border-white" alt="">
                            <img src="https://i.pravatar.cc/40?img=3" class="w-10 h-10 rounded-full border-2 border-white" alt="">
                            <img src="https://i.pravatar.cc/40?img=4" class="w-10 h-10 rounded-full border-2 border-white" alt="">
                        </div>
                        <span class="ml-3 text-sm">10K+ Travelers</span>
                    </div>
                    <div class="flex items-center text-white/80">
                        <i class="fas fa-star text-secondary-400 mr-2"></i>
                        <span class="text-sm"><strong>4.9</strong> (2.5K Reviews)</span>
                    </div>
                    <div class="flex items-center text-white/80">
                        <i class="fas fa-shield-alt text-secondary-400 mr-2"></i>
                        <span class="text-sm">100% Aman & Terpercaya</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#search" class="text-white/70 hover:text-white transition">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- Quick Search -->
    <section id="search" class="relative -mt-20 z-20 pb-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass rounded-3xl shadow-2xl p-8 border border-white/20" data-aos="fade-up">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Temukan Paket Wisata Impian Anda</h2>
                    <p class="text-gray-600 mt-1">Cari berdasarkan destinasi, budget, atau nama paket</p>
                </div>
                <form action="{{ route('packages.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-search text-primary-500 mr-1"></i> Cari Paket
                        </label>
                        <input type="text" name="search" placeholder="Ketik nama paket..." 
                               class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-secondary-500 mr-1"></i> Destinasi
                        </label>
                        <select name="destination" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all appearance-none cursor-pointer">
                            <option value="">Semua Destinasi</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-wallet text-primary-500 mr-1"></i> Budget
                        </label>
                        <select name="max_price" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all appearance-none cursor-pointer">
                            <option value="">Semua Harga</option>
                            <option value="2000000">< Rp 2 Juta</option>
                            <option value="5000000">< Rp 5 Juta</option>
                            <option value="10000000">< Rp 10 Juta</option>
                            <option value="20000000">< Rp 20 Juta</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full btn-gradient text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl">
                            <i class="fas fa-search mr-2"></i> Cari Paket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white pattern-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-primary-500/30">
                        <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                    </div>
                    <div class="text-4xl font-extrabold gradient-text mb-1">{{ $stats['destinations'] }}+</div>
                    <div class="text-gray-600 font-medium">Destinasi</div>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-secondary-500/30">
                        <i class="fas fa-suitcase-rolling text-white text-2xl"></i>
                    </div>
                    <div class="text-4xl font-extrabold gradient-text mb-1">{{ $stats['packages'] }}+</div>
                    <div class="text-gray-600 font-medium">Paket Wisata</div>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-primary-500/30">
                        <i class="fas fa-smile-beam text-white text-2xl"></i>
                    </div>
                    <div class="text-4xl font-extrabold gradient-text mb-1">{{ $stats['customers'] }}+</div>
                    <div class="text-gray-600 font-medium">Pelanggan Puas</div>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-primary-500/30">
                        <i class="fas fa-award text-white text-2xl"></i>
                    </div>
                    <div class="text-4xl font-extrabold gradient-text mb-1">10+</div>
                    <div class="text-gray-600 font-medium">Tahun Pengalaman</div>
                </div>
            </div>
        </div>
    </section>



    <!-- Why Choose Us -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary-500/5 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-secondary-100 text-secondary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-award mr-1"></i> KENAPA KAMI
                </span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Mengapa Memilih <span class="gradient-text">Endah Travel?</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami berkomitmen memberikan layanan terbaik untuk setiap perjalanan wisata Anda
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-8 bg-gradient-to-br from-primary-50 to-primary-100 rounded-3xl card-hover" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-primary-500/30 transform -rotate-6">
                        <i class="fas fa-shield-alt text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Aman & Terpercaya</h3>
                    <p class="text-gray-600 leading-relaxed">Armada terawat dan driver profesional untuk keselamatan perjalanan Anda</p>
                </div>
                
                <div class="text-center p-8 bg-gradient-to-br from-secondary-50 to-secondary-100 rounded-3xl card-hover" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 bg-gradient-to-br from-secondary-500 to-secondary-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-secondary-500/30 transform rotate-6">
                        <i class="fas fa-tags text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Harga Terjangkau</h3>
                    <p class="text-gray-600 leading-relaxed">Paket wisata dengan harga kompetitif tanpa mengurangi kualitas</p>
                </div>
                
                <div class="text-center p-8 bg-gradient-to-br from-secondary-50 to-secondary-100 rounded-3xl card-hover" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-secondary-500/30 transform -rotate-6">
                        <i class="fas fa-headset text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Layanan 24/7</h3>
                    <p class="text-gray-600 leading-relaxed">Tim support siap membantu kapan saja selama perjalanan wisata</p>
                </div>
                
                <div class="text-center p-8 bg-gradient-to-br from-primary-50 to-primary-100 rounded-3xl card-hover" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-primary-500/30 transform rotate-6">
                        <i class="fas fa-star text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pengalaman Terbaik</h3>
                    <p class="text-gray-600 leading-relaxed">Itinerary menarik dan destinasi pilihan untuk kenangan indah</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Unggulan Section -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-secondary-100 text-secondary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-star mr-1"></i> PILIHAN TERBAIK
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Paket <span class="gradient-text">Unggulan</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Paket wisata pilihan dengan kualitas terbaik dari Endah Trans
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Paket Unggulan akan diload dari database -->
                @forelse($featuredPackages as $package)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden card-hover border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up">
                    <!-- Image -->
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $package->image_url }}" alt="{{ $package->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                             onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        
                        <!-- Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 bg-secondary-500 text-white text-xs font-bold rounded-full shadow-lg">
                                <i class="fas fa-star mr-1"></i> UNGGULAN
                            </span>
                        </div>
                        
                        <!-- Diskon -->
                        @if($package->discount_price)
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-2 py-1 bg-primary-600 text-white text-xs font-bold rounded shadow-lg">
                                    DISKON {{ $package->discount_percent }}%
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5">
                        <p class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-map-marker-alt text-primary-500 mr-1"></i>
                            {{ $package->destination->name }}
                        </p>
                        <h3 class="font-bold text-gray-900 line-clamp-2 mb-2">{{ $package->name }}</h3>
                        
                        <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                            <span><i class="fas fa-clock text-primary-500 mr-1"></i> {{ $package->duration_days }} Hari</span>
                            <span><i class="fas fa-users text-primary-500 mr-1"></i> {{ $package->max_person }} Org</span>
                        </div>
                        
                        <!-- Price -->
                        @if($package->discount_price)
                            <div class="mb-4">
                                <p class="text-lg font-bold text-primary-600">Rp {{ number_format($package->discount_price, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-400 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                            </div>
                        @else
                            <p class="text-lg font-bold text-gray-900 mb-4">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        @endif
                        
                        <a href="{{ route('booking.create', $package->slug) }}" 
                           class="w-full inline-flex items-center justify-center btn-gradient text-white py-3 rounded-xl font-bold transition-all hover:shadow-lg">
                            Pesan Sekarang <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="md:col-span-3 text-center py-8">
                    <p class="text-gray-500">Paket unggulan sedang dipersiapkan...</p>
                </div>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('popular-routes') }}" 
                   class="inline-flex items-center px-8 py-4 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition shadow-lg">
                    Lihat Semua Paket Unggulan <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    @if($testimonials->count() > 0)
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-br from-primary-500/5 via-secondary-500/5 to-primary-500/5 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-heart mr-1"></i> TESTIMONIAL
                </span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    Apa Kata <span class="gradient-text">Pelanggan Kami?</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Ribuan pelanggan puas telah mempercayakan perjalanan mereka kepada kami
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $index => $testimonial)
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 card-hover" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <!-- Rating Stars -->
                    <div class="flex items-center mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-primary-400' : 'text-gray-200' }} text-lg"></i>
                        @endfor
                        <span class="ml-2 text-sm text-gray-500">({{ $testimonial->rating }}.0)</span>
                    </div>
                    
                    <!-- Quote -->
                    <div class="relative mb-6">
                        <i class="fas fa-quote-left text-4xl text-primary-100 absolute -top-2 -left-2"></i>
                        <p class="text-gray-600 leading-relaxed relative z-10 pl-6">{{ $testimonial->content }}</p>
                    </div>
                    
                    <!-- Author -->
                    <div class="flex items-center pt-6 border-t border-gray-100">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&background=6366f1&color=fff&bold=true" 
                             alt="{{ $testimonial->name }}" 
                             class="w-14 h-14 rounded-2xl object-cover shadow-lg">
                        <div class="ml-4">
                            <div class="font-bold text-gray-900">{{ $testimonial->name }}</div>
                            @if($testimonial->location)
                                <div class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-map-marker-alt text-primary-500 mr-1"></i> {{ $testimonial->location }}
                                </div>
                            @endif
                        </div>
                        <div class="ml-auto">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-700"></div>
        <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920'); background-size: cover; background-position: center; opacity: 0.15;"></div>
        
        <!-- Decorative Blobs -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div data-aos="zoom-in">
                <div class="inline-flex items-center bg-white/20 backdrop-blur text-white px-4 py-2 rounded-full mb-6">
                    <i class="fas fa-gift mr-2"></i>
                    <span class="font-medium">Dapatkan Promo Spesial Hingga 30%</span>
                </div>
                
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
                    Siap Untuk Petualangan<br>
                    <span class="text-primary-300">Berikutnya?</span>
                </h2>
                
                <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Hubungi kami sekarang untuk mendapatkan penawaran terbaik dan wujudkan liburan impian Anda!
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('packages.index') }}" 
                       class="group inline-flex items-center justify-center bg-white text-primary-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <i class="fas fa-compass mr-3 group-hover:rotate-45 transition-transform"></i> 
                        Jelajahi Paket
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Travel,%20saya%20tertarik%20dengan%20paket%20wisata" target="_blank"
                       class="group inline-flex items-center justify-center bg-secondary-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-secondary-600 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <i class="fab fa-whatsapp mr-3 text-2xl"></i> 
                        Chat via WhatsApp
                    </a>
                </div>
                
                <!-- Contact Info -->
                <div class="mt-12 flex flex-wrap justify-center gap-8 text-white/80">
                    <div class="flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span>+62 812-3456-7890</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>info@endahtravel.com</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>Sen-Sab: 08:00 - 17:00</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Harga Terbaik Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-tag mr-1"></i> HARGA TERBAIK
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Paket Dengan Harga <span class="gradient-text">Termurah</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Nikmati perjalanan nyaman dengan harga yang paling terjangkau
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach(['Big Bus', 'Medium Bus'] as $busType)
                <div class="group bg-gradient-to-br from-primary-50 to-secondary-50 rounded-2xl shadow-lg overflow-hidden card-hover border-2 border-primary-100 p-8" data-aos="fade-up">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                <i class="fas fa-bus text-primary-600 mr-2"></i> {{ $busType }}
                            </h3>
                            <p class="text-gray-600">Kapasitas {{ $busType === 'Big Bus' ? '40' : '35' }} penumpang</p>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-md">
                            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 mb-6">
                        <p class="text-sm text-gray-500 mb-1">Mulai dari harga</p>
                        <p class="text-3xl font-bold text-primary-600">
                            Rp <span class="text-2xl">{{ $busType === 'Big Bus' ? '2.000.000' : '1.800.000' }}</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-2">Per bus per malam</p>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3 font-bold"></i>
                            <span>AC + WiFi Gratis</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3 font-bold"></i>
                            <span>Driver Profesional</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3 font-bold"></i>
                            <span>Asuransi Perjalanan</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3 font-bold"></i>
                            <span>Fleksibel Tanggal</span>
                        </div>
                    </div>

                    <a href="{{ route('packages.index') }}" 
                       class="w-full inline-flex items-center justify-center bg-gradient-to-r from-primary-600 to-primary-700 text-white py-3 rounded-xl font-bold transition-all hover:shadow-lg hover:-translate-y-1">
                        Pesan Sekarang <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Google Maps Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12" data-aos="fade-up">
                <div class="inline-flex items-center bg-primary-100 text-primary-700 px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span class="text-sm font-semibold">Lokasi Kami</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Kunjungi Kantor Endah Trans
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Lokasi strategis di pusat kota, mudah diakses dari berbagai tempat. Kunjungi kantor kami untuk konsultasi dan pemesanan paket wisata.
                </p>
            </div>

            <!-- Maps Container -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                <!-- Maps Embed -->
                <div class="lg:col-span-2" data-aos="fade-right">
                    <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-primary-100 h-96 lg:h-96">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.200488506536!2d110.750231!3d-6.7453843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70ddc096dc10ad%3A0xef6083aef28b357b!2sPo.Endah%20Trans%20Jepara!5e0!3m2!1sid!2sid!4v1769998406551!5m2!1sid!2sid" 
                                width="100%" 
                                height="100%" 
                                style="border:0; min-height: 384px;" 
                                allowfullscreen="" 
                                loading="lazy"
                                allow="geolocation"
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="lg:col-span-1" data-aos="fade-left">
                    <div class="bg-gradient-to-br from-primary-600 to-primary-700 text-white rounded-2xl p-8 shadow-xl">
                        <h3 class="text-2xl font-bold mb-6">
                            <i class="fas fa-map-location-dot mr-2"></i> Informasi Lokasi
                        </h3>

                        <!-- Address -->
                        <div class="mb-6 pb-6 border-b border-white/20">
                            <p class="text-sm text-white/70 mb-2 font-semibold">ALAMAT</p>
                            <p class="text-base font-semibold">Jl. Raya Jepara - Kudus, Rw. 03<br>Pelang, Kec. Mayong<br>Kabupaten Jepara, Jawa Tengah</p>
                        </div>

                        <!-- Phone -->
                        <div class="mb-6 pb-6 border-b border-white/20">
                            <p class="text-sm text-white/70 mb-2 font-semibold">TELEPON</p>
                            <a href="tel:+6281234567890" class="text-lg font-semibold hover:text-primary-200 transition">
                                <i class="fas fa-phone-alt mr-2"></i> +62 812-3456-7890
                            </a>
                        </div>

                        <!-- Email -->
                        <div class="mb-6 pb-6 border-b border-white/20">
                            <p class="text-sm text-white/70 mb-2 font-semibold">EMAIL</p>
                            <a href="mailto:info@endahtravel.com" class="text-lg font-semibold hover:text-primary-200 transition">
                                <i class="fas fa-envelope mr-2"></i> info@endahtravel.com
                            </a>
                        </div>

                        <!-- Operating Hours -->
                        <div class="mb-6">
                            <p class="text-sm text-white/70 mb-3 font-semibold">JAM OPERASIONAL</p>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-semibold">Senin - Jumat:</span> 08:00 - 17:00 WIB</p>
                                <p><span class="font-semibold">Sabtu:</span> 09:00 - 14:00 WIB</p>
                                <p><span class="font-semibold">Minggu:</span> Tutup</p>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="space-y-3 mt-8">
                            <a href="https://maps.app.goo.gl/SQ1EFkbtUonSbyha7?g_st=aw" target="_blank"
                               class="w-full inline-flex items-center justify-center bg-white text-primary-600 py-3 rounded-xl font-bold hover:bg-gray-100 transition-all hover:shadow-lg">
                                <i class="fas fa-directions mr-2"></i> Lihat di Google Maps
                            </a>
                            <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Travel,%20saya%20ingin%20bertanya%20tentang%20lokasi%20dan%20jam%20operasional" target="_blank"
                               class="w-full inline-flex items-center justify-center bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition-all hover:shadow-lg">
                                <i class="fab fa-whatsapp mr-2"></i> Hubungi WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

