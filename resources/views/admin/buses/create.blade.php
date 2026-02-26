@extends('layouts.admin')

@section('page-title', isset($bus) ? 'Edit Armada' : 'Tambah Armada')
@section('page-subtitle', isset($bus) ? 'Perbarui data armada bus' : 'Tambahkan unit armada baru ke website')

@section('content')
<div class="max-w-3xl">
    <form method="POST"
          action="{{ isset($bus) ? route('admin.buses.update', $bus) : route('admin.buses.store') }}"
          enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($bus)) @method('PUT') @endif

        {{-- Informasi Dasar --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Informasi Armada</h3>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Armada <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $bus->name ?? '') }}" required
                           placeholder="Contoh: Big Bus Eksklusif 45 Kursi"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Tipe / Kelas <span class="text-red-500">*</span></label>
                    <select name="type" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 bg-white">
                        @foreach(['eksklusif'=>'Sleeper Bus','reguler'=>'Executive','bigtop'=>'Executive Big Top','superexec'=>'Super Executive'] as $val => $label)
                        <option value="{{ $val }}" {{ old('type', $bus->type ?? '') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kapasitas (Kursi) <span class="text-red-500">*</span></label>
                    <input type="number" name="capacity" value="{{ old('capacity', $bus->capacity ?? 40) }}" min="1" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat</label>
                    <input type="text" name="short_desc" value="{{ old('short_desc', $bus->short_desc ?? '') }}"
                           placeholder="Kursi bisa rebahan penuh. Ideal untuk perjalanan malam jarak jauh."
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Lengkap</label>
                    <textarea name="description" rows="4"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50 resize-none">{{ old('description', $bus->description ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga Dasar Charter (Rp/hari)</label>
                    <input type="number" name="base_price" value="{{ old('base_price', $bus->base_price ?? 0) }}" min="0" step="50000"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $bus->sort_order ?? 0) }}" min="0"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                </div>
            </div>
        </div>

        {{-- Foto --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Foto Utama</h3>
            </div>
            <div class="p-6" x-data="{ preview: '{{ isset($bus) && $bus->image ? $bus->getImageUrl() : '' }}' }">
                @if(isset($bus) && $bus->image)
                <img :src="preview" id="imgPreview" class="w-48 h-32 object-cover rounded-xl mb-4 border" alt="">
                @else
                <img :src="preview" id="imgPreview" class="w-48 h-32 object-cover rounded-xl mb-4 border hidden" x-show="preview" alt="">
                @endif
                <label class="flex items-center gap-3 border-2 border-dashed border-gray-200 rounded-xl p-5 cursor-pointer hover:border-blue-400 hover:bg-pink-50/30 transition group">
                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-300 group-hover:text-blue-400 transition"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Klik untuk upload foto</p>
                        <p class="text-xs text-gray-400">JPG, PNG, WebP — maks 3MB</p>
                    </div>
                    <input type="file" name="image" accept="image/*" class="hidden"
                           @change="preview = URL.createObjectURL($event.target.files[0])">
                </label>
            </div>
        </div>

        {{-- Fasilitas --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Fasilitas</h3>
                <p class="text-xs text-gray-500 mt-0.5">Format tiap baris: <code class="bg-gray-100 px-1 rounded">fas fa-wifi|WiFi</code></p>
            </div>
            <div class="p-6">
                <textarea name="facilities" rows="10" placeholder="fas fa-snowflake|AC Full&#10;fas fa-wifi|WiFi&#10;fas fa-tv|LCD TV&#10;fas fa-bolt|USB Charger&#10;fas fa-couch|Reclining Seat&#10;fas fa-toilet|Toilet"
                          class="w-full font-mono text-sm border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50 resize-none">{{ old('facilities', $facilitiesText ?? '') }}</textarea>
                <p class="text-xs text-gray-400 mt-2">Cari nama ikon di <a href="https://fontawesome.com/icons" target="_blank" class="text-blue-500 underline">fontawesome.com/icons</a></p>
            </div>
        </div>

        {{-- Status --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
            <div>
                <label class="font-medium text-gray-900 block">Status Aktif</label>
                <p class="text-xs text-gray-400">Armada akan tampil di website jika aktif</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                       {{ old('is_active', $bus->is_active ?? true) ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-brand-500 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-5"></div>
            </label>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="bg-[#346fff] hover:bg-[#1e4fd8] text-white font-bold px-7 py-3 rounded-xl shadow-[0_4px_14px_-2px_rgba(52,111,255,0.4)] hover:shadow-none transition-all flex items-center gap-2">
                <i class="fas fa-save"></i> {{ isset($bus) ? 'Simpan Perubahan' : 'Tambah Armada' }}
            </button>
            <a href="{{ route('admin.buses.index') }}"
               class="px-6 py-3 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 transition font-medium text-sm">
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Alpine is already in layout
</script>
@endpush
@endsection
