@extends('layouts.admin')

@section('title', 'Tambah Paket Wisata')
@section('page-title', 'Tambah Paket Wisata')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b">
                <a href="{{ route('admin.packages.index') }}" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Paket <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror"
                                   placeholder="Contoh: Wisata Bromo Sunrise">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Destinasi <span class="text-red-500">*</span></label>
                            <select name="destination_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('destination_id') border-red-500 @enderror">
                                <option value="">Pilih Destinasi</option>
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('destination_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                            <textarea name="description" rows="4" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('description') border-red-500 @enderror"
                                      placeholder="Deskripsi lengkap paket wisata">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Itinerary</label>
                            <textarea name="itinerary" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                      placeholder="Hari 1: ...&#10;Hari 2: ...">{{ old('itinerary') }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Termasuk</label>
                                <textarea name="includes" rows="3"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                          placeholder="Transport&#10;Makan&#10;Tiket masuk">{{ old('includes') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tidak Termasuk</label>
                                <textarea name="excludes" rows="3"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                          placeholder="Pengeluaran pribadi&#10;Asuransi">{{ old('excludes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Normal <span class="text-red-500">*</span></label>
                                <input type="number" name="price" value="{{ old('price') }}" required min="0"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('price') border-red-500 @enderror"
                                       placeholder="500000">
                                @error('price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Diskon</label>
                                <input type="number" name="discount_price" value="{{ old('discount_price') }}" min="0"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                       placeholder="450000">
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (Hari) <span class="text-red-500">*</span></label>
                                <input type="number" name="duration_days" value="{{ old('duration_days', 1) }}" required min="1"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Min Peserta <span class="text-red-500">*</span></label>
                                <input type="number" name="min_person" value="{{ old('min_person', 1) }}" required min="1"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Max Peserta <span class="text-red-500">*</span></label>
                                <input type="number" name="max_person" value="{{ old('max_person', 50) }}" required min="1"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Keberangkatan</label>
                                <input type="date" name="departure_date" value="{{ old('departure_date') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jam Keberangkatan</label>
                                <input type="time" name="departure_time" value="{{ old('departure_time') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Titik Kumpul</label>
                            <input type="text" name="meeting_point" value="{{ old('meeting_point') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   placeholder="Contoh: Terminal Bus Kota">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Gambar Utama Paket</label>
                            <div class="relative">
                                <div id="imagePreview" class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 transition duration-300"
                                     onclick="document.getElementById('imageInput').click()">
                                    <div id="previewContent" class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3 block"></i>
                                        <p class="text-sm font-semibold text-gray-700">Klik untuk upload gambar</p>
                                        <p class="text-xs text-gray-500 mt-1">atau drag & drop di sini</p>
                                    </div>
                                    <img id="previewImage" class="hidden absolute inset-0 w-full h-full object-cover" alt="Preview">
                                </div>
                                <input type="file" id="imageInput" name="image" accept="image/*" class="hidden"
                                       onchange="previewImage(event)">
                            </div>
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Format: JPG, PNG, WEBP. Ukuran: 500x300px. Maksimal 2MB
                            </p>
                        </div>

                        <div class="flex items-center space-x-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                       class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                <span class="ml-2 text-sm text-gray-700">Paket Unggulan</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t flex justify-end space-x-4">
                    <a href="{{ route('admin.packages.index') }}" class="px-6 py-2.5 border-2 border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition duration-200">
                        <i class="fas fa-save mr-2"></i> Simpan Paket
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('previewImage');
                    const previewContent = document.getElementById('previewContent');
                    
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewContent.classList.add('hidden');
                    
                    // Update border color
                    document.getElementById('imagePreview').classList.add('border-indigo-500', 'bg-white');
                    document.getElementById('imagePreview').classList.remove('border-gray-300', 'bg-gray-100', 'bg-gray-200');
                };
                reader.readAsDataURL(file);
            }
        }
        
        // Drag and drop
        const imagePreview = document.getElementById('imagePreview');
        const imageInput = document.getElementById('imageInput');
        
        imagePreview.addEventListener('dragover', (e) => {
            e.preventDefault();
            imagePreview.classList.add('border-indigo-500', 'bg-indigo-50');
        });
        
        imagePreview.addEventListener('dragleave', () => {
            imagePreview.classList.remove('border-indigo-500', 'bg-indigo-50');
        });
        
        imagePreview.addEventListener('drop', (e) => {
            e.preventDefault();
            imagePreview.classList.remove('border-indigo-500', 'bg-indigo-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                previewImage({ target: { files: files } });
            }
        });
    </script>
    @endpush

