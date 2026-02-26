@extends('layouts.admin')

@section('title', 'Kelola Charter Armada')
@section('page-title', 'Charter Armada')
@section('page-subtitle', 'Kelola semua pemesanan charter armada bus')

@section('content')
    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-gray-100">
            <div class="text-3xl font-black text-gray-900">{{ $stats['total'] }}</div>
            <div class="text-sm text-gray-500 mt-1">Total Charter</div>
        </div>
        <div class="bg-white rounded-2xl p-5 border-2 border-amber-200 bg-amber-50">
            <div class="text-3xl font-black text-amber-600">{{ $stats['pending'] }}</div>
            <div class="text-sm text-gray-500 mt-1">Menunggu</div>
        </div>
        <div class="bg-white rounded-2xl p-5 border-2 border-green-200 bg-green-50">
            <div class="text-3xl font-black text-green-600">{{ $stats['confirmed'] }}</div>
            <div class="text-sm text-gray-500 mt-1">Dikonfirmasi</div>
        </div>
        <div class="bg-white rounded-2xl p-5 border-2 border-primary-200 bg-primary-50">
            <div class="text-lg font-black text-primary-700">Rp {{ number_format($stats['revenue'] / 1000000, 1) }}Jt</div>
            <div class="text-sm text-gray-500 mt-1">Total Pendapatan</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-6 border border-gray-100">
        <form action="{{ route('admin.charter-bookings.index') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari kode, nama, email, tujuan..."
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                    </div>
                </div>
                <div class="w-full md:w-40">
                    <select name="status" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        <option value="">Semua Status</option>
                        <option value="pending"   {{ request('status') == 'pending'   ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="w-full md:w-40">
                    <select name="fleet_type" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        <option value="">Semua Armada</option>
                        <option value="eksklusif" {{ request('fleet_type') == 'eksklusif' ? 'selected' : '' }}>Eksklusif</option>
                        <option value="reguler"   {{ request('fleet_type') == 'reguler'   ? 'selected' : '' }}>Reguler</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 font-semibold transition">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                @if(request()->hasAny(['search','status','fleet_type','date_from','date_to']))
                    <a href="{{ route('admin.charter-bookings.index') }}" class="px-5 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 font-semibold transition">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800">Daftar Charter ({{ $bookings->total() }} data)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Kode</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Pelanggan</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Tujuan</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Armada</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Tgl Berangkat</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Total</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Status</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Pembayaran</th>
                        <th class="text-center px-5 py-3.5 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4">
                            <span class="font-mono text-xs font-bold text-primary-700 bg-primary-50 px-2 py-1 rounded-lg">{{ $booking->booking_code }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-800">{{ $booking->customer_name }}</div>
                            <div class="text-xs text-gray-500">{{ $booking->customer_phone }}</div>
                        </td>
                        <td class="px-5 py-4 text-gray-700">{{ $booking->destination }}</td>
                        <td class="px-5 py-4">
                            <span class="px-2 py-1 rounded-lg text-xs font-semibold
                                {{ $booking->fleet_type === 'eksklusif' ? 'bg-purple-100 text-purple-700' : 'bg-pink-100 text-brand-700' }}">
                                {{ ucfirst($booking->fleet_type) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-gray-700">
                            {{ $booking->departure_date->format('d M Y') }}
                            <div class="text-xs text-gray-400">{{ $booking->duration_days }} hari · {{ $booking->num_buses }} bus</div>
                        </td>
                        <td class="px-5 py-4 font-semibold text-gray-800">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-4">
                            @php
                                $statusColor = match($booking->status) {
                                    'pending'   => 'bg-amber-100 text-amber-700',
                                    'confirmed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                    default     => 'bg-gray-100 text-gray-700',
                                };
                                $statusLabel = match($booking->status) {
                                    'pending'   => 'Menunggu',
                                    'confirmed' => 'Dikonfirmasi',
                                    'cancelled' => 'Dibatalkan',
                                    default     => ucfirst($booking->status),
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $statusColor }}">{{ $statusLabel }}</span>
                        </td>
                        <td class="px-5 py-4">
                            @php
                                $payColor = $booking->payment_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                                $payLabel = $booking->payment_status === 'paid' ? 'Lunas' : 'Belum Bayar';
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $payColor }}">{{ $payLabel }}</span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <a href="{{ route('admin.charter-bookings.show', $booking) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-primary-50 text-primary-700 rounded-lg text-xs font-semibold hover:bg-primary-100 transition">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-5 py-16 text-center text-gray-400">
                            <i class="fas fa-bus text-4xl mb-3 block opacity-30"></i>
                            <p>Belum ada data charter</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
        <div class="p-5 border-t border-gray-100">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
@endsection
