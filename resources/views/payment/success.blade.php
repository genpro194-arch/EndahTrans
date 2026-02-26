@extends('layouts.app')

@section('title', 'Pembayaran Berhasil - Endah Trans')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4" style="background: linear-gradient(135deg, #0a0000 0%, #1a0000 40%, #180010 70%, #0d0008 100%);">
    <div class="max-w-lg w-full">

        {{-- Success Card --}}
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            {{-- Top Banner --}}
            <div class="btn-gradient py-10 px-6 text-center">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-check-circle text-white text-4xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">Pembayaran Berhasil!</h1>
                <p class="text-white/80 text-sm">Terima kasih, pesanan Anda telah dikonfirmasi</p>
            </div>

            {{-- Detail --}}
            <div class="p-8">
                <div class="bg-gray-50 rounded-2xl p-5 mb-6 space-y-4">
                    @if(isset($booking))
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Kode Booking</span>
                        <span class="font-bold text-gray-900 tracking-wide">{{ $booking->booking_code }}</span>
                    </div>
                    <div class="border-t border-gray-200"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Nama Pemesan</span>
                        <span class="font-semibold text-gray-800">{{ $booking->customer_name }}</span>
                    </div>
                    <div class="border-t border-gray-200"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Rute</span>
                        <span class="font-semibold text-gray-800 text-right text-sm max-w-[55%]">
                            {{ $booking->pickup_location }} → {{ $booking->destination }}
                        </span>
                    </div>
                    <div class="border-t border-gray-200"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Tanggal Keberangkatan</span>
                        <span class="font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($booking->departure_date)->translatedFormat('d M Y') }}
                        </span>
                    </div>
                    <div class="border-t border-gray-200"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Total Dibayar</span>
                        <span class="font-bold text-primary-600 text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                    @else
                    <div class="text-center text-gray-500 py-4">
                        <i class="fas fa-info-circle text-2xl mb-2 block"></i>
                        Detail booking tidak tersedia. Silakan cek email atau WhatsApp Anda.
                    </div>
                    @endif
                </div>

                {{-- Info Box --}}
                <div class="bg-green-50 border border-green-100 rounded-xl p-4 mb-6 flex gap-3">
                    <i class="fas fa-envelope text-green-500 mt-0.5 flex-shrink-0"></i>
                    <p class="text-green-700 text-sm">
                        Detail perjalanan Anda akan dikirimkan via WhatsApp. Driver akan menghubungi Anda H-1 sebelum keberangkatan.
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col gap-3">
                    @if(isset($booking))
                    <a href="https://wa.me/{{ config('app.whatsapp_number', '6281234567890') }}?text=Halo%20Endah%20Trans%2C%20saya%20sudah%20melakukan%20pembayaran%20untuk%20booking%20{{ $booking->booking_code }}"
                       target="_blank"
                       class="w-full bg-green-500 hover:bg-green-600 text-white text-center py-3 rounded-xl font-semibold transition flex items-center justify-center gap-2">
                        <i class="fab fa-whatsapp text-lg"></i> Hubungi via WhatsApp
                    </a>
                    @endif
                    <a href="{{ route('home') }}"
                       class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-center py-3 rounded-xl font-semibold transition flex items-center justify-center gap-2">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        {{-- Note --}}
        <p class="text-center text-white/40 text-xs mt-6">
            <i class="fas fa-shield-alt mr-1"></i> Transaksi diproses oleh DOKU Payment Gateway
        </p>

    </div>
</div>
@endsection
