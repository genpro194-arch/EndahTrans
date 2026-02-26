@extends('layouts.admin')

@section('page-title', 'Manajemen Galeri')
@section('page-subtitle', 'Kelola foto-foto yang tampil di halaman galeri website')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div class="flex flex-wrap items-center gap-2">
        <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1.5 rounded-full">
            {{ $galleries->total() }} Foto
        </span>
        @foreach($categories as $key => $label)
        @php $count = \App\Models\Gallery::where('category', $key)->count(); @endphp
        @if($count > 0)
        <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-1 rounded-full">
            {{ $label }}: {{ $count }}
        </span>
        @endif
        @endforeach
    </div>
    <a href="{{ route('admin.gallery.create') }}"
       class="inline-flex items-center gap-2 bg-[#346fff] hover:bg-[#1e4fd8] text-white font-bold px-5 py-2.5 rounded-xl shadow-[0_4px_14px_-2px_rgba(52,111,255,0.4)] hover:shadow-none transition-all text-sm">
        <i class="fas fa-plus"></i> Tambah Foto
    </a>
</div>

<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    @forelse($galleries as $photo)
    <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-purple-200 hover:shadow-lg transition-all duration-300">
        <div class="relative aspect-square overflow-hidden bg-gray-100">
            <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            {{-- Category badge --}}
            <span class="absolute top-2 left-2 text-[10px] font-bold px-2 py-0.5 rounded-full bg-black/50 text-white backdrop-blur-sm">
                {{ $categories[$photo->category] ?? $photo->category }}
            </span>
            {{-- Status badge --}}
            @if(!$photo->is_active)
            <span class="absolute top-2 right-2 text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-500 text-white">
                Nonaktif
            </span>
            @endif
            {{-- Hover overlay with actions --}}
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center gap-2">
                <a href="{{ route('admin.gallery.edit', $photo) }}"
                   class="w-9 h-9 rounded-lg bg-white text-brand-600 hover:bg-pink-50 flex items-center justify-center transition" title="Edit">
                    <i class="fas fa-edit text-sm"></i>
                </a>
                <form method="POST" action="{{ route('admin.gallery.toggle-active', $photo) }}">
                    @csrf
                    <button type="submit"
                            class="w-9 h-9 rounded-lg {{ $photo->is_active ? 'bg-orange-400 text-white' : 'bg-green-400 text-white' }} flex items-center justify-center transition" title="{{ $photo->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                        <i class="fas {{ $photo->is_active ? 'fa-eye-slash' : 'fa-eye' }} text-sm"></i>
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.gallery.destroy', $photo) }}"
                      onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-9 h-9 rounded-lg bg-red-500 text-white hover:bg-red-600 flex items-center justify-center transition" title="Hapus">
                        <i class="fas fa-trash text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="p-3">
            <p class="text-xs font-semibold text-gray-800 truncate">{{ $photo->title }}</p>
            @if($photo->caption)
            <p class="text-[11px] text-gray-400 truncate mt-0.5">{{ $photo->caption }}</p>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-20 text-gray-400">
        <i class="fas fa-images text-5xl mb-4 block opacity-30"></i>
        <p class="font-medium">Belum ada foto di galeri.</p>
        <a href="{{ route('admin.gallery.create') }}" class="text-blue-500 underline text-sm mt-1 inline-block">Upload foto pertama</a>
    </div>
    @endforelse
</div>

@if($galleries->hasPages())
<div class="mt-6">
    {{ $galleries->links() }}
</div>
@endif
@endsection
