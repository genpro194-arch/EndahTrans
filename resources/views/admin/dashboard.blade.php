@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan performa bisnis Anda')

@section('content')
    <!-- Welcome Section -->
    <div class="mb-12">
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 rounded-2xl p-8 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <p class="text-sm font-semibold text-slate-400 mb-2 uppercase tracking-widest">Selamat Datang Kembali</p>
                    <h1 class="text-4xl md:text-5xl font-bold mb-3">{{ auth()->user()->name ?? 'Admin' }} 👋</h1>
                    <p class="text-slate-300 text-lg">Pantau performa bisnis Endah Travel secara real-time</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.packages.create') }}" 
                       class="inline-flex items-center justify-center px-7 py-3.5 bg-white text-slate-900 rounded-xl font-bold hover:bg-slate-100 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i> Paket Baru
                    </a>
                    <a href="{{ route('admin.destinations.create') }}" 
                       class="inline-flex items-center justify-center px-7 py-3.5 bg-slate-700 hover:bg-slate-600 text-white rounded-xl font-bold transition-all duration-200 border border-slate-600">
                        <i class="fas fa-map-marker-alt mr-2"></i> Destinasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1: Total Bookings -->
        <div id="totalBookingsCard" class="group bg-white rounded-2xl p-7 hover:shadow-xl transition-all duration-300 border border-slate-200">
            <div class="flex items-start justify-between mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                </div>
                <span class="text-xs font-extrabold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg">TOTAL</span>
            </div>
            <div class="space-y-1 mb-5">
                <h3 id="totalBookingsAmount" class="text-4xl font-black text-slate-900">{{ $stats['total_bookings'] }}</h3>
                <p class="text-sm text-slate-600 font-medium">Total Pemesanan</p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 text-sm font-bold hover:text-blue-700 transition inline-flex items-center gap-2">
                Lihat Detail <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- Card 2: Pending -->
        <div id="pendingBookingsCard" class="group bg-white rounded-2xl p-7 hover:shadow-xl transition-all duration-300 border border-slate-200">
            <div class="flex items-start justify-between mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-hourglass-end text-amber-600 text-xl"></i>
                </div>
                @if($stats['pending_bookings'] > 0)
                <span class="text-xs font-extrabold text-red-600 bg-red-50 px-3 py-1.5 rounded-lg animate-pulse">
                    ⚠️ {{ $stats['pending_bookings'] }} AKSI
                </span>
                @else
                <span class="text-xs font-extrabold text-green-600 bg-green-50 px-3 py-1.5 rounded-lg">✓ AMAN</span>
                @endif
            </div>
            <div class="space-y-1 mb-5">
                <h3 id="pendingBookingsAmount" class="text-4xl font-black text-slate-900">{{ $stats['pending_bookings'] }}</h3>
                <p class="text-sm text-slate-600 font-medium">Menunggu Konfirmasi</p>
            </div>
            <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="text-amber-600 text-sm font-bold hover:text-amber-700 transition inline-flex items-center gap-2">
                Konfirmasi <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- Card 3: Revenue -->
        <div id="revenueCard" class="group bg-white rounded-2xl p-7 hover:shadow-xl transition-all duration-300 border border-slate-200">
            <div class="flex items-start justify-between mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-chart-line text-emerald-600 text-xl"></i>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-extrabold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg">📈 +12%</span>
                    <span id="revenueUpdateIndicator" class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                </div>
            </div>
            <div class="space-y-1 mb-5">
                <h3 id="revenueAmount" class="text-3xl font-black text-slate-900">Rp {{ number_format($stats['total_revenue'] / 1000000, 1) }}Jt</h3>
                <p class="text-sm text-slate-600 font-medium">Total Pendapatan</p>
            </div>
            <p id="revenueTimestamp" class="text-emerald-600 text-xs font-bold">Diperbarui: now</p>
        </div>

        <!-- Card 4: Packages -->
        <div class="group bg-white rounded-2xl p-7 hover:shadow-xl transition-all duration-300 border border-slate-200">
            <div class="flex items-start justify-between mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-suitcase-rolling text-purple-600 text-xl"></i>
                </div>
                <span class="text-xs font-extrabold text-purple-600 bg-purple-50 px-3 py-1.5 rounded-lg">AKTIF</span>
            </div>
            <div class="space-y-1 mb-5">
                <h3 class="text-4xl font-black text-slate-900">{{ $stats['active_packages'] }}</h3>
                <p class="text-sm text-slate-600 font-medium">Paket Wisata</p>
            </div>
            <a href="{{ route('admin.packages.index') }}" class="text-purple-600 text-sm font-bold hover:text-purple-700 transition inline-flex items-center gap-2">
                Kelola <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>

    <!-- Chart & Status Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition-all duration-300">
            <div class="mb-8">
                <div class="flex items-baseline gap-3">
                    <h3 class="text-2xl font-bold text-slate-900">Pendapatan</h3>
                    <span class="text-sm text-slate-500">7 Hari Terakhir</span>
                </div>
                <p class="text-slate-600 text-sm mt-2">Pantau tren pendapatan bisnis Anda</p>
            </div>
            <div class="h-80">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-lg transition-all duration-300">
            <h3 class="text-2xl font-bold text-slate-900 mb-8">Status Pemesanan</h3>
            <div class="space-y-6">
                @php
                    $statusLabels = [
                        'pending' => 'Menunggu',
                        'confirmed' => 'Dikonfirmasi',
                        'paid' => 'Dibayar',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ];
                    $statusColors = [
                        'pending' => ['bar' => 'bg-amber-500', 'light' => 'bg-amber-50'],
                        'confirmed' => ['bar' => 'bg-blue-500', 'light' => 'bg-blue-50'],
                        'paid' => ['bar' => 'bg-emerald-500', 'light' => 'bg-emerald-50'],
                        'completed' => ['bar' => 'bg-green-500', 'light' => 'bg-green-50'],
                        'cancelled' => ['bar' => 'bg-red-500', 'light' => 'bg-red-50'],
                    ];
                    $totalBookings = max(array_sum($bookingStats), 1);
                @endphp
                
                @foreach(['pending', 'confirmed', 'paid', 'completed', 'cancelled'] as $status)
                    @php $percentage = round(($bookingStats[$status] / $totalBookings) * 100); @endphp
                    <div class="group">
                        <div class="flex justify-between items-baseline mb-3">
                            <span class="text-sm font-semibold text-slate-700">{{ $statusLabels[$status] }}</span>
                            <div class="text-right">
                                <span class="text-lg font-black text-slate-900">{{ $bookingStats[$status] }}</span>
                                <span class="text-xs text-slate-500 ml-2">{{ $percentage }}%</span>
                            </div>
                        </div>
                        <div class="h-3 {{ $statusColors[$status]['light'] }} rounded-full overflow-hidden">
                            <div class="h-full {{ $statusColors[$status]['bar'] }} rounded-full transition-all duration-500 group-hover:shadow-lg group-hover:brightness-110" 
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-5 mb-10">
        <a href="{{ route('admin.packages.create') }}" 
           class="group relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-blue-300 hover:shadow-lg hover:bg-blue-50/50 transition-all duration-300 text-center">
            <div class="w-12 h-12 bg-blue-100 group-hover:bg-blue-200 rounded-xl flex items-center justify-center mx-auto mb-4 transition-colors">
                <i class="fas fa-plus text-blue-600 text-lg font-bold"></i>
            </div>
            <p class="text-sm font-bold text-slate-900">Paket Baru</p>
            <p class="text-xs text-slate-500 mt-1">Buat paket wisata</p>
        </a>
        
        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" 
           class="group relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-amber-300 hover:shadow-lg hover:bg-amber-50/50 transition-all duration-300 text-center">
            <div class="absolute -top-3 -right-3 w-7 h-7 bg-red-500 text-white rounded-full text-xs font-black flex items-center justify-center">
                {{ $stats['pending_bookings'] }}
            </div>
            <div class="w-12 h-12 bg-amber-100 group-hover:bg-amber-200 rounded-xl flex items-center justify-center mx-auto mb-4 transition-colors">
                <i class="fas fa-hourglass-end text-amber-600 text-lg font-bold"></i>
            </div>
            <p class="text-sm font-bold text-slate-900">Pending</p>
            <p class="text-xs text-slate-500 mt-1">Konfirmasi</p>
        </a>
        
        <a href="{{ route('admin.destinations.index') }}" 
           class="group relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-emerald-300 hover:shadow-lg hover:bg-emerald-50/50 transition-all duration-300 text-center">
            <div class="w-12 h-12 bg-emerald-100 group-hover:bg-emerald-200 rounded-xl flex items-center justify-center mx-auto mb-4 transition-colors">
                <i class="fas fa-globe text-emerald-600 text-lg font-bold"></i>
            </div>
            <p class="text-sm font-bold text-slate-900">Destinasi</p>
            <p class="text-xs text-slate-500 mt-1">{{ $stats['total_destinations'] }} aktif</p>
        </a>
        
        <a href="{{ route('admin.contacts.index') }}" 
           class="group relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-purple-300 hover:shadow-lg hover:bg-purple-50/50 transition-all duration-300 text-center">
            <div class="absolute -top-3 -right-3 w-7 h-7 bg-red-500 text-white rounded-full text-xs font-black flex items-center justify-center animate-pulse">
                {{ $stats['unread_messages'] }}
            </div>
            <div class="w-12 h-12 bg-purple-100 group-hover:bg-purple-200 rounded-xl flex items-center justify-center mx-auto mb-4 transition-colors">
                <i class="fas fa-envelope text-purple-600 text-lg font-bold"></i>
            </div>
            <p class="text-sm font-bold text-slate-900">Pesan</p>
            <p class="text-xs text-slate-500 mt-1">Pesan masuk</p>
        </a>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-lg transition-all duration-300">
        <div class="px-8 py-7 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-transparent">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-slate-900">Pemesanan Terbaru</h3>
                    <p class="text-slate-600 text-sm mt-1">10 pemesanan terakhir dari pelanggan Anda</p>
                </div>
                <a href="{{ route('admin.bookings.index') }}" 
                   class="text-blue-600 text-sm font-bold hover:text-blue-700 transition inline-flex items-center gap-2">
                    Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/50">
                        <th class="px-8 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Booking ID</th>
                        <th class="px-8 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-8 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Paket</th>
                        <th class="px-8 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Total</th>
                        <th class="px-8 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-8 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-8 py-4 text-center text-xs font-bold text-slate-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($recentBookings as $booking)
                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                        <td class="px-8 py-5 whitespace-nowrap">
                            <span class="text-xs font-black text-blue-600 font-mono bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-200">
                                {{ substr($booking->booking_code, 0, 8) }}
                            </span>
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap">
                            <div>
                                <p class="text-sm font-bold text-slate-900">{{ \Illuminate\Support\Str::limit($booking->customer_name, 20) }}</p>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">{{ $booking->customer_phone }}</p>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-semibold text-slate-900 line-clamp-1">{{ $booking->package->name ?? '-' }}</p>
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap">
                            <span class="text-sm font-black text-slate-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap">
                            @php
                                $statusMap = [
                                    'pending' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'label' => 'Menunggu'],
                                    'confirmed' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'label' => 'Dikonfirmasi'],
                                    'paid' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'label' => 'Dibayar'],
                                    'completed' => ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'border' => 'border-green-200', 'label' => 'Selesai'],
                                    'cancelled' => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'border' => 'border-red-200', 'label' => 'Dibatalkan'],
                                ];
                                $status = $statusMap[$booking->status] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'border' => 'border-slate-200', 'label' => ucfirst($booking->status)];
                            @endphp
                            <span class="text-xs font-bold px-3 py-1.5 rounded-lg border {{ $status['bg'] }} {{ $status['text'] }} {{ $status['border'] }}">
                                {{ $status['label'] }}
                            </span>
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $booking->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">{{ $booking->created_at->format('H:i') }}</p>
                            </div>
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap text-center">
                            <a href="{{ route('admin.bookings.show', $booking) }}" 
                               class="inline-flex items-center justify-center w-9 h-9 text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 border border-transparent hover:border-blue-200">
                                <i class="fas fa-eye text-sm font-bold"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-8 py-20 text-center">
                            <p class="text-slate-600 font-bold text-lg">Belum ada pemesanan</p>
                            <p class="text-slate-500 text-sm mt-2">Pemesanan baru akan muncul di sini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart');
        if (ctx) {
            new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($revenueData, 'date')) !!},
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: {!! json_encode(array_column($revenueData, 'revenue')) !!},
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#3B82F6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: {
                                color: '#64748B',
                                font: { size: 12 },
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000000).toFixed(0) + 'Jt';
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748B', font: { size: 12 } }
                        }
                    }
                }
            });
        }

        // Auto-update revenue and stats every 30 seconds
        function updateDashboardData() {
            fetch('{{ route("admin.revenue-update") }}')
                .then(response => response.json())
                .then(data => {
                    // Update Revenue Card
                    const revenueAmount = document.getElementById('revenueAmount');
                    const revenueTimestamp = document.getElementById('revenueTimestamp');
                    const indicator = document.getElementById('revenueUpdateIndicator');

                    if (revenueAmount && revenueTimestamp) {
                        revenueAmount.textContent = data.total_revenue_formatted;
                        revenueTimestamp.textContent = 'Diperbarui: ' + data.updated_at;

                        // Pulse effect on update indicator
                        if (indicator) {
                            indicator.style.animation = 'none';
                            setTimeout(() => {
                                indicator.style.animation = '';
                            }, 10);
                        }
                    }

                    // Update Total Bookings Card
                    const totalBookingsAmount = document.getElementById('totalBookingsAmount');
                    if (totalBookingsAmount) {
                        totalBookingsAmount.textContent = data.total_bookings;
                    }

                    // Update Pending Bookings Card
                    const pendingBookingsAmount = document.getElementById('pendingBookingsAmount');
                    if (pendingBookingsAmount) {
                        pendingBookingsAmount.textContent = data.pending_bookings;
                    }

                    // Update Active Packages info in real-time (optional)
                    console.log('Dashboard updated at:', data.updated_at);
                })
                .catch(error => console.error('Dashboard update error:', error));
        }

        // Update immediately on page load
        updateDashboardData();

        // Update every 30 seconds
        setInterval(updateDashboardData, 30000);
    </script>
    @endpush
@endsection

