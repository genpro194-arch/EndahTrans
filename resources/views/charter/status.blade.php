@extends('layouts.app')

@section('title', 'Status Booking ' . $booking->booking_code . ' - Endah Trans')

@section('content')
<div class="min-h-screen bg-slate-100 py-12 px-4">
<div class="max-w-2xl mx-auto">

    {{-- Back --}}
    <div class="mb-6">
        <a href="{{ route('booking.check-status') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-800 transition font-semibold">
            <i class="fas fa-arrow-left text-xs"></i> Cek Kode Lain
        </a>
    </div>

    {{-- Status Card --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-8 py-8 text-white">
            <div class="flex items-center gap-3 mb-1">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-bus text-white"></i>
                </div>
                <div>
                    <p class="font-extrabold text-lg leading-tight">Endah Trans</p>
                    <p class="text-white/60 text-xs">Status Pemesanan Charter</p>
                </div>
            </div>
            <div class="mt-5 flex items-end justify-between">
                <div>
                    <p class="text-xs font-bold tracking-widest text-white/50 uppercase mb-1">Kode Booking</p>
                    <p class="text-2xl font-extrabold font-mono tracking-wider">{{ $booking->booking_code }}</p>
                    <p class="text-white/60 text-xs mt-1">Dipesan pada {{ $booking->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
                {{-- Status Badge --}}
                @php
                    $statusMap = [
                        'pending'   => ['label' => 'Menunggu Konfirmasi', 'color' => 'bg-yellow-400 text-yellow-900'],
                        'confirmed' => ['label' => 'Dikonfirmasi',        'color' => 'bg-green-400 text-green-900'],
                        'in_progress' => ['label' => 'Sedang Berjalan',  'color' => 'bg-blue-400 text-blue-900'],
                        'completed' => ['label' => 'Selesai',             'color' => 'bg-slate-400 text-slate-900'],
                        'cancelled' => ['label' => 'Dibatalkan',          'color' => 'bg-red-400 text-red-900'],
                    ];
                    $st = $statusMap[$booking->status] ?? ['label' => ucfirst($booking->status), 'color' => 'bg-slate-400 text-slate-900'];
                @endphp
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold {{ $st['color'] }}">
                    {{ $st['label'] }}
                </span>
            </div>
        </div>

        {{-- Body --}}
        <div class="px-8 py-6 space-y-6">

            {{-- Status Progress --}}
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Progress Pemesanan</p>
                @php
                    $steps = [
                        ['key' => 'pending',     'icon' => 'fa-clock',         'label' => 'Pemesanan Masuk'],
                        ['key' => 'confirmed',   'icon' => 'fa-check-circle',  'label' => 'Dikonfirmasi Admin'],
                        ['key' => 'in_progress', 'icon' => 'fa-bus',           'label' => 'Sedang Berjalan'],
                        ['key' => 'completed',   'icon' => 'fa-flag-checkered','label' => 'Selesai'],
                    ];
                    $order = ['pending' => 0, 'confirmed' => 1, 'in_progress' => 2, 'completed' => 3, 'cancelled' => -1];
                    $currentIdx = $order[$booking->status] ?? 0;
                @endphp
                @if($booking->status === 'cancelled')
                    <div class="flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-red-700 font-semibold text-sm">
                        <i class="fas fa-times-circle text-red-500"></i>
                        Pemesanan ini telah dibatalkan
                    </div>
                @else
                    <div class="flex items-center gap-1">
                        @foreach($steps as $i => $step)
                            @php $done = $i <= $currentIdx; @endphp
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold
                                    {{ $done ? 'bg-gradient-to-br from-pink-500 to-red-500 text-white shadow-md' : 'bg-slate-100 text-slate-400' }}">
                                    <i class="fas {{ $step['icon'] }} text-xs"></i>
                                </div>
                                <p class="text-center text-xs mt-1.5 font-semibold leading-tight {{ $done ? 'text-pink-600' : 'text-slate-400' }}">
                                    {{ $step['label'] }}
                                </p>
                            </div>
                            @if(!$loop->last)
                                <div class="flex-1 h-0.5 mb-5 {{ $i < $currentIdx ? 'bg-pink-400' : 'bg-slate-200' }}"></div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="h-px bg-slate-100"></div>

            {{-- Detail Pemesanan --}}
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Detail Pemesanan</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <p class="text-xs text-slate-400 mb-0.5">Nama Pemesan</p>
                        <p class="font-semibold text-slate-800">{{ $booking->customer_name }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <p class="text-xs text-slate-400 mb-0.5">Nomor WhatsApp</p>
                        <p class="font-semibold text-slate-800">{{ $booking->customer_phone }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <p class="text-xs text-slate-400 mb-0.5">Tujuan</p>
                        <p class="font-semibold text-slate-800">{{ $booking->destination }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <p class="text-xs text-slate-400 mb-0.5">Armada</p>
                        <p class="font-semibold text-slate-800">
                            {{ ['eksklusif' => 'Sleeper Bus Eksklusif', 'reguler' => 'Reguler / Executive', 'bigtop' => 'Big Top', 'superexec' => 'Super Executive'][$booking->fleet_type] ?? ucfirst($booking->fleet_type) }}
                        </p>
                    </div>
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <p class="text-xs text-slate-400 mb-0.5">Tanggal Berangkat</p>
                        <p class="font-semibold text-slate-800">{{ $booking->departure_date->translatedFormat('d F Y') }} pukul {{ \Carbon\Carbon::parse($booking->departure_time)->format('H:i') }} WIB</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl px-4 py-3">
                        <p class="text-xs text-slate-400 mb-0.5">Durasi & Jumlah Bus</p>
                        <p class="font-semibold text-slate-800">{{ $booking->duration_days }} hari &bull; {{ $booking->num_buses }} bus</p>
                    </div>
                </div>
            </div>

            <div class="h-px bg-slate-100"></div>

            {{-- Pembayaran --}}
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Informasi Pembayaran</p>
                <div class="flex items-center justify-between bg-slate-50 rounded-xl px-5 py-4">
                    <div>
                        <p class="text-xs text-slate-400 mb-0.5">Total Pembayaran</p>
                        <p class="text-2xl font-extrabold text-slate-900">{{ $booking->total_price_formatted }}</p>
                    </div>
                    @php
                        $payMap = [
                            'unpaid'  => ['label' => 'Belum Dibayar',  'color' => 'bg-red-100 text-red-700'],
                            'partial' => ['label' => 'DP Diterima',    'color' => 'bg-yellow-100 text-yellow-700'],
                            'paid'    => ['label' => 'Lunas',          'color' => 'bg-green-100 text-green-700'],
                        ];
                        $ps = $payMap[$booking->payment_status] ?? ['label' => ucfirst($booking->payment_status), 'color' => 'bg-slate-100 text-slate-700'];
                    @endphp
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold {{ $ps['color'] }}">
                        {{ $ps['label'] }}
                    </span>
                </div>
                @if($booking->special_requests)
                <div class="mt-3 bg-amber-50 border border-amber-100 rounded-xl px-4 py-3 text-sm text-amber-800">
                    <p class="text-xs font-bold text-amber-500 uppercase mb-1">Permintaan Khusus</p>
                    {{ $booking->special_requests }}
                </div>
                @endif
            </div>

            {{-- CTA --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('charter.receipt', $booking->booking_code) }}"
                   class="flex-1 flex items-center justify-center gap-2 bg-slate-800 text-white text-sm font-semibold px-4 py-3 rounded-xl hover:bg-slate-900 transition">
                    <i class="fas fa-file-alt"></i> Lihat Nota Lengkap
                </a>
                <a href="https://wa.me/6281234567890?text=Halo+Endah+Trans%2C+saya+ingin+tanya+status+pemesanan+charter+kode+{{ $booking->booking_code }}"
                   target="_blank"
                   class="flex-1 flex items-center justify-center gap-2 bg-green-600 text-white text-sm font-semibold px-4 py-3 rounded-xl hover:bg-green-700 transition">
                    <i class="fab fa-whatsapp"></i> Hubungi via WA
                </a>
            </div>

        </div>
    </div>

</div>
</div>
@endsection
