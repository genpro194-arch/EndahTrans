@extends('layouts.admin')

@section('page-title', 'Tambah Foto Galeri')
@section('page-subtitle', 'Upload foto baru ke halaman galeri website')

@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Informasi Foto</h3>
            </div>
            <div class="p-6 space-y-5">

                {{-- Preview & Upload --}}
                <div x-data="{ preview: '' }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto <span class="text-red-500">*</span></label>
                    <div x-show="preview" class="mb-3">
                        <img :src="preview" class="w-full max-h-56 object-cover rounded-xl border">
                    </div>
                    <label class="flex items-center gap-4 border-2 border-dashed border-gray-200 rounded-xl p-5 cursor-pointer hover:border-purple-400 hover:bg-purple-50/30 transition group">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-cloud-upload-alt text-xl text-purple-400 group-hover:scale-110 transition-transform"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Klik untuk upload foto</p>
                            <p class="text-xs text-gray-400">JPG, PNG, WebP — maks 4MB</p>
                        </div>
                        <input type="file" name="image" accept="image/*" required class="hidden"
                               @change="preview = URL.createObjectURL($event.target.files[0])">
                    </label>
                    @error('image')<p class="mt-1 text-red-500 text-xs">{{ $message }}</p>@enderror
                </div>

                {{-- Title --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           placeholder="Contoh: Armada Eksklusif Big Bus"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-50">
                    @error('title')<p class="mt-1 text-red-500 text-xs">{{ $message }}</p>@enderror
                </div>

                {{-- Category --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-purple-400 bg-white">
                        @foreach($categories as $key => $label)
                        <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Caption --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan (opsional)</label>
                    <input type="text" name="caption" value="{{ old('caption') }}"
                           placeholder="Deskripsi singkat foto..."
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-50">
                </div>

                {{-- Sort & Status row --}}
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan Tampil</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-50">
                    </div>
                    <div class="flex items-center gap-3 mt-5">
                        <label class="text-sm font-medium text-gray-700">Aktifkan?</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-purple-500 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-5"></div>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="bg-[#346fff] hover:bg-[#1e4fd8] text-white font-bold px-7 py-3 rounded-xl shadow-[0_4px_14px_-2px_rgba(52,111,255,0.4)] hover:shadow-none transition-all flex items-center gap-2">
                <i class="fas fa-upload"></i> Upload Foto
            </button>
            <a href="{{ route('admin.gallery.index') }}"
               class="px-6 py-3 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium text-sm">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
