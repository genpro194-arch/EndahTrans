@extends('layouts.admin')

@section('title', 'Kelola Paket Wisata')
@section('page-title', 'Paket Wisata')
@section('page-subtitle', 'Kelola semua paket wisata Anda')

@section('content')
    <!-- Header with Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="md:col-span-2 bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-6 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
            <div class="relative">
                <h3 class="text-lg font-semibold mb-1">Total Paket</h3>
                <p class="text-4xl font-extrabold mb-2">{{ $packages->total() }}</p>
                <p class="text-primary-200 text-sm">Paket wisata tersedia</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <span class="text-gray-500 text-sm">Aktif</span>
                <div class="w-8 h-8 bg-secondary-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check text-secondary-600 text-sm"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Package::where('is_active', true)->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-2">
                <span class="text-gray-500 text-sm">Unggulan</span>
                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-primary-600 text-sm"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Package::where('is_featured', true)->count() }}</p>
        </div>
    </div>

    <!-- Action Button & Filters -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-gray-100">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
            <h3 class="text-lg font-bold text-gray-900">
                <i class="fas fa-list text-primary-500 mr-2"></i> Daftar Paket
            </h3>
            <a href="{{ route('admin.packages.create') }}" 
               class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-700 hover:to-primary-800 transition shadow-lg shadow-primary-500/30">
                <i class="fas fa-plus mr-2"></i> Tambah Paket Baru
            </a>
        </div>
        
        <form action="{{ route('admin.packages.index') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari nama paket wisata..."
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <select name="destination" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        <option value="">📍 Semua Destinasi</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ request('destination') == $destination->id ? 'selected' : '' }}>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-40">
                    <select name="status" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>✅ Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>⛔ Nonaktif</option>
                    </select>
                </div>
                <button type="submit" class="w-full md:w-auto bg-gray-800 text-white px-6 py-3 rounded-xl hover:bg-gray-900 transition font-semibold">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Packages Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($packages as $package)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 group hover:shadow-xl transition-all duration-300">
            <!-- Image -->
            <div class="relative h-48 overflow-hidden">
                <img src="{{ $package->image_url }}" alt="{{ $package->name }}" 
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                     onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                
                <!-- Badges -->
                <div class="absolute top-3 left-3 flex gap-2">
                    @if($package->is_featured)
                        <span class="px-3 py-1 bg-primary-500 text-white text-xs font-bold rounded-full shadow">
                            <i class="fas fa-star mr-1"></i> Unggulan
                        </span>
                    @endif
                    @if($package->discount_price)
                        <span class="px-3 py-1 bg-primary-600 text-white text-xs font-bold rounded-full shadow">
                            PROMO
                        </span>
                    @endif
                </div>
                
                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    @if($package->is_active)
                        <span class="px-3 py-1 bg-secondary-500 text-white text-xs font-bold rounded-full shadow">Aktif</span>
                    @else
                        <span class="px-3 py-1 bg-primary-500 text-white text-xs font-bold rounded-full shadow">Nonaktif</span>
                    @endif
                </div>
                
                <!-- Price -->
                <div class="absolute bottom-3 left-3">
                    @if($package->discount_price)
                        <span class="text-xs text-white/70 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                        <p class="text-lg font-bold text-white">Rp {{ number_format($package->discount_price, 0, ',', '.') }}</p>
                    @else
                        <p class="text-lg font-bold text-white">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                    @endif
                </div>
            </div>
            
            <!-- Content -->
            <div class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-bold text-gray-900 line-clamp-1 mb-1">{{ $package->name }}</h3>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt text-primary-500 mr-1"></i>
                            {{ $package->destination->name }}
                        </p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <span><i class="fas fa-clock mr-1"></i> {{ $package->duration_days }} Hari</span>
                    <span><i class="fas fa-users mr-1"></i> {{ $package->min_person ?? 1 }}-{{ $package->max_person ?? 20 }} Org</span>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                    <a href="{{ route('packages.show', $package->slug) }}" target="_blank" 
                       class="flex-1 py-2.5 text-center text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 rounded-xl transition text-sm font-semibold">
                        <i class="fas fa-external-link-alt mr-1"></i> Preview
                    </a>
                    <a href="{{ route('admin.packages.edit', $package) }}" 
                       class="flex-1 py-2.5 text-center text-primary-600 hover:text-primary-700 bg-primary-50 hover:bg-primary-100 rounded-xl transition text-sm font-semibold">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="flex-none"
                          onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-10 h-10 flex items-center justify-center text-red-600 hover:text-white bg-red-50 hover:bg-red-500 rounded-xl transition">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="md:col-span-3 bg-white rounded-2xl p-16 text-center border border-gray-100">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-suitcase-rolling text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Paket</h3>
            <p class="text-gray-500 mb-6">Mulai tambahkan paket wisata pertama Anda</p>
            <a href="{{ route('admin.packages.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Paket Baru
            </a>
        </div>
        @endforelse
    </div>

    @if($packages->hasPages())
    <div class="mt-8">
        {{ $packages->withQueryString()->links() }}
    </div>
    @endif
@endsection

