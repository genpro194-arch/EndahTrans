@extends('layouts.app')

@section('title', 'Tambah Video Rute - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <a href="{{ route('admin.route-videos.index') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Video
            </a>
            <h1 class="text-3xl font-extrabold text-gray-900 mt-3">Tambah Video Rute</h1>
            <p class="mt-1 text-gray-500">Masukkan link YouTube video rute perjalanan Endah Trans</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-8">
            <form action="{{ route('admin.route-videos.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Video <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           placeholder="Contoh: Rute Jepara - Bali via Tol"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tujuan / Destinasi</label>
                    <input type="text" name="destination" value="{{ old('destination') }}"
                           placeholder="Contoh: Bali, Yogyakarta, Lombok..."
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400">
                    <p class="text-xs text-gray-400 mt-1">Digunakan untuk filter di homepage. Isi dengan nama kota tujuan.</p>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">URL YouTube <span class="text-red-500">*</span></label>
                    <input type="text" name="youtube_url" value="{{ old('youtube_url') }}"
                           placeholder="Contoh: https://youtu.be/xxxxx atau https://www.youtube.com/watch?v=xxxxx"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400">
                    <p class="text-xs text-gray-400 mt-1">Thumbnail akan otomatis diambil dari YouTube jika tidak diisi.</p>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="3"
                              placeholder="Contoh: Perjalanan melalui Kudus, Demak, Semarang hingga Bali..."
                              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400">{{ old('description') }}</textarea>
                </div>

                <div class="mb-5 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampil</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400">
                        <p class="text-xs text-gray-400 mt-1">Angka kecil tampil lebih dulu.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <label class="flex items-center gap-3 mt-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary-600 rounded">
                            <span class="text-sm text-gray-700">Tampilkan di homepage</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit"
                            class="flex-1 bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition">
                        <i class="fas fa-save mr-2"></i> Simpan Video
                    </button>
                    <a href="{{ route('admin.route-videos.index') }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
