@extends('layouts.admin')

@section('title', 'Kelola Testimoni')
@section('page-title', 'Testimoni')
@section('page-subtitle', 'Kelola ulasan pelanggan yang ditampilkan di website')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-gray-500">Total: <span class="font-bold text-gray-700">{{ $testimonials->count() }}</span> testimoni
            · Aktif: <span class="font-bold text-green-600">{{ $testimonials->where('is_active', true)->count() }}</span></p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}"
           class="inline-flex items-center px-5 py-2.5 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition shadow-md shadow-primary-500/30">
            <i class="fas fa-plus mr-2"></i> Tambah Testimoni
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse($testimonials as $t)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col {{ !$t->is_active ? 'opacity-60' : '' }}">
            <!-- Header -->
            <div class="p-5 flex items-center gap-4 border-b border-gray-50">
                <div class="relative flex-shrink-0">
                    @if($t->image)
                        <img src="{{ asset('storage/' . $t->image) }}" alt="{{ $t->name }}"
                             class="w-14 h-14 rounded-2xl object-cover border-2 border-gray-100">
                    @else
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold text-xl">
                            {{ strtoupper(substr($t->name, 0, 1)) }}
                        </div>
                    @endif
                    @if(!$t->is_active)
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-400 rounded-full border-2 border-white"></span>
                    @else
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-gray-800 truncate">{{ $t->name }}</h4>
                    <p class="text-xs text-gray-500 truncate"><i class="fas fa-map-marker-alt mr-1"></i>{{ $t->location }}</p>
                    <div class="flex items-center gap-1 mt-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star text-xs {{ $i <= $t->rating ? 'text-amber-400' : 'text-gray-200' }}"></i>
                        @endfor
                        <span class="text-xs text-gray-400 ml-1">{{ $t->rating }}/5</span>
                    </div>
                </div>
            </div>
            <!-- Message -->
            <div class="px-5 py-4 flex-1">
                <p class="text-sm text-gray-600 leading-relaxed line-clamp-4">{{ $t->message }}</p>
            </div>
            <!-- Actions -->
            <div class="px-5 py-3.5 bg-gray-50 flex items-center justify-between gap-2 border-t border-gray-100">
                <form action="{{ route('admin.testimonials.toggle-active', $t) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="text-xs font-semibold px-3 py-1.5 rounded-lg transition
                                   {{ $t->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}">
                        <i class="fas {{ $t->is_active ? 'fa-eye' : 'fa-eye-slash' }} mr-1"></i>
                        {{ $t->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.testimonials.edit', $t) }}"
                       class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-primary-50 text-primary-700 hover:bg-primary-100 transition">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST"
                          onsubmit="return confirm('Hapus testimoni dari {{ $t->name }}?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-20 text-center text-gray-400">
            <i class="fas fa-comment-dots text-5xl mb-3 block opacity-30"></i>
            <p class="text-lg font-medium">Belum ada testimoni</p>
            <p class="text-sm mt-1">Tambahkan testimoni agar tampil di halaman website</p>
            <a href="{{ route('admin.testimonials.create') }}"
               class="inline-flex items-center mt-4 px-5 py-2.5 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Sekarang
            </a>
        </div>
        @endforelse
    </div>
@endsection
