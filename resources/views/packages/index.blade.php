@extends('layouts.app')

@section('title', 'Paket Wisata - Endah Travel')

@section('content')
    <!-- Page Header -->
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-700"></div>
        <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1920'); background-size: cover; background-position: center; opacity: 0.2;"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white" data-aos="fade-up">
                <span class="inline-block bg-white/20 backdrop-blur text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-suitcase-rolling mr-2"></i>{{ $packages->total() }} Paket Tersedia
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Paket Wisata</h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto">
                    Temukan paket perjalanan terbaik yang sesuai dengan keinginan dan budget Anda
                </p>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Filters Sidebar -->
                <div class="lg:w-1/4" data-aos="fade-right">
                    <div class="bg-white rounded-3xl shadow-xl p-6 sticky top-24 border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-sliders-h text-primary-600"></i>
                                </div>
                                Filter
                            </h3>
                            @if(request()->hasAny(['search', 'destination', 'max_price', 'duration', 'sort']))
                                <a href="{{ route('packages.index') }}" class="text-sm text-red-500 hover:text-red-600 font-medium">
                                    <i class="fas fa-times mr-1"></i> Reset
                                </a>
                            @endif
                        </div>
                        
                        <form action="{{ route('packages.index') }}" method="GET" class="space-y-5">
                            <!-- Search -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-search text-primary-500 mr-1"></i> Cari
                                </label>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Ketik nama paket..."
                                       class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all">
                            </div>

                            <!-- Destination -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt text-secondary-500 mr-1"></i> Destinasi
                                </label>
                                <select name="destination" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all appearance-none cursor-pointer">
                                    <option value="">Semua Destinasi</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}" {{ request('destination') == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-wallet text-primary-500 mr-1"></i> Budget Maksimal
                                </label>
                                <select name="max_price" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all appearance-none cursor-pointer">
                                    <option value="">Semua Harga</option>
                                    <option value="2000000" {{ request('max_price') == '2000000' ? 'selected' : '' }}>< Rp 2.000.000</option>
                                    <option value="5000000" {{ request('max_price') == '5000000' ? 'selected' : '' }}>< Rp 5.000.000</option>
                                    <option value="10000000" {{ request('max_price') == '10000000' ? 'selected' : '' }}>< Rp 10.000.000</option>
                                    <option value="20000000" {{ request('max_price') == '20000000' ? 'selected' : '' }}>< Rp 20.000.000</option>
                                </select>
                            </div>

                            <!-- Duration -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-clock text-primary-500 mr-1"></i> Durasi
                                </label>
                                <select name="duration" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all appearance-none cursor-pointer">
                                    <option value="">Semua Durasi</option>
                                    <option value="1" {{ request('duration') == '1' ? 'selected' : '' }}>1 Hari</option>
                                    <option value="2" {{ request('duration') == '2' ? 'selected' : '' }}>2 Hari</option>
                                    <option value="3" {{ request('duration') == '3' ? 'selected' : '' }}>3 Hari</option>
                                    <option value="4" {{ request('duration') == '4' ? 'selected' : '' }}>4+ Hari</option>
                                </select>
                            </div>

                            <!-- Sort -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-sort text-primary-500 mr-1"></i> Urutkan
                                </label>
                                <select name="sort" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all appearance-none cursor-pointer">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full btn-gradient text-white py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all">
                                <i class="fas fa-search mr-2"></i> Terapkan Filter
                            </button>
                        </form>
                        
                        <!-- Quick Stats -->
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <h4 class="text-sm font-semibold text-gray-500 mb-3">STATISTIK</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Total Paket</span>
                                    <span class="font-bold text-primary-600">{{ $packages->total() }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Destinasi</span>
                                    <span class="font-bold text-primary-600">{{ $destinations->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package List -->
                <div class="lg:w-3/4">
                    @if($packages->count() > 0)
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 bg-white rounded-2xl p-4 shadow-sm" data-aos="fade-up">
                            <p class="text-gray-600">
                                Menampilkan <span class="font-semibold text-gray-900">{{ $packages->firstItem() }}-{{ $packages->lastItem() }}</span> dari 
                                <span class="font-semibold text-gray-900">{{ $packages->total() }}</span> paket
                            </p>
                            @if(request()->hasAny(['search', 'destination', 'max_price', 'duration']))
                                <div class="flex flex-wrap gap-2">
                                    @if(request('search'))
                                        <span class="inline-flex items-center bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm">
                                            <i class="fas fa-search mr-1"></i> "{{ request('search') }}"
                                        </span>
                                    @endif
                                    @if(request('destination'))
                                        <span class="inline-flex items-center bg-secondary-100 text-secondary-700 px-3 py-1 rounded-full text-sm">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $destinations->find(request('destination'))->name ?? '' }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach($packages as $index => $package)
                            <a href="{{ route('packages.show', $package->slug) }}" class="group bg-white rounded-3xl shadow-lg overflow-hidden card-hover border border-gray-100 block" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 50 }}">
                                <div class="relative h-52 overflow-hidden">
                                    @if($package->image_url)
                                    <img src="{{ $package->image_url }}" alt="{{ $package->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                         onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400'">
                                    @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary-400 to-secondary-500 flex items-center justify-center">
                                        <i class="fas fa-mountain text-white/50 text-5xl"></i>
                                    </div>
                                    @endif
                                    
                                    <!-- Overlay on Hover -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    
                                    @if($package->discount_price)
                                    <div class="absolute top-4 left-4 bg-gradient-to-r from-secondary-500 to-secondary-600 text-white px-3 py-1.5 rounded-full text-sm font-bold shadow-lg">
                                        <i class="fas fa-bolt mr-1"></i> -{{ $package->discount_percent }}%
                                    </div>
                                    @endif
                                    
                                    @if($package->is_featured)
                                    <div class="absolute top-4 right-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white px-3 py-1.5 rounded-full text-sm font-bold shadow-lg">
                                        <i class="fas fa-star mr-1"></i> Best
                                    </div>
                                    @endif
                                    
                                    <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <span class="bg-white/90 backdrop-blur px-3 py-1.5 rounded-full text-sm font-semibold text-gray-700">
                                            <i class="fas fa-clock text-primary-500 mr-1"></i> {{ $package->duration_days }}D/{{ $package->duration_nights }}N
                                        </span>
                                        <span class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg group-hover:bg-primary-500 group-hover:text-white transition-colors">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-5">
                                    <div class="flex items-center mb-3">
                                        <span class="inline-flex items-center bg-secondary-50 text-secondary-600 px-3 py-1 rounded-full text-xs font-semibold">
                                            <i class="fas fa-map-marker-alt mr-1.5"></i>
                                            {{ $package->destination->name ?? 'Indonesia' }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                        {{ $package->name }}
                                    </h3>
                                    
                                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ Str::limit($package->description, 80) }}</p>
                                    
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div>
                                            @if($package->discount_price)
                                                <span class="text-xs text-gray-400 line-through block">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                                <div class="text-xl font-extrabold text-primary-600">Rp {{ number_format($package->discount_price, 0, ',', '.') }}</div>
                                            @else
                                                <div class="text-xl font-extrabold text-primary-600">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                                            @endif
                                            <span class="text-xs text-gray-400">/orang • min {{ $package->min_person ?? 1 }} pax</span>
                                        </div>
                                        <span class="btn-gradient text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-lg">
                                            Detail
                                        </span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-10" data-aos="fade-up">
                            {{ $packages->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-3xl shadow-xl p-12 text-center" data-aos="fade-up">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-search text-4xl text-gray-300"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-2">Tidak Ada Paket Ditemukan</h3>
                            <p class="text-gray-500 mb-6">Coba ubah filter pencarian Anda atau lihat semua paket yang tersedia</p>
                            <a href="{{ route('packages.index') }}" class="inline-flex items-center btn-gradient text-white px-6 py-3 rounded-xl font-semibold">
                                <i class="fas fa-arrow-left mr-2"></i> Lihat Semua Paket
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <div class="bg-gradient-to-br from-primary-500 to-secondary-500 rounded-3xl p-10 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                <div class="relative">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Butuh Paket Custom?</h2>
                    <p class="text-white/90 mb-6">Hubungi kami untuk mendapatkan penawaran paket wisata sesuai keinginan Anda</p>
                    <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Travel,%20saya%20ingin%20konsultasi%20paket%20custom" target="_blank"
                       class="inline-flex items-center bg-white text-primary-600 px-8 py-3 rounded-xl font-bold hover:bg-gray-100 transition-all hover:shadow-lg">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i> Chat Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

