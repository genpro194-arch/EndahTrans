@extends('layouts.admin')

@section('title', 'Tambah Testimoni')
@section('page-title', 'Tambah Testimoni')
@section('page-subtitle', 'Tambahkan ulasan pelanggan baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.testimonials.index') }}"
       class="inline-flex items-center text-sm text-gray-500 hover:text-primary-600 transition font-medium mb-6">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Testimoni
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <h3 class="font-bold text-gray-800">Form Testimoni Baru</h3>
        </div>
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Contoh: Budi Santoso"
                           class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition @error('name') border-red-400 @enderror"
                           required>
                    @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <!-- Lokasi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi / Asal <span class="text-red-500">*</span></label>
                    <input type="text" name="location" value="{{ old('location') }}"
                           placeholder="Contoh: Surabaya, Jawa Timur"
                           class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition @error('location') border-red-400 @enderror"
                           required>
                    @error('location')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Pesan -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ulasan / Testimoni <span class="text-red-500">*</span></label>
                <textarea name="message" rows="4"
                          placeholder="Tulis ulasan pelanggan di sini..."
                          class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl resize-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition @error('message') border-red-400 @enderror"
                          required>{{ old('message') }}</textarea>
                @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <!-- Rating -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-3">
                    @for($i = 1; $i <= 5; $i++)
                    <label class="cursor-pointer">
                        <input type="radio" name="rating" value="{{ $i }}" class="sr-only"
                               {{ old('rating', 5) == $i ? 'checked' : '' }}>
                        <i class="fas fa-star text-2xl transition star-rating
                                  {{ old('rating', 5) >= $i ? 'text-amber-400' : 'text-gray-200' }}"
                           data-value="{{ $i }}"></i>
                    </label>
                    @endfor
                    <span class="text-sm text-gray-500 ml-2" id="rating-label">{{ old('rating', 5) }} bintang</span>
                </div>
                @error('rating')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <!-- Foto -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil <span class="text-gray-400 font-normal">(opsional)</span></label>
                <div class="flex items-center gap-4">
                    <div id="img-preview"
                         class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold text-xl flex-shrink-0 overflow-hidden">
                        <i class="fas fa-user"></i>
                    </div>
                    <label class="flex-1 cursor-pointer flex flex-col items-center justify-center py-5 border-2 border-dashed border-gray-200 rounded-2xl hover:border-primary-300 hover:bg-primary-50/30 transition">
                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-300 mb-2"></i>
                        <span class="text-sm text-gray-500">Klik untuk upload foto (JPG, PNG, maks 2MB)</span>
                        <input type="file" name="image" class="hidden" accept="image/*" id="photo-input"
                               onchange="previewPhoto(this)">
                    </label>
                </div>
                @error('image')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <!-- Status Aktif -->
            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="w-5 h-5 text-primary-600 rounded border-gray-300 focus:ring-primary-500">
                <label for="is_active" class="text-sm font-semibold text-gray-700 cursor-pointer">
                    Tampilkan di website (aktif)
                </label>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit"
                        class="px-8 py-3 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition shadow-md shadow-primary-500/30">
                    <i class="fas fa-save mr-2"></i> Simpan Testimoni
                </button>
                <a href="{{ route('admin.testimonials.index') }}"
                   class="px-5 py-3 bg-gray-100 text-gray-600 rounded-xl font-semibold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('img-preview');
            preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Star rating interactive
document.querySelectorAll('.star-rating').forEach(star => {
    star.addEventListener('click', function() {
        const val = parseInt(this.dataset.value);
        document.querySelector(`input[name="rating"][value="${val}"]`).checked = true;
        document.querySelectorAll('.star-rating').forEach((s, i) => {
            if (parseInt(s.dataset.value) <= val) {
                s.classList.remove('text-gray-200');
                s.classList.add('text-amber-400');
            } else {
                s.classList.remove('text-amber-400');
                s.classList.add('text-gray-200');
            }
        });
        document.getElementById('rating-label').textContent = val + ' bintang';
    });
});
</script>
@endpush
