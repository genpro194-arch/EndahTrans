@extends('layouts.admin')

@section('title', 'Tambah Destinasi')
@section('page-title', 'Tambah Destinasi')
@section('page-subtitle', 'Tambah destinasi baru ke form pemesanan charter')

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <a href="{{ route('admin.destinations.index') }}"
               class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-pink-50 text-gray-400 hover:text-brand-500 transition">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div>
                <p class="text-sm font-bold text-gray-900">Tambah Destinasi Baru</p>
                <p class="text-xs text-gray-400">Destinasi akan tampil di form pemesanan charter website</p>
            </div>
        </div>

        <form action="{{ route('admin.destinations.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            @php $destination = null; @endphp
            @include('admin.destinations._form')

            <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                <a href="{{ route('admin.destinations.index') }}"
                   class="px-5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white transition shadow hover:-translate-y-0.5"
                        style="background:linear-gradient(135deg,#ec4899,#ef4444)">
                    <i class="fas fa-save mr-1.5"></i> Simpan Destinasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Destinasi <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror"
                               placeholder="Contoh: Gunung Bromo">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                  placeholder="Deskripsi singkat tentang destinasi">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maks 2MB</p>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>

                    {{-- Harga Charter per Kelas Armada --}}
                    <div class="border border-amber-200 bg-amber-50 rounded-xl p-5">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tag text-amber-600 text-xs"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">Harga Charter per Kelas Armada</h4>
                                <p class="text-xs text-gray-500">Harga per unit bus per hari. Kosongkan / isi 0 jika belum ada harga.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($fleetTypes as $fleetKey => $fleetLabel)
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">{{ $fleetLabel }}</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-semibold">Rp</span>
                                    <input type="number" name="prices[{{ $fleetKey }}]"
                                           value="{{ old('prices.'.$fleetKey, 0) }}"
                                           min="0" step="50000" placeholder="0"
                                           class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t flex justify-end space-x-4">
                    <a href="{{ route('admin.destinations.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

