@extends('layouts.app')

@section('title', 'Status Booking ' . $booking->booking_code . ' - Endah Travel')

@section('content')
    <section class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Booking Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-primary-600 text-white px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm opacity-90">Kode Booking</p>
                            <p class="text-2xl font-bold">{{ $booking->booking_code }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm opacity-90">Status Booking</p>
                            {!! $booking->status_badge !!}
                        </div>
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        @php
                            $statuses = ['pending' => 'Menunggu', 'confirmed' => 'Dikonfirmasi', 'paid' => 'Dibayar', 'completed' => 'Selesai'];
                            $currentIndex = array_search($booking->status, array_keys($statuses));
                            if ($booking->status === 'cancelled') $currentIndex = -1;
                        @endphp
                        @foreach($statuses as $key => $label)
                            @php $index = array_search($key, array_keys($statuses)); @endphp
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $index <= $currentIndex ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                                    @if($index < $currentIndex)
                                        <i class="fas fa-check"></i>
                                    @elseif($index == $currentIndex)
                                        <i class="fas fa-circle text-xs"></i>
                                    @else
                                        <span class="text-sm">{{ $index + 1 }}</span>
                                    @endif
                                </div>
                                <span class="text-xs mt-2 {{ $index <= $currentIndex ? 'text-green-600 font-medium' : 'text-gray-400' }}">{{ $label }}</span>
                            </div>
                            @if(!$loop->last)
                                <div class="flex-1 h-1 {{ $index < $currentIndex ? 'bg-green-500' : 'bg-gray-200' }} -mt-6"></div>
                            @endif
                        @endforeach
                    </div>

                    @if($booking->status === 'cancelled')
                        <div class="mt-4 bg-red-100 text-red-700 px-4 py-2 rounded-lg text-center">
                            <i class="fas fa-times-circle mr-1"></i> Pemesanan ini telah dibatalkan
                        </div>
                    @endif
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
                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                <span><i class="fas fa-calendar mr-1"></i> {{ $booking->booking_date->format('d F Y') }}</span>
                                <span class="mx-3">•</span>
                                <span><i class="fas fa-users mr-1"></i> {{ $booking->number_of_persons }} Orang</span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Data Pemesan</h4>
                            <div class="space-y-2 text-sm">
                                <p><span class="text-gray-500">Nama:</span> {{ $booking->customer_name }}</p>
                                <p><span class="text-gray-500">Email:</span> {{ $booking->customer_email }}</p>
                                <p><span class="text-gray-500">No. HP:</span> {{ $booking->customer_phone }}</p>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Pembayaran</h4>
                            <div class="space-y-2 text-sm">
                                <p>
                                    <span class="text-gray-500">Status:</span> 
                                    {!! $booking->payment_status_badge !!}
                                </p>
                                <p><span class="text-gray-500">Total:</span> <span class="font-bold text-primary-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span></p>
                                @if($booking->paid_at)
                                    <p><span class="text-gray-500">Dibayar:</span> {{ $booking->paid_at->format('d M Y H:i') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions (if unpaid) -->
                    @if($booking->payment_status === 'unpaid' && $booking->status !== 'cancelled')
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <h4 class="font-semibold text-yellow-800 mb-2">
                            <i class="fas fa-exclamation-triangle mr-1"></i> Menunggu Pembayaran
                        </h4>
                        <p class="text-yellow-700 text-sm mb-3">Silakan lakukan pembayaran ke rekening berikut:</p>
                        <div class="bg-white rounded p-3 text-sm">
                            <p><strong>Bank BCA:</strong> 1234567890</p>
                            <p><strong>A/N:</strong> PT Endah Travel</p>
                            <p><strong>Jumlah:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/6281234567890?text=Halo, saya ingin bertanya tentang booking {{ $booking->booking_code }}" 
                       target="_blank"
                       class="flex-1 bg-green-500 text-white text-center py-3 rounded-lg font-semibold hover:bg-green-600 transition">
                        <i class="fab fa-whatsapp mr-2"></i> Hubungi Kami
                    </a>
                    <a href="{{ route('booking.check-status') }}" 
                       class="flex-1 bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                        <i class="fas fa-search mr-2"></i> Cek Booking Lain
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

