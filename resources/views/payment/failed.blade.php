@extends('layouts.app')

@section('title', 'Pembayaran Gagal - Endah Trans')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4" style="background: linear-gradient(135deg, #0a0000 0%, #1a0000 40%, #180010 70%, #0d0008 100%);">
    <div class="max-w-lg w-full">

        {{-- Failed Card --}}
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            {{-- Top Banner --}}
            <div class="bg-gradient-to-r from-gray-700 to-gray-900 py-10 px-6 text-center">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-times-circle text-red-400 text-4xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">Pembayaran Gagal</h1>
                <p class="text-white/60 text-sm">Transaksi tidak dapat diproses</p>
            </div>

            {{-- Detail --}}
            <div class="p-8">

                {{-- Reason --}}
                @if(isset($message))
                <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-6 flex gap-3">
                    <i class="fas fa-exclamation-circle text-red-400 mt-0.5 flex-shrink-0"></i>
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                </div>
                @else
                <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-6 flex gap-3">
                    <i class="fas fa-exclamation-circle text-red-400 mt-0.5 flex-shrink-0"></i>
                    <div class="text-red-700 text-sm">
                        <p class="font-semibold mb-1">Kemungkinan penyebab:</p>
                        <ul class="list-disc list-inside space-y-1 text-red-600">
                            <li>Batas waktu pembayaran (60 menit) telah habis</li>
                            <li>Pembayaran dibatalkan oleh pengguna</li>
                            <li>Saldo tidak mencukupi</li>
                            <li>Gangguan jaringan sementara</li>
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Info Box --}}
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6 flex gap-3">
                    <i class="fas fa-info-circle text-blue-400 mt-0.5 flex-shrink-0"></i>
                    <p class="text-blue-700 text-sm">
                        Pesanan Anda masih tersimpan. Anda bisa mencoba kembali membayar atau hubungi kami jika memerlukan bantuan.
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col gap-3">
                    @if(isset($bookingCode))
                    <a href="{{ route('doku.pay', $bookingCode) }}"
                       class="btn-gradient w-full text-white text-center py-3 rounded-xl font-semibold transition flex items-center justify-center gap-2">
                        <i class="fas fa-redo"></i> Coba Bayar Lagi
                    </a>
                    @endif
                    <a href="https://wa.me/{{ config('app.whatsapp_number', '6281234567890') }}?text=Halo%20Endah%20Trans%2C%20saya%20mengalami%20masalah%20pembayaran%20dan%20butuh%20bantuan"
                       target="_blank"
                       class="w-full bg-green-500 hover:bg-green-600 text-white text-center py-3 rounded-xl font-semibold transition flex items-center justify-center gap-2">
                        <i class="fab fa-whatsapp text-lg"></i> Hubungi Admin
                    </a>
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
