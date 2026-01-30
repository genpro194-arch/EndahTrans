@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan performa bisnis Anda')

@section('content')
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 rounded-3xl p-8 mb-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-2xl"></div>
        <div class="absolute bottom-0 left-1/2 w-48 h-48 bg-secondary-500/20 rounded-full blur-2xl"></div>
        <div class="relative">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name ?? 'Admin' }}! 👋</h2>
                    <p class="text-primary-100">Berikut ringkasan aktivitas bisnis Anda hari ini.</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <a href="{{ route('admin.packages.create') }}" 
                       class="inline-flex items-center px-5 py-2.5 bg-white text-primary-700 rounded-xl font-semibold hover:bg-primary-50 transition shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Tambah Paket
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Bookings -->
        <div class="bg-white rounded-2xl p-6 card-hover shadow-sm border border-gray-100 stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                    <i class="fas fa-calendar-check text-white text-xl"></i>
                </div>
                <span class="text-xs font-semibold px-3 py-1 bg-primary-100 text-primary-600 rounded-full">Total</span>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900 mb-1">{{ number_format($stats['total_bookings']) }}</h3>
            <p class="text-gray-500 text-sm">Total Pemesanan</p>
        </div>

        <!-- Pending Bookings -->
        <div class="bg-white rounded-2xl p-6 card-hover shadow-sm border border-gray-100 stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                @if($stats['pending_bookings'] > 0)
                <span class="text-xs font-semibold px-3 py-1 bg-primary-100 text-primary-600 rounded-full animate-pulse">
                    Perlu Aksi
                </span>
                @endif
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900 mb-1">{{ number_format($stats['pending_bookings']) }}</h3>
            <p class="text-gray-500 text-sm">Menunggu Konfirmasi</p>
        </div>

        <!-- Revenue -->
        <div class="bg-white rounded-2xl p-6 card-hover shadow-sm border border-gray-100 stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-2xl flex items-center justify-center shadow-lg shadow-secondary-500/30">
                    <i class="fas fa-wallet text-white text-xl"></i>
                </div>
                <span class="text-xs font-semibold px-3 py-1 bg-secondary-100 text-secondary-600 rounded-full">
                    <i class="fas fa-arrow-up mr-1"></i>Revenue
                </span>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 mb-1">Rp {{ number_format($stats['total_revenue'] / 1000000, 1) }}Jt</h3>
            <p class="text-gray-500 text-sm">Total Pendapatan</p>
        </div>

        <!-- Active Packages -->
        <div class="bg-white rounded-2xl p-6 card-hover shadow-sm border border-gray-100 stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                    <i class="fas fa-suitcase-rolling text-white text-xl"></i>
                </div>
                <span class="text-xs font-semibold px-3 py-1 bg-primary-100 text-primary-600 rounded-full">Aktif</span>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900 mb-1">{{ number_format($stats['active_packages']) }}</h3>
            <p class="text-gray-500 text-sm">Paket Wisata</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Statistik Pendapatan</h3>
                    <p class="text-sm text-gray-500">7 hari terakhir</p>
                </div>
                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-bar text-primary-600"></i>
                </div>
            </div>
            <div class="p-6">
                <div class="h-72">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Booking Status -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Status Pemesanan</h3>
                    <p class="text-sm text-gray-500">Distribusi saat ini</p>
                </div>
                <div class="w-10 h-10 bg-secondary-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-pie text-secondary-600"></i>
                </div>
            </div>
            <div class="p-6 space-y-4">
                @php
                    $statusColors = [
                        'pending' => ['bg' => 'bg-primary-500', 'light' => 'bg-primary-100'],
                        'confirmed' => ['bg' => 'bg-primary-500', 'light' => 'bg-primary-100'],
                        'paid' => ['bg' => 'bg-secondary-500', 'light' => 'bg-secondary-100'],
                        'completed' => ['bg' => 'bg-gray-500', 'light' => 'bg-gray-200'],
                        'cancelled' => ['bg' => 'bg-primary-600', 'light' => 'bg-primary-100'],
                    ];
                    $statusLabels = [
                        'pending' => 'Menunggu',
                        'confirmed' => 'Dikonfirmasi',
                        'paid' => 'Dibayar',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ];
                    $totalBookings = max(array_sum($bookingStats), 1);
                @endphp
                
                @foreach(['pending', 'confirmed', 'paid', 'completed', 'cancelled'] as $status)
                    @php $percentage = round(($bookingStats[$status] / $totalBookings) * 100); @endphp
                    <div class="group">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-3 h-3 {{ $statusColors[$status]['bg'] }} rounded-full mr-3"></div>
                                <span class="text-sm font-medium text-gray-700">{{ $statusLabels[$status] }}</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900">{{ $bookingStats[$status] }}</span>
                        </div>
                        <div class="w-full h-2 {{ $statusColors[$status]['light'] }} rounded-full overflow-hidden">
                            <div class="{{ $statusColors[$status]['bg'] }} h-full rounded-full transition-all duration-500" 
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('admin.packages.create') }}" 
           class="group bg-gradient-to-br from-primary-500 to-primary-700 text-white rounded-2xl p-5 hover:shadow-xl hover:shadow-primary-500/30 transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <span class="font-semibold text-sm">Tambah Paket</span>
            </div>
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" 
           class="group bg-gradient-to-br from-primary-400 to-primary-600 text-white rounded-2xl p-5 hover:shadow-xl hover:shadow-primary-500/30 transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <span class="font-semibold text-sm">Pending ({{ $stats['pending_bookings'] }})</span>
            </div>
        </a>
        <a href="{{ route('admin.destinations.create') }}" 
           class="group bg-gradient-to-br from-secondary-500 to-secondary-700 text-white rounded-2xl p-5 hover:shadow-xl hover:shadow-secondary-500/30 transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <span class="font-semibold text-sm">Tambah Destinasi</span>
            </div>
        </a>
        <a href="{{ route('admin.contacts.index') }}" 
           class="group bg-gradient-to-br from-primary-600 to-primary-800 text-white rounded-2xl p-5 hover:shadow-xl hover:shadow-primary-500/30 transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform relative">
                    <i class="fas fa-envelope text-xl"></i>
                    @if($stats['unread_messages'] > 0)
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-primary-500 rounded-full text-xs flex items-center justify-center animate-pulse">
                        {{ $stats['unread_messages'] }}
                    </span>
                    @endif
                </div>
                <span class="font-semibold text-sm">Pesan Masuk</span>
            </div>
        </a>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Pemesanan Terbaru</h3>
                <p class="text-sm text-gray-500">10 pemesanan terakhir</p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-primary-50 text-primary-600 rounded-xl font-semibold hover:bg-primary-100 transition text-sm">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kode Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Paket</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentBookings as $booking)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 bg-primary-50 text-primary-700 rounded-lg font-mono text-sm font-semibold">
                                #{{ $booking->booking_code }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
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
                            <p class="text-sm text-gray-900 font-medium line-clamp-1 max-w-[200px]">{{ $booking->package->name ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-primary-100 text-primary-700 border-primary-200',
                                    'confirmed' => 'bg-primary-100 text-primary-700 border-primary-200',
                                    'paid' => 'bg-secondary-100 text-secondary-700 border-secondary-200',
                                    'completed' => 'bg-gray-100 text-gray-700 border-gray-200',
                                    'cancelled' => 'bg-primary-100 text-primary-700 border-primary-200',
                                ];
                                $statusText = [
                                    'pending' => 'Menunggu',
                                    'confirmed' => 'Dikonfirmasi',
                                    'paid' => 'Dibayar',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border {{ $statusClasses[$booking->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $statusText[$booking->status] ?? $booking->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm text-gray-500">{{ $booking->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $booking->created_at->format('H:i') }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="{{ route('admin.bookings.show', $booking) }}" 
                               class="inline-flex items-center justify-center w-9 h-9 bg-primary-50 text-primary-600 rounded-lg hover:bg-primary-100 transition">
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
                                <p class="text-gray-500 font-medium">Belum ada pemesanan</p>
                                <p class="text-gray-400 text-sm">Pemesanan baru akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Create gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.5)');
        gradient.addColorStop(1, 'rgba(99, 102, 241, 0.05)');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_column($revenueData, 'date')) !!},
                datasets: [{
                    label: 'Pendapatan',
                    data: {!! json_encode(array_column($revenueData, 'revenue')) !!},
                    backgroundColor: gradient,
                    borderColor: 'rgb(99, 102, 241)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e1b4b',
                        titleFont: { size: 13, weight: '600' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)',
                        },
                        ticks: {
                            font: { size: 11 },
                            color: '#6b7280',
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000) + 'Jt';
                                }
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 11 },
                            color: '#6b7280'
                        }
                    }
                }
            }
        });
    </script>
    @endpush
@endsection

