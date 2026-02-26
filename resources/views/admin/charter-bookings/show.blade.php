@extends('layouts.admin')

@section('title', 'Detail Charter #' . $charterBooking->booking_code)
@section('page-title', 'Detail Charter')
@section('page-subtitle', 'Informasi lengkap pemesanan charter armada')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Back + Header -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.charter-bookings.index') }}"
           class="inline-flex items-center text-sm text-gray-500 hover:text-primary-600 transition font-medium">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Charter
        </a>
        <span class="font-mono text-sm font-bold text-primary-700 bg-primary-50 px-3 py-1.5 rounded-xl border border-primary-200">
            {{ $charterBooking->booking_code }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Left: Main Info -->
        <div class="md:col-span-2 space-y-6">

            <!-- Customer Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Data Pelanggan</h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Nama</p>
                        <p class="font-semibold text-gray-800">{{ $charterBooking->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Email</p>
                        <p class="text-gray-700">{{ $charterBooking->customer_email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Telepon / WA</p>
                        <p class="text-gray-700">{{ $charterBooking->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Metode Bayar</p>
                        <p class="text-gray-700">{{ strtoupper(str_replace('_', ' ', $charterBooking->payment_method ?? '-')) }}</p>
                    </div>
                </div>
            </div>

            <!-- Trip Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                    <div class="w-8 h-8 bg-secondary-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-bus text-white text-sm"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Detail Perjalanan</h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Tujuan</p>
                        <p class="font-semibold text-gray-800">{{ $charterBooking->destination }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Tipe Armada</p>
                        <span class="px-3 py-1 rounded-full text-sm font-bold
                            {{ $charterBooking->fleet_type === 'eksklusif' ? 'bg-purple-100 text-purple-700' : 'bg-pink-100 text-brand-700' }}">
                            {{ ucfirst($charterBooking->fleet_type) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Tanggal Berangkat</p>
                        <p class="font-semibold text-gray-800">{{ $charterBooking->departure_date->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Jam Berangkat</p>
                        <p class="text-gray-700">{{ $charterBooking->departure_time }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Durasi</p>
                        <p class="text-gray-700">{{ $charterBooking->duration_days }} hari</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Jumlah Bus</p>
                        <p class="text-gray-700">{{ $charterBooking->num_buses }} unit</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Harga / Bus / Hari</p>
                        <p class="text-gray-700">Rp {{ number_format($charterBooking->price_per_bus_per_day, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Total Harga</p>
                        <p class="text-2xl font-black text-primary-700">Rp {{ number_format($charterBooking->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @if($charterBooking->special_requests)
                <div class="px-6 pb-6">
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-2">Permintaan Khusus</p>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-xl text-sm">{{ $charterBooking->special_requests }}</p>
                </div>
                @endif
            </div>

        </div>

        <!-- Right: Status Actions -->
        <div class="space-y-5">

            <!-- Status -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800">Status Charter</h3>
                </div>
                <div class="p-5">
                    @php
                        $statusColor = match($charterBooking->status) {
                            'pending'   => 'bg-amber-100 text-amber-700 border-amber-200',
                            'confirmed' => 'bg-green-100 text-green-700 border-green-200',
                            'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                            default     => 'bg-gray-100 text-gray-700 border-gray-200',
                        };
                        $statusLabel = match($charterBooking->status) {
                            'pending'   => 'Menunggu Konfirmasi',
                            'confirmed' => 'Dikonfirmasi',
                            'cancelled' => 'Dibatalkan',
                            default     => ucfirst($charterBooking->status),
                        };
                    @endphp
                    <span class="inline-block px-4 py-2 rounded-xl text-sm font-bold border {{ $statusColor }} mb-4">
                        {{ $statusLabel }}
                    </span>
                    <form action="{{ route('admin.charter-bookings.update-status', $charterBooking) }}" method="POST" class="space-y-3">
                        @csrf
                        <select name="status" class="w-full px-3 py-2.5 bg-gray-50 border-2 border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                            <option value="pending"   {{ $charterBooking->status === 'pending'   ? 'selected' : '' }}>Menunggu</option>
                            <option value="confirmed" {{ $charterBooking->status === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="cancelled" {{ $charterBooking->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <button type="submit" class="w-full py-2.5 bg-primary-600 text-white rounded-xl text-sm font-semibold hover:bg-primary-700 transition">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800">Status Pembayaran</h3>
                </div>
                <div class="p-5">
                    @php
                        $payColor = $charterBooking->payment_status === 'paid' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-100 text-red-700 border-red-200';
                        $payLabel = $charterBooking->payment_status === 'paid' ? 'Lunas' : 'Belum Bayar';
                    @endphp
                    <span class="inline-block px-4 py-2 rounded-xl text-sm font-bold border {{ $payColor }} mb-4">
                        {{ $payLabel }}
                    </span>
                    <form action="{{ route('admin.charter-bookings.update-payment', $charterBooking) }}" method="POST" class="space-y-3">
                        @csrf
                        <select name="payment_status" class="w-full px-3 py-2.5 bg-gray-50 border-2 border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                            <option value="unpaid" {{ $charterBooking->payment_status === 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="paid"   {{ $charterBooking->payment_status === 'paid'   ? 'selected' : '' }}>Lunas</option>
                        </select>
                        <button type="submit" class="w-full py-2.5 bg-secondary-600 text-white rounded-xl text-sm font-semibold hover:bg-secondary-700 transition">
                            Update Pembayaran
                        </button>
                    </form>
                </div>
            </div>

            <!-- Delete -->
            <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-red-100 bg-red-50">
                    <h3 class="font-bold text-red-700">Hapus Data</h3>
                </div>
                <div class="p-5">
                    <p class="text-sm text-gray-500 mb-4">Hapus data charter ini secara permanen.</p>
                    <form action="{{ route('admin.charter-bookings.destroy', $charterBooking) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus data charter ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full py-2.5 bg-red-600 text-white rounded-xl text-sm font-semibold hover:bg-red-700 transition">
                            <i class="fas fa-trash mr-2"></i> Hapus Charter
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
