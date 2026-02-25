@extends('layouts.app')

@section('title', 'Nota Pemesanan ' . $booking->booking_code . ' - Endah Trans')

@push('styles')
<style>
    @media print {
        nav, footer, .no-print { display: none !important; }
        body { background: white !important; }
        .print-shadow { box-shadow: none !important; }
        .nota-container { margin: 0 !important; max-width: 100% !important; }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-slate-100 py-12 px-4">
<div class="nota-container max-w-2xl mx-auto">

    {{-- Action Bar (hidden on print) --}}
    <div class="no-print flex items-center justify-between mb-6">
        <a href="{{ route('armada') }}" class="flex items-center gap-2 text-sm text-slate-500 hover:text-slate-800 transition font-semibold">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke Armada
        </a>
        <div class="flex gap-2">
            <button onclick="window.print()"
                    class="inline-flex items-center gap-2 bg-slate-800 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-slate-900 transition">
                <i class="fas fa-print"></i> Cetak Nota
            </button>
            <a href="https://wa.me/6281234567890?text=Halo+Endah+Trans%2C+saya+telah+melakukan+pemesanan+charter+dengan+kode+{{ $booking->booking_code }}+dan+ingin+konfirmasi+pembayaran."
               target="_blank"
               class="inline-flex items-center gap-2 bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fab fa-whatsapp"></i> Konfirmasi via WA
            </a>
        </div>
    </div>

    {{-- Nota Card --}}
    <div class="print-shadow bg-white rounded-2xl shadow-xl overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-primary-700 to-secondary-700 px-8 py-8 text-white">
            <div class="flex items-start justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-bus text-white"></i>
                        </div>
                        <div>
                            <p class="font-extrabold text-lg leading-tight">Endah Trans</p>
                            <p class="text-white/70 text-xs">Charter Bus Premium</p>
                        </div>
                    </div>
                    <p class="text-white/60 text-xs mt-3">Jl. Contoh No. 123, Kota Anda, Jawa Tengah</p>
                    <p class="text-white/60 text-xs">Telp: 0812-3456-7890</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold tracking-widest text-white/60 uppercase mb-1">Nota Pemesanan</p>
                    <p class="text-2xl font-extrabold font-mono tracking-wider">{{ $booking->booking_code }}</p>
                    <p class="text-white/70 text-xs mt-1">{{ $booking->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>

        {{-- Status Banner --}}
        @if($booking->payment_status === 'paid')
        <div class="bg-green-50 border-b border-green-100 px-8 py-3 flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-check text-green-600 text-sm"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-green-800">Pembayaran Diterima &mdash; Pemesanan Dikonfirmasi</p>
                <p class="text-xs text-green-600">Terima kasih. Armada siap disiapkan untuk perjalanan Anda.</p>
            </div>
        </div>
        @else
        <div class="bg-amber-50 border-b border-amber-100 px-8 py-3 flex items-center gap-3">
            <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-clock text-amber-600 text-sm"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-amber-800">Menunggu Pembayaran</p>
                <p class="text-xs text-amber-600">Selesaikan pembayaran dan kirim konfirmasi ke WhatsApp kami.</p>
            </div>
        </div>
        @endif

        {{-- Body --}}
        <div class="px-8 py-7 space-y-7">

            {{-- Customer + Trip Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Customer Info --}}
                <div>
                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">Data Pemesan</p>
                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-user text-slate-300 text-sm mt-0.5 w-4 text-center flex-shrink-0"></i>
                            <div>
                                <p class="text-xs text-slate-400">Nama</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $booking->customer_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-envelope text-slate-300 text-sm mt-0.5 w-4 text-center flex-shrink-0"></i>
                            <div>
                                <p class="text-xs text-slate-400">Email</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $booking->customer_email }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-phone text-slate-300 text-sm mt-0.5 w-4 text-center flex-shrink-0"></i>
                            <div>
                                <p class="text-xs text-slate-400">Telepon</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $booking->customer_phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Trip Info --}}
                <div>
                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">Detail Perjalanan</p>
                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-slate-300 text-sm mt-0.5 w-4 text-center flex-shrink-0"></i>
                            <div>
                                <p class="text-xs text-slate-400">Destinasi</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $booking->destination }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-calendar text-slate-300 text-sm mt-0.5 w-4 text-center flex-shrink-0"></i>
                            <div>
                                <p class="text-xs text-slate-400">Tanggal Berangkat</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $booking->departure_date->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock text-slate-300 text-sm mt-0.5 w-4 text-center flex-shrink-0"></i>
                            <div>
                                <p class="text-xs text-slate-400">Jam Keberangkatan</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $booking->departure_time }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Fleet Type Badge --}}
            <div class="flex items-center gap-3 p-4 rounded-xl
                {{ $booking->fleet_type === 'eksklusif' ? 'bg-primary-50 border border-primary-100' : 'bg-secondary-50 border border-secondary-100' }}">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center
                    {{ $booking->fleet_type === 'eksklusif' ? 'bg-gradient-to-br from-primary-500 to-secondary-600' : 'bg-gradient-to-br from-secondary-400 to-secondary-600' }}">
                    @if($booking->fleet_type === 'eksklusif')
                        <i class="fas fa-crown text-white"></i>
                    @else
                        <i class="fas fa-bus text-white"></i>
                    @endif
                </div>
                <div>
                    <p class="text-xs {{ $booking->fleet_type === 'eksklusif' ? 'text-primary-600' : 'text-secondary-600' }} font-bold tracking-widest uppercase">Kelas Armada</p>
                    <p class="font-extrabold text-slate-900 text-lg">{{ $booking->fleet_label }}</p>
                </div>
                <div class="ml-auto text-right">
                    <p class="text-xs text-slate-400">Kapasitas</p>
                    <p class="font-bold text-slate-900">{{ $booking->fleet_type === 'eksklusif' ? '45' : '35' }} kursi/bus</p>
                </div>
            </div>

            {{-- Price Breakdown --}}
            <div>
                <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">Rincian Biaya</p>
                <div class="border border-slate-100 rounded-xl overflow-hidden">
                    <table class="w-full text-sm">
                        <tbody class="divide-y divide-slate-50">
                            <tr class="bg-white">
                                <td class="px-5 py-3 text-slate-500">Harga Armada {{ $booking->fleet_label }}</td>
                                <td class="px-5 py-3 text-right text-slate-700 font-medium">{{ $booking->price_per_bus_formatted }}</td>
                            </tr>
                            <tr class="bg-slate-50/50">
                                <td class="px-5 py-3 text-slate-500">Jumlah Bus</td>
                                <td class="px-5 py-3 text-right text-slate-700 font-medium">&times; {{ $booking->num_buses }} unit</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-5 py-3 text-slate-500">Durasi</td>
                                <td class="px-5 py-3 text-right text-slate-700 font-medium">&times; {{ $booking->duration_days }} hari</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="{{ $booking->fleet_type === 'eksklusif' ? 'bg-primary-600' : 'bg-secondary-600' }} text-white">
                                <td class="px-5 py-4 font-extrabold text-base">TOTAL PEMBAYARAN</td>
                                <td class="px-5 py-4 text-right font-extrabold text-xl">{{ $booking->total_price_formatted }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Payment Instructions --}}
            @if($booking->payment_status !== 'paid')
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-5">
                <p class="text-xs font-bold tracking-widest text-amber-700 uppercase mb-3">
                    <i class="fas fa-university mr-1"></i> Instruksi Pembayaran
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg p-4 border border-amber-100">
                        <p class="text-xs text-slate-400 mb-1">Bank</p>
                        <p class="font-extrabold text-slate-900">Bank BCA</p>
                        <p class="font-mono text-lg font-bold text-slate-800 mt-1">1234 5678 90</p>
                        <p class="text-xs text-slate-400 mt-0.5">a/n PT. Endah Trans Wisata</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 border border-amber-100">
                        <p class="text-xs text-slate-400 mb-1">Bank</p>
                        <p class="font-extrabold text-slate-900">Bank Mandiri</p>
                        <p class="font-mono text-lg font-bold text-slate-800 mt-1">1230 0098 7654</p>
                        <p class="text-xs text-slate-400 mt-0.5">a/n PT. Endah Trans Wisata</p>
                    </div>
                </div>
                <p class="text-xs text-amber-700 mt-3 leading-relaxed">
                    <i class="fas fa-info-circle mr-1"></i>
                    Transfer sejumlah <strong>{{ $booking->total_price_formatted }}</strong> kemudian kirim bukti transfer ke WhatsApp kami beserta kode pemesanan <strong>{{ $booking->booking_code }}</strong>.
                </p>
            </div>
            @endif

            {{-- Special Requests --}}
            @if($booking->special_requests)
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-2">Catatan Tambahan</p>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $booking->special_requests }}</p>
            </div>
            @endif
        </div>

        {{-- Footer --}}
        <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                Nota ini merupakan bukti pemesanan resmi. Simpan kode <strong class="text-slate-600">{{ $booking->booking_code }}</strong> untuk keperluan konfirmasi.
            </p>
            <p class="text-xs text-slate-400 flex-shrink-0">Diterbitkan {{ $booking->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    {{-- Bottom Actions (no print) --}}
    <div class="no-print mt-6 flex flex-col sm:flex-row gap-3">
        <a href="https://wa.me/6281234567890?text=Halo+Endah+Trans%2C+saya+konfirmasi+pembayaran+untuk+kode+{{ $booking->booking_code }}+sejumlah+{{ urlencode($booking->total_price_formatted) }}"
           target="_blank"
           class="flex-1 inline-flex items-center justify-center gap-2 bg-green-600 text-white font-bold py-3.5 rounded-xl hover:bg-green-700 transition text-sm">
            <i class="fab fa-whatsapp text-lg"></i> Konfirmasi Pembayaran via WhatsApp
        </a>
        <button onclick="window.print()"
                class="inline-flex items-center justify-center gap-2 bg-slate-800 text-white font-bold py-3.5 px-6 rounded-xl hover:bg-slate-900 transition text-sm">
            <i class="fas fa-print"></i> Cetak
        </button>
        <a href="{{ route('armada') }}"
           class="inline-flex items-center justify-center gap-2 border-2 border-slate-200 text-slate-700 font-bold py-3.5 px-6 rounded-xl hover:border-slate-400 transition text-sm">
            <i class="fas fa-bus"></i> Pesan Lagi
        </a>
    </div>

</div>
</div>
@endsection
