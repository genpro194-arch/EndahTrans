@extends('layouts.admin')

@section('title', 'Kelola Pemesanan')
@section('page-title', 'Pemesanan')
@section('page-subtitle', 'Kelola semua pemesanan pelanggan')

@section('content')
    <!-- Stats Overview -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        @php
            $statusCounts = [
                'all' => $bookings->total(),
                'pending' => \App\Models\Booking::where('status', 'pending')->count(),
                'confirmed' => \App\Models\Booking::where('status', 'confirmed')->count(),
                'paid' => \App\Models\Booking::where('status', 'paid')->count(),
                'completed' => \App\Models\Booking::where('status', 'completed')->count(),
            ];
        @endphp
        <a href="{{ route('admin.bookings.index') }}" 
           class="bg-white rounded-2xl p-4 border-2 {{ !request('status') ? 'border-primary-500 bg-primary-50' : 'border-gray-100' }} hover:border-primary-300 transition">
            <div class="text-2xl font-bold text-gray-900">{{ $statusCounts['all'] }}</div>
            <div class="text-sm text-gray-500">Semua</div>
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" 
           class="bg-white rounded-2xl p-4 border-2 {{ request('status') == 'pending' ? 'border-primary-500 bg-primary-50' : 'border-gray-100' }} hover:border-primary-300 transition">
            <div class="text-2xl font-bold text-primary-600">{{ $statusCounts['pending'] }}</div>
            <div class="text-sm text-gray-500">Menunggu</div>
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}" 
           class="bg-white rounded-2xl p-4 border-2 {{ request('status') == 'confirmed' ? 'border-primary-500 bg-primary-50' : 'border-gray-100' }} hover:border-primary-300 transition">
            <div class="text-2xl font-bold text-primary-600">{{ $statusCounts['confirmed'] }}</div>
            <div class="text-sm text-gray-500">Dikonfirmasi</div>
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'paid']) }}" 
           class="bg-white rounded-2xl p-4 border-2 {{ request('status') == 'paid' ? 'border-secondary-500 bg-secondary-50' : 'border-gray-100' }} hover:border-secondary-300 transition">
            <div class="text-2xl font-bold text-secondary-600">{{ $statusCounts['paid'] }}</div>
            <div class="text-sm text-gray-500">Dibayar</div>
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'completed']) }}" 
           class="bg-white rounded-2xl p-4 border-2 {{ request('status') == 'completed' ? 'border-gray-500 bg-gray-50' : 'border-gray-100' }} hover:border-gray-300 transition">
            <div class="text-2xl font-bold text-gray-600">{{ $statusCounts['completed'] }}</div>
            <div class="text-sm text-gray-500">Selesai</div>
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-gray-100">
        <form action="{{ route('admin.bookings.index') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pencarian</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari kode booking, nama, email, HP..."
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Dibayar</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pembayaran</label>
                    <select name="payment_status" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        <option value="">Semua</option>
                        <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="partial" {{ request('payment_status') == 'partial' ? 'selected' : '' }}>Sebagian</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-3 rounded-xl hover:from-primary-700 hover:to-primary-800 transition font-semibold shadow-lg shadow-primary-500/30">
                        <i class="fas fa-search mr-2"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Paket</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Keberangkatan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <div class="ml-3">
                                    <span class="inline-flex items-center px-2.5 py-1 bg-primary-50 text-primary-700 rounded-lg font-mono text-sm font-semibold">
                                        #{{ $booking->booking_code }}
                                    </span>
                                    <p class="text-xs text-gray-400 mt-1">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow">
                                    {{ strtoupper(substr($booking->customer_name, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-gray-900">{{ $booking->customer_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->customer_phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900 line-clamp-1 max-w-[180px]">{{ $booking->package->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500">
                                <i class="fas fa-bus mr-1"></i> {{ $booking->number_of_buses }} bus
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-2">
                                    <i class="fas fa-calendar text-primary-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $booking->booking_date->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->booking_date->diffForHumans() }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            @php
                                $paymentColors = [
                                    'unpaid' => 'text-primary-600 bg-primary-50',
                                    'partial' => 'text-primary-600 bg-primary-50',
                                    'paid' => 'text-secondary-600 bg-secondary-50',
                                ];
                                $paymentLabels = [
                                    'unpaid' => 'Belum Bayar',
                                    'partial' => 'DP',
                                    'paid' => 'Lunas',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $paymentColors[$booking->payment_status] ?? 'text-gray-600 bg-gray-50' }}">
                                {{ $paymentLabels[$booking->payment_status] ?? $booking->payment_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-primary-100 text-primary-700 border-primary-200',
                                    'confirmed' => 'bg-primary-100 text-primary-700 border-primary-200',
                                    'paid' => 'bg-secondary-100 text-secondary-700 border-secondary-200',
                                    'completed' => 'bg-gray-100 text-gray-700 border-gray-200',
                                    'cancelled' => 'bg-primary-100 text-primary-700 border-primary-200',
                                ];
                                $statusIcons = [
                                    'pending' => 'fa-clock',
                                    'confirmed' => 'fa-check',
                                    'paid' => 'fa-money-bill-wave',
                                    'completed' => 'fa-flag-checkered',
                                    'cancelled' => 'fa-times',
                                ];
                                $statusText = [
                                    'pending' => 'Menunggu',
                                    'confirmed' => 'Dikonfirmasi',
                                    'paid' => 'Dibayar',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold border {{ $statusClasses[$booking->status] ?? 'bg-gray-100 text-gray-700' }}">
                                <i class="fas {{ $statusIcons[$booking->status] ?? 'fa-question' }} mr-1.5"></i>
                                {{ $statusText[$booking->status] ?? $booking->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.bookings.show', $booking) }}" 
                               class="inline-flex items-center justify-center w-10 h-10 bg-primary-50 text-primary-600 rounded-xl hover:bg-primary-100 transition"
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-inbox text-3xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Tidak ada pemesanan ditemukan</p>
                                <p class="text-gray-400 text-sm">Coba ubah filter pencarian Anda</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bookings->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $bookings->withQueryString()->links() }}
        </div>
        @endif
    </div>
@endsection

