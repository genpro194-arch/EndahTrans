@extends('layouts.app')

@section('title', 'Edit Tim Profesional - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.teams.index') }}" class="text-primary-600 hover:text-primary-900 flex items-center mb-4">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <h1 class="text-3xl font-extrabold text-gray-900">Edit Tim Profesional</h1>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow">
            <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $team->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Contoh: Endah Pratiwi"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Posisi/Jabatan *</label>
                    <input type="text" 
                           id="role" 
                           name="role" 
                           value="{{ old('role', $team->role) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('role') border-red-500 @enderror"
                           placeholder="Contoh: Founder & CEO"
                           required>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                    
                    <!-- Current Image -->
                    @if ($team->image)
                        <div class="mb-4 relative inline-block">
                            <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}" class="max-h-64 rounded-lg">
                            <button type="button" onclick="removeCurrentImage()" class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-2 hover:bg-red-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <input type="hidden" id="current-image" name="current_image" value="{{ $team->image }}">
                    @endif

                    <div class="flex items-center justify-center w-full">
                        <label for="image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF (Max 2MB)</p>
                            </div>
                            <input id="image" type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </label>
                    </div>
                    <div id="image-preview" class="mt-4"></div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- LinkedIn URL -->
                <div class="mb-6">
                    <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-2">URL LinkedIn</label>
                    <input type="url" 
                           id="linkedin_url" 
                           name="linkedin_url" 
                           value="{{ old('linkedin_url', $team->linkedin_url) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('linkedin_url') border-red-500 @enderror"
                           placeholder="https://linkedin.com/in/...">
                    @error('linkedin_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instagram URL -->
                <div class="mb-8">
                    <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-2">URL Instagram</label>
                    <input type="url" 
                           id="instagram_url" 
                           name="instagram_url" 
                           value="{{ old('instagram_url', $team->instagram_url) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('instagram_url') border-red-500 @enderror"
                           placeholder="https://instagram.com/...">
                    @error('instagram_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition">
                        <i class="fas fa-save mr-2"></i> Perbarui
                    </button>
                    <a href="{{ route('admin.teams.index') }}" 
                       class="flex-1 px-6 py-3 bg-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-400 transition text-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image-preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="relative inline-block">
                    <img src="${e.target.result}" alt="Preview" class="max-h-64 rounded-lg">
                    <button type="button" onclick="removeImage()" class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-2 hover:bg-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('image-preview').innerHTML = '';
}

function removeCurrentImage() {
    document.getElementById('current-image').remove();
    event.target.closest('.relative').remove();
}
</script>
@endsection
