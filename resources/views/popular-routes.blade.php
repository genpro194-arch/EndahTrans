@extends('layouts.app')

@section('title', 'Rute Terpopuler - Endah Travel')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-primary-600 to-primary-700 text-white py-16 md:py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-48 -mt-48 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-48 -mb-48 blur-3xl"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6">
                <i class="fas fa-route mr-3 text-secondary-300"></i>Rute <span class="text-secondary-300">Terpopuler</span>
            </h1>
            <p class="text-lg md:text-xl text-primary-100 max-w-2xl mx-auto">
                Jelajahi paket wisata pilihan kami yang paling dicari oleh ribuan pelanggan
            </p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-xl mb-4">
                    <i class="fas fa-globe text-2xl text-primary-600"></i>
                </div>
                <p class="text-gray-500 text-sm mb-1">Destinasi Aktif</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['destinations'] }}</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary-100 rounded-xl mb-4">
                    <i class="fas fa-suitcase-rolling text-2xl text-secondary-600"></i>
                </div>
                <p class="text-gray-500 text-sm mb-1">Paket Wisata</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['packages'] }}</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-tertiary-100 rounded-xl mb-4">
                    <i class="fas fa-users text-2xl text-tertiary-600"></i>
                </div>
                <p class="text-gray-500 text-sm mb-1">Pelanggan Puas</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['customers'] }}+</p>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="bg-gray-50 py-8 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-left">
                <p class="text-sm text-gray-500">Menampilkan <span class="font-bold text-gray-900">{{ $popularPackages->count() }}</span> paket unggulan</p>
            </div>
            <div class="w-full md:w-auto">
                <a href="{{ route('packages.index') }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold transition">
                    <i class="fas fa-arrow-left mr-2"></i> Lihat Semua Paket
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Popular Routes Grid -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($popularPackages->count() > 0)
            <div class="mb-8">
                <div class="inline-flex items-center px-4 py-2 bg-secondary-100 text-secondary-700 rounded-full font-semibold">
                    <i class="fas fa-star mr-2"></i>
                    {{ $popularPackages->count() }} Paket Unggulan Admin
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- DEBUG: Total packages = {{ $popularPackages->count() }} -->
                @foreach($popularPackages as $index => $package)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <!-- Image -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $package->image_url }}" alt="{{ $package->name }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                                 onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=500&h=300'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                            
                            <!-- Badge Terpopuler -->
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-4 py-2 bg-secondary-500 text-white text-sm font-bold rounded-full shadow-lg">
                                    <i class="fas fa-fire mr-2"></i> UNGGULAN
                                </span>
                            </div>
                            
                            <!-- Number Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center justify-center w-12 h-12 bg-primary-600 text-white text-lg font-bold rounded-full shadow-lg">
                                    #{{ $loop->iteration }}
                                </span>
                            </div>
                            
                            <!-- Discount Badge -->
                            @if($package->discount_price)
                                <div class="absolute bottom-4 left-4">
                                    <span class="inline-flex items-center px-3 py-1 bg-primary-600 text-white text-xs font-bold rounded-lg shadow-lg">
                                        DISKON {{ $package->discount_percent }}%
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">
                                    <i class="fas fa-map-marker-alt text-primary-500 mr-2"></i>
                                    {{ $package->destination->name }}
                                </p>
                                <h3 class="text-xl font-bold text-gray-900 line-clamp-2 mb-2">{{ $package->name }}</h3>
                                <p class="text-gray-600 text-base line-clamp-2">{{ $package->description }}</p>
                            </div>
                            
                            <!-- Duration & Capacity -->
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4 py-4 border-t border-b border-gray-100">
                                <span class="flex items-center">
                                    <i class="fas fa-clock text-primary-500 mr-2"></i>
                                    {{ $package->duration_days }} Hari
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users text-primary-500 mr-2"></i>
                                    {{ $package->min_person ?? 1 }}-{{ $package->max_person ?? 20 }} Org
                                </span>
                                @if($package->bus_type)
                                    <span class="flex items-center">
                                        <i class="fas fa-bus text-primary-500 mr-2"></i>
                                        <span class="capitalize">{{ $package->bus_type }}</span>
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Price -->
                            <div class="mb-6">
                                @if($package->discount_price)
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-2xl font-bold text-primary-600">Rp {{ number_format($package->discount_price, 0, ',', '.') }}</span>
                                        <span class="text-sm text-gray-400 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                    </div>
                                    <p class="text-xs text-secondary-600 font-semibold mt-1">
                                        Hemat Rp {{ number_format($package->price - $package->discount_price, 0, ',', '.') }}
                                    </p>
                                @else
                                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                @endif
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('packages.show', $package->slug) }}" 
                                   class="w-full py-3 text-center text-gray-600 font-semibold bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                                <a href="{{ route('booking.create', $package->slug) }}" 
                                   class="w-full py-3 text-center text-white font-semibold bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 rounded-xl transition shadow-lg shadow-primary-600/30">
                                    <i class="fas fa-calendar-check mr-1"></i> Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl p-16 text-center shadow-lg border border-gray-100">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <i class="fas fa-star text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Paket Unggulan</h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">
                    Admin belum menandai paket apapun sebagai paket unggulan. Silakan kembali ke admin panel dan klik tombol bintang pada paket yang ingin ditampilkan.
                </p>
                <a href="{{ route('packages.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-lg">
                    <i class="fas fa-arrow-left mr-2"></i> Lihat Semua Paket
                </a>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-primary-600 to-primary-700 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-6">Belum Menemukan Paket Impian?</h2>
        <p class="text-lg text-primary-100 mb-8">Jelajahi semua destinasi dan paket wisata kami dengan berbagai pilihan harga dan durasi</p>
        <a href="{{ route('packages.index') }}" 
           class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-bold rounded-xl hover:bg-gray-50 transition shadow-xl">
            <i class="fas fa-search mr-2"></i> Cari Paket Wisata
        </a>
    </div>
</section>
@endsection
