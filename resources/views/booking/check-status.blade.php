@extends('layouts.app')

@section('title', 'Cek Status Booking - Endah Travel')

@section('content')
    <section class="py-16">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-3xl text-primary-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Cek Status Booking</h1>
                <p class="text-gray-600">Masukkan kode booking untuk melihat status pemesanan Anda</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('booking.check-status.post') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Booking</label>
                        <input type="text" name="booking_code" value="{{ old('booking_code') }}" required
                               placeholder="Contoh: ET20260206ABCD"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-center text-lg tracking-wider uppercase @error('booking_code') border-red-500 @enderror">
                        @error('booking_code')
                            <p class="text-red-500 text-sm mt-2 text-center">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-2 text-center">
                            Kode booking dikirim via email setelah pemesanan. Format: ET + tanggal + kode unik
                        </p>
                    </div>

                    <button type="submit" 
                            class="w-full bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition">
                        <i class="fas fa-search mr-2"></i> Cari Booking
                    </button>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-blue-900 mb-2 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> Informasi Kode Booking
                </h3>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>✓ Dikirim ke email Anda setelah pemesanan berhasil</li>
                    <li>✓ Format: <strong>ET + tanggal + kode unik</strong> (contoh: ET20260206ABCD)</li>
                    <li>✓ Gunakan untuk mengecek status pemesanan kapan saja</li>
                </ul>
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-600 mb-2">Belum punya kode booking?</p>
                <a href="{{ route('packages.index') }}" class="text-primary-600 font-semibold hover:text-primary-700">
                    Lihat Paket Wisata <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

