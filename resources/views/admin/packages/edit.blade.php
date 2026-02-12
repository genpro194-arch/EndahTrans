@extends('layouts.admin')

@section('title', 'Edit Paket Wisata')
@section('page-title', 'Edit Paket Wisata')

@section('content')
    <div class="max-w-5xl">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Edit Paket Wisata</h1>
                <p class="text-slate-600 mt-1">Perbarui informasi paket wisata</p>
            </div>
            <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-900 rounded-lg font-medium transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Informasi Dasar</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Paket -->
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Nama Paket <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $package->name) }}" required
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Destinasi -->
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Destinasi <span class="text-red-500">*</span></label>
                        <select name="destination_id" required
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}" {{ old('destination_id', $package->destination_id) == $destination->id ? 'selected' : '' }}>
                                    {{ $destination->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-6">
                    <label class="block text-sm font-bold text-slate-900 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required
                              class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">{{ old('description', $package->description) }}</textarea>
                </div>
            </div>

            <!-- Details -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Detail Paket</h2>
                
                <!-- Itinerary -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-900 mb-2">Itinerary</label>
                    <textarea name="itinerary" rows="3"
                              class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">{{ old('itinerary', $package->itinerary) }}</textarea>
                </div>

                <!-- Includes & Excludes -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Termasuk</label>
                        <textarea name="includes" rows="3"
                                  class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">{{ old('includes', $package->includes) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Tidak Termasuk</label>
                        <textarea name="excludes" rows="3"
                                  class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">{{ old('excludes', $package->excludes) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Harga & Durasi</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Harga Normal <span class="text-red-500">*</span></label>
                        <input type="number" name="price" value="{{ old('price', $package->price) }}" required min="0"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Harga Diskon</label>
                        <input type="number" name="discount_price" value="{{ old('discount_price', $package->discount_price) }}" min="0"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Durasi (Hari) <span class="text-red-500">*</span></label>
                        <input type="number" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" required min="1"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Min Peserta <span class="text-red-500">*</span></label>
                        <input type="number" name="min_person" value="{{ old('min_person', $package->min_person) }}" required min="1"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Max Peserta <span class="text-red-500">*</span></label>
                        <input type="number" name="max_person" value="{{ old('max_person', $package->max_person) }}" required min="1"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Jadwal Keberangkatan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Tanggal Keberangkatan</label>
                        <input type="date" name="departure_date" value="{{ old('departure_date', $package->departure_date?->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Jam Keberangkatan</label>
                        <input type="time" name="departure_time" value="{{ old('departure_time', $package->departure_time) }}"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">Titik Kumpul</label>
                    <input type="text" name="meeting_point" value="{{ old('meeting_point', $package->meeting_point) }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                </div>
            </div>

            <!-- Media -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Gambar Paket</h2>
                
                @if($package->image)
                    <div class="mb-4">
                        <p class="text-sm text-slate-600 mb-2">Gambar Saat Ini:</p>
                        <img src="{{ $package->image_url }}" alt="{{ $package->name }}" class="w-40 h-28 object-cover rounded-lg border border-slate-200">
                    </div>
                @endif
                
                <div>
                    <label class="block text-sm font-bold text-slate-900 mb-2">Ubah Gambar</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/10 transition-all">
                    <p class="text-xs text-slate-600 mt-2">Format: JPG, PNG, WEBP (Max 2MB). Kosongkan jika tidak ingin mengubah.</p>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Status Paket</h2>
                
                <div class="flex items-center gap-8">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500/50 cursor-pointer">
                        <span class="ml-3 text-sm font-medium text-slate-900">Aktif</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500/50 cursor-pointer">
                        <span class="ml-3 text-sm font-medium text-slate-900">Paket Unggulan</span>
                    </label>
                </div>
            </div>

            <!-- Facilities Management -->
            @if($package->exists)
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl shadow-sm border border-amber-200 p-8 mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900 mb-2">Kelola Fasilitas</h2>
                            <p class="text-sm text-slate-600">Atur harga dan fasilitas untuk setiap paket</p>
                        </div>
                        <a href="{{ route('admin.packages.edit-facilities', $package) }}" class="inline-flex items-center px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md">
                            <i class="fas fa-cog mr-2"></i> Edit Fasilitas
                        </a>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.packages.index') }}" class="px-6 py-3 border border-slate-300 rounded-lg text-slate-900 font-medium hover:bg-slate-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md inline-flex items-center gap-2">
                    <i class="fas fa-save"></i> Update Paket
                </button>
            </div>
        </form>
    </div>
@endsection

