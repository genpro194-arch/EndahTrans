@extends('layouts.admin')

@section('title', 'Edit Destinasi')
@section('page-title', 'Edit Destinasi')
@section('page-subtitle', 'Ubah data & harga charter destinasi')

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
                <p class="text-sm font-bold text-gray-900">{{ $destination->name }}</p>
                <p class="text-xs text-gray-400">Edit data & harga charter destinasi</p>
            </div>
        </div>

        <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            @include('admin.destinations._form')

            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST"
                      onsubmit="return confirm('Hapus destinasi ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-xl transition">
                        <i class="fas fa-trash text-xs"></i> Hapus
                    </button>
                </form>
                <div class="flex gap-3">
                    <a href="{{ route('admin.destinations.index') }}"
                       class="px-5 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white transition shadow hover:-translate-y-0.5"
                            style="background:linear-gradient(135deg,#ec4899,#ef4444)">
                        <i class="fas fa-save mr-1.5"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


            <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Destinasi <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $destination->name) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('description', $destination->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        @if($destination->image)
                            <div class="mb-2">
                                <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-32 h-20 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>

                    {{-- ═══════════════════════════════════════
                         HARGA CHARTER PER KELAS ARMADA
                    ═══════════════════════════════════════ --}}
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
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    {{ $fleetLabel }}
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-semibold">Rp</span>
                                    <input type="number" name="prices[{{ $fleetKey }}]"
                                           value="{{ old('prices.'.$fleetKey, $priceMap[$fleetKey] ?? 0) }}"
                                           min="0" step="50000"
                                           placeholder="0"
                                           class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white">
                                </div>
                                @if(!empty($priceMap[$fleetKey]) && $priceMap[$fleetKey] > 0)
                                <p class="text-xs text-green-600 mt-1">
                                    <i class="fas fa-check-circle"></i>
                                    Rp {{ number_format($priceMap[$fleetKey], 0, ',', '.') }}/hari
                                </p>
                                @endif
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
                        <i class="fas fa-save mr-2"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


            <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Destinasi <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $destination->name) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('description', $destination->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        @if($destination->image)
                            <div class="mb-2">
                                <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-32 h-20 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t flex justify-end space-x-4">
                    <a href="{{ route('admin.destinations.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-save mr-2"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

