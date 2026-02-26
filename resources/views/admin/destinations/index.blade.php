@extends('layouts.admin')

@section('title', 'Kelola Destinasi')
@section('page-title', 'Destinasi Charter')
@section('page-subtitle', 'Data destinasi yang terhubung ke form pemesanan charter')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <p class="text-sm text-gray-500">{{ $destinations->total() }} destinasi terdaftar</p>
    </div>
    <a href="{{ route('admin.destinations.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm text-white shadow-lg transition hover:-translate-y-0.5"
       style="background:linear-gradient(135deg,#ec4899,#ef4444); box-shadow:0 6px 20px rgba(236,72,153,.3)">
        <i class="fas fa-plus"></i> Tambah Destinasi
    </a>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/60">
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider w-8">#</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Destinasi</th>
                    <th class="text-right px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Sleeper Bus</th>
                    <th class="text-right px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Executive</th>
                    <th class="text-right px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden xl:table-cell">Big Top</th>
                    <th class="text-right px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden xl:table-cell">Super Exec</th>
                    <th class="text-center px-4 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($destinations as $i => $dest)
                @php
                    $priceMap = $dest->prices->pluck('price_per_day', 'fleet_type');
                    $hasPrice = $priceMap->filter(fn($p) => $p > 0)->count();
                @endphp
                <tr class="hover:bg-pink-50/30 transition group">
                    <td class="px-5 py-4 text-gray-400 text-xs">{{ $destinations->firstItem() + $loop->index }}</td>

                    {{-- Name + desc --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                 style="background:linear-gradient(135deg,rgba(236,72,153,.12),rgba(239,68,68,.08))">
                                <i class="fas fa-map-marker-alt text-brand-500 text-xs"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $dest->name }}</p>
                                @if($dest->description)
                                <p class="text-xs text-gray-400 mt-0.5 max-w-xs truncate">{{ $dest->description }}</p>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Price columns --}}
                    @php $fmt = fn($p) => $p > 0 ? 'Rp ' . number_format($p, 0, ',', '.') : '—'; @endphp
                    <td class="px-4 py-4 text-right hidden lg:table-cell">
                        <span class="{{ ($priceMap['eksklusif'] ?? 0) > 0 ? 'font-semibold text-gray-800' : 'text-gray-300' }} text-sm">
                            {{ $fmt($priceMap['eksklusif'] ?? 0) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-right hidden lg:table-cell">
                        <span class="{{ ($priceMap['reguler'] ?? 0) > 0 ? 'font-semibold text-gray-800' : 'text-gray-300' }} text-sm">
                            {{ $fmt($priceMap['reguler'] ?? 0) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-right hidden xl:table-cell">
                        <span class="{{ ($priceMap['bigtop'] ?? 0) > 0 ? 'font-semibold text-gray-800' : 'text-gray-300' }} text-sm">
                            {{ $fmt($priceMap['bigtop'] ?? 0) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-right hidden xl:table-cell">
                        <span class="{{ ($priceMap['superexec'] ?? 0) > 0 ? 'font-semibold text-gray-800' : 'text-gray-300' }} text-sm">
                            {{ $fmt($priceMap['superexec'] ?? 0) }}
                        </span>
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-4 text-center">
                        @if($dest->is_active)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 text-gray-500 text-xs font-semibold rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Nonaktif
                            </span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="px-5 py-4 text-right">
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('admin.destinations.edit', $dest) }}"
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-pink-50 hover:bg-brand-500 text-brand-500 hover:text-white transition text-xs"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.destinations.destroy', $dest) }}" method="POST"
                                  onsubmit="return confirm('Hapus destinasi {{ addslashes($dest->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-500 text-red-500 hover:text-white transition text-xs"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-5 py-20 text-center">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4"
                             style="background:linear-gradient(135deg,rgba(236,72,153,.1),rgba(239,68,68,.07))">
                            <i class="fas fa-map-marker-alt text-2xl text-brand-400"></i>
                        </div>
                        <p class="font-semibold text-gray-700 mb-1">Belum ada destinasi</p>
                        <p class="text-sm text-gray-400 mb-5">Tambahkan destinasi agar muncul di form charter</p>
                        <a href="{{ route('admin.destinations.create') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white"
                           style="background:linear-gradient(135deg,#ec4899,#ef4444)">
                            <i class="fas fa-plus"></i> Tambah Sekarang
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Legend --}}
<div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-gray-400 px-1">
    <span class="flex items-center gap-1.5">
        <i class="fas fa-info-circle text-brand-300"></i>
        Harga per bus per hari · <span class="hidden lg:inline">Harga charter otomatis tampil di form pemesanan website saat destinasi dipilih</span><span class="lg:hidden">Harga muncul otomatis di form pemesanan</span>
    </span>
</div>

@if($destinations->hasPages())
<div class="mt-5">{{ $destinations->links() }}</div>
@endif

@endsection

@section('content')
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">
                    <i class="fas fa-map-marked-alt text-primary-500 mr-2"></i> Daftar Destinasi
                </h3>
                <p class="text-gray-500 mt-1">{{ $destinations->total() }} destinasi tersedia</p>
            </div>
            <a href="{{ route('admin.destinations.create') }}" 
               class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-primary-500 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-600 hover:to-primary-800 transition shadow-lg shadow-primary-500/30">
                <i class="fas fa-plus mr-2"></i> Tambah Destinasi
            </a>
        </div>
    </div>

    <!-- Destinations Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($destinations as $destination)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 group hover:shadow-xl transition-all duration-300">
            <!-- Image -->
            <div class="relative h-48 overflow-hidden">
                <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" 
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                     onerror="this.src='https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                
                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    @if($destination->is_active)
                        <span class="px-3 py-1 bg-secondary-500 text-white text-xs font-bold rounded-full shadow">
                            <i class="fas fa-check mr-1"></i> Aktif
                        </span>
                    @else
                        <span class="px-3 py-1 bg-primary-500 text-white text-xs font-bold rounded-full shadow">
                            <i class="fas fa-times mr-1"></i> Nonaktif
                        </span>
                    @endif
                </div>
                
                <!-- Location Name -->
                <div class="absolute bottom-4 left-4 right-4">
                    <h3 class="text-xl font-bold text-white mb-1">{{ $destination->name }}</h3>
                    <div class="flex items-center text-white/80 text-sm">
                        <i class="fas fa-suitcase-rolling mr-2"></i>
                        <span>{{ $destination->packages_count }} Paket Wisata</span>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="p-5">
                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                    {{ Str::limit($destination->description, 100) }}
                </p>
                
                <!-- Stats -->
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-2">
                            <i class="fas fa-box text-primary-600 text-xs"></i>
                        </div>
                        <span>{{ $destination->packages_count }} Paket</span>
                    </div>
                    @if($destination->is_featured ?? false)
                    <div class="flex items-center text-sm text-primary-600">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-2">
                            <i class="fas fa-star text-xs"></i>
                        </div>
                        <span>Unggulan</span>
                    </div>
                    @endif
                </div>
                
                <!-- Actions -->
                <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.destinations.edit', $destination) }}" 
                       class="flex-1 py-2.5 text-center text-primary-600 hover:text-primary-700 bg-primary-50 hover:bg-primary-100 rounded-xl transition text-sm font-semibold">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="flex-none"
                          onsubmit="return confirm('Yakin ingin menghapus destinasi ini? Semua paket terkait juga akan terpengaruh.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-10 h-10 flex items-center justify-center text-red-600 hover:text-white bg-red-50 hover:bg-red-500 rounded-xl transition"
                                {{ $destination->packages_count > 0 ? 'disabled' : '' }}
                                title="{{ $destination->packages_count > 0 ? 'Tidak bisa dihapus karena masih memiliki paket' : 'Hapus destinasi' }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="md:col-span-3 bg-white rounded-2xl p-16 text-center border border-gray-100">
            <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-map-marker-alt text-3xl text-primary-500"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Destinasi</h3>
            <p class="text-gray-500 mb-6">Mulai tambahkan destinasi wisata pertama Anda</p>
            <a href="{{ route('admin.destinations.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Destinasi Baru
            </a>
        </div>
        @endforelse
    </div>

    @if($destinations->hasPages())
    <div class="mt-8">
        {{ $destinations->links() }}
    </div>
    @endif
@endsection

