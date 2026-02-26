@extends('layouts.app')

@section('title', 'Konfirmasi Pemesanan - Endah Travel')

@section('content')
    <section class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Banner -->
            <div class="bg-green-100 border border-green-400 rounded-xl p-6 mb-8 text-center">
                <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-3xl text-white"></i>
                </div>
                <h1 class="text-2xl font-bold text-green-800 mb-2">Pemesanan Berhasil!</h1>
                <p class="text-green-700">Terima kasih, pesanan Anda telah kami terima.</p>
            </div>

            <!-- Booking Details -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-primary-600 text-white px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm opacity-90">Kode Booking</p>
                            <p class="text-2xl font-bold">{{ $booking->booking_code }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm opacity-90">Status</p>
                            <span class="inline-block bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">
                                Menunggu Pembayaran
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Package Info -->
                    <div class="flex items-start border-b pb-6 mb-6">
                        <img src="{{ $booking->package->image_url }}" alt="{{ $booking->package->name }}" 
                             class="w-24 h-24 rounded-lg object-cover"
                             onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=200'">
                        <div class="ml-4 flex-1">
                            <h3 class="font-semibold text-gray-900 text-lg">{{ $booking->package->name }}</h3>
                            <p class="text-gray-500">{{ $booking->package->destination->name }}</p>
                            <div class="flex items-center flex-wrap gap-3 mt-2 text-sm text-gray-600">
                                <span><i class="fas fa-calendar mr-1"></i> {{ $booking->booking_date->format('d F Y') }}</span>
                                <span class="text-gray-300">|</span>
                                <span><i class="fas fa-clock mr-1"></i> {{ $booking->departure_time->format('H:i') ?? '-' }} WIB</span>
                                <span class="text-gray-300">|</span>
                                <span><i class="fas fa-bus mr-1"></i> {{ $booking->number_of_buses }} Bus ({{ $booking->number_of_buses * ($booking->package->capacity ?? 35) }} Penumpang)</span>
                                @if($booking->busFacility)
                                <span class="text-gray-300">|</span>
                                <span><i class="fas fa-check-circle text-green-500 mr-1"></i> {{ $booking->busFacility->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Data Pemesan</h4>
                            <div class="space-y-2 text-sm">
                                <p><span class="text-gray-500">Nama:</span> {{ $booking->customer_name }}</p>
                                <p><span class="text-gray-500">Email:</span> {{ $booking->customer_email }}</p>
                                <p><span class="text-gray-500">No. HP:</span> {{ $booking->customer_phone }}</p>
                                @if($booking->customer_address)
                                    <p><span class="text-gray-500">Alamat:</span> {{ $booking->customer_address }}</p>
                                @endif
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Rincian Biaya</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Harga x {{ $booking->number_of_buses }} bus</span>
                                    <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t pt-2 mt-2">
                                    <div class="flex justify-between font-bold text-lg">
                                        <span>Total Pembayaran</span>
                                        <span class="text-primary-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($booking->special_requests)
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Permintaan Khusus</h4>
                        <p class="text-gray-600 text-sm">{{ $booking->special_requests }}</p>
                    </div>
                    @endif

                    <!-- Payment Info -->
                    <div class="rounded-2xl p-6" style="background: linear-gradient(135deg, #fff1f5 0%, #fff5f5 100%); border: 1px solid #fecdd3;">
                        <h4 class="font-semibold text-gray-900 mb-2">
                            <i class="fas fa-credit-card mr-2 text-primary-600"></i> Pembayaran
                        </h4>
                        <p class="text-gray-600 text-sm mb-5">Selesaikan pembayaran Anda melalui DOKU — tersedia Virtual Account, QRIS, dan Kartu Kredit.</p>

                        <div class="bg-white rounded-xl p-4 mb-5 flex items-center justify-between shadow-sm">
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Total Pembayaran</p>
                                <p class="text-2xl font-bold text-primary-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400 mb-1">Kode Booking</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $booking->booking_code }}</p>
                            </div>
                        </div>

                        <a href="{{ route('doku.pay', $booking->booking_code) }}"
                           class="btn-gradient w-full text-white text-center py-4 rounded-xl font-bold text-base inline-flex items-center justify-center gap-3 shadow-lg hover:-translate-y-1 transition-all duration-200 block">
                            <i class="fas fa-lock text-lg"></i> Bayar Sekarang via DOKU
                        </a>
                        <p class="text-center text-gray-400 text-xs mt-3">
                            <i class="fas fa-shield-alt mr-1"></i> Pembayaran aman & terenkripsi · Batas waktu 60 menit
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/6281234567890?text=Halo, saya ingin konfirmasi pembayaran untuk booking {{ $booking->booking_code }}" 
                       target="_blank"
                       class="flex-1 bg-green-500 text-white text-center py-3 rounded-lg font-semibold hover:bg-green-600 transition">
                        <i class="fab fa-whatsapp mr-2"></i> Konfirmasi via WhatsApp
                    </a>
                    <a href="{{ route('home') }}" 
                       class="flex-1 bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>

            <!-- Check Status -->
            <div class="text-center mt-8">
                <p class="text-gray-600">Ingin cek status pemesanan?</p>
                <a href="{{ route('booking.check-status') }}" class="text-primary-600 font-semibold hover:text-primary-700">
                    Cek Status Booking <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

