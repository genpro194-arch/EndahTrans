<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Endah Travel</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc',
                            400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca',
                            800: '#3730a3', 900: '#312e81',
                        },
                        secondary: {
                            50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7',
                            400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e1b4b 0%, #312e81 50%, #3730a3 100%);
        }
        .nav-item-active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.3) 0%, transparent 100%);
            border-left: 3px solid #818cf8;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .stat-card {
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.1) 50%, transparent 60%);
            transform: rotate(45deg);
            transition: all 0.5s;
        }
        .stat-card:hover::before {
            right: 100%;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: true, mobileSidebar: false }">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-48' : 'w-18'" 
               class="hidden lg:flex flex-col sidebar-gradient text-white transition-all duration-300 ease-in-out shadow-2xl">
            <!-- Logo -->
            <div class="flex items-center h-14 px-3">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <!-- Admin Logo Image or Icon -->
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="Endah Travel Logo" class="h-8 mr-2 rounded">
                    @else
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur">
                            <i class="fas fa-plane-departure text-sm text-white"></i>
                        </div>
                    @endif
                    <div x-show="sidebarOpen" class="ml-2" x-transition>
                        <span class="text-sm font-bold">Endah</span>
                    </div>
                </a>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-3">
                <div class="px-3 mb-2" x-show="sidebarOpen">
                    <p class="text-xs uppercase text-primary-300 tracking-wider font-semibold">Menu</p>
                </div>
                <ul class="space-y-0.5 px-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center px-2.5 py-2.5 rounded-lg transition-all duration-200 group
                                  {{ request()->routeIs('admin.dashboard') ? 'nav-item-active bg-white/10 text-white' : 'text-primary-200 hover:bg-white/5 hover:text-white' }}">
                            <div class="w-8 h-8 rounded flex items-center justify-center transition-all text-sm
                                        {{ request()->routeIs('admin.dashboard') ? 'bg-primary-500' : 'bg-white/10 group-hover:bg-primary-500/50' }}">
                                <i class="fas fa-th-large"></i>
                            </div>
                            <span x-show="sidebarOpen" class="ml-2 font-medium text-xs">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings.index') }}" 
                           class="flex items-center px-2.5 py-2.5 rounded-lg transition-all duration-200 group
                                  {{ request()->routeIs('admin.bookings.*') ? 'nav-item-active bg-white/10 text-white' : 'text-primary-200 hover:bg-white/5 hover:text-white' }}">
                            <div class="w-8 h-8 rounded flex items-center justify-center transition-all text-sm
                                        {{ request()->routeIs('admin.bookings.*') ? 'bg-secondary-500' : 'bg-white/10 group-hover:bg-secondary-500/50' }}">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <span x-show="sidebarOpen" class="ml-2 font-medium text-xs">Booking</span>
                            @php $pendingCount = \App\Models\Booking::where('status', 'pending')->count(); @endphp
                            @if($pendingCount > 0)
                                <span x-show="sidebarOpen" class="ml-auto bg-red-500 text-xs px-1.5 py-0.5 rounded-full font-semibold animate-pulse text-white text-2xs">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.packages.index') }}" 
                           class="flex items-center px-2.5 py-2.5 rounded-lg transition-all duration-200 group
                                  {{ request()->routeIs('admin.packages.*') ? 'nav-item-active bg-white/10 text-white' : 'text-primary-200 hover:bg-white/5 hover:text-white' }}">
                            <div class="w-8 h-8 rounded flex items-center justify-center transition-all text-sm
                                        {{ request()->routeIs('admin.packages.*') ? 'bg-primary-500' : 'bg-white/10 group-hover:bg-primary-500/50' }}">
                                <i class="fas fa-suitcase-rolling"></i>
                            </div>
                            <span x-show="sidebarOpen" class="ml-2 font-medium text-xs">Paket</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.destinations.index') }}" 
                           class="flex items-center px-2.5 py-2.5 rounded-lg transition-all duration-200 group
                                  {{ request()->routeIs('admin.destinations.*') ? 'nav-item-active bg-white/10 text-white' : 'text-primary-200 hover:bg-white/5 hover:text-white' }}">
                            <div class="w-8 h-8 rounded flex items-center justify-center transition-all text-sm
                                        {{ request()->routeIs('admin.destinations.*') ? 'bg-secondary-500' : 'bg-white/10 group-hover:bg-secondary-500/50' }}">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <span x-show="sidebarOpen" class="ml-2 font-medium text-xs">Destinasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.index') }}" 
                           class="flex items-center px-2.5 py-2.5 rounded-lg transition-all duration-200 group
                                  {{ request()->routeIs('admin.contacts.*') ? 'nav-item-active bg-white/10 text-white' : 'text-primary-200 hover:bg-white/5 hover:text-white' }}">
                            <div class="w-8 h-8 rounded flex items-center justify-center transition-all text-sm
                                        {{ request()->routeIs('admin.contacts.*') ? 'bg-primary-400' : 'bg-white/10 group-hover:bg-primary-400/50' }}">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <span x-show="sidebarOpen" class="ml-2 font-medium text-xs">Pesan</span>
                            @php $unreadCount = \App\Models\Contact::where('is_read', false)->count(); @endphp
                            @if($unreadCount > 0)
                                <span x-show="sidebarOpen" class="ml-auto bg-primary-400 text-primary-900 text-xs px-1.5 py-0.5 rounded-full font-semibold text-2xs">{{ $unreadCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.teams.index') }}" 
                           class="flex items-center px-2.5 py-2.5 rounded-lg transition-all duration-200 group
                                  {{ request()->routeIs('admin.teams.*') ? 'nav-item-active bg-white/10 text-white' : 'text-primary-200 hover:bg-white/5 hover:text-white' }}">
                            <div class="w-8 h-8 rounded flex items-center justify-center transition-all text-sm
                                        {{ request()->routeIs('admin.teams.*') ? 'bg-secondary-500' : 'bg-white/10 group-hover:bg-secondary-500/50' }}">
                                <i class="fas fa-users"></i>
                            </div>
                            <span x-show="sidebarOpen" class="ml-2 font-medium text-xs">Tim Profesional</span>
                        </a>
                    </li>
                </ul>
                
                <div class="mt-4 px-3" x-show="sidebarOpen">
                    <p class="text-xs uppercase text-primary-300 tracking-wider font-semibold mb-2">Lainnya</p>
                </div>
                <ul class="space-y-0.5 px-2">
                    <li>
                        <a href="{{ route('home') }}" target="_blank"
                           class="flex items-center px-2.5 py-2.5 text-primary-200 rounded-lg hover:bg-white/5 hover:text-white transition-all duration-200 group">
                            <div class="w-8 h-8 bg-white/10 rounded flex items-center justify-center group-hover:bg-white/20 transition-all text-sm">
                                <i class="fas fa-external-link-alt"></i>
                            </div>
                            <span x-show="sidebarOpen" class="ml-2 font-medium text-xs">Website</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="p-2 border-t border-white/10">
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="w-full flex items-center justify-center py-2 text-primary-300 hover:text-white hover:bg-white/10 rounded-lg transition text-xs">
                    <i :class="sidebarOpen ? 'fa-angles-left' : 'fa-angles-right'" class="fas"></i>
                    <span x-show="sidebarOpen" class="ml-1.5 text-2xs">Tutup</span>
                </button>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <div x-show="mobileSidebar" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 lg:hidden">
            <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm" @click="mobileSidebar = false"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full sidebar-gradient"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
                <div class="absolute top-4 right-4">
                    <button @click="mobileSidebar = false" class="p-2 rounded-lg bg-white/10 text-white hover:bg-white/20 transition">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                <div class="flex items-center h-20 px-6">
                    <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-plane-departure text-xl text-white"></i>
                    </div>
                    <div class="ml-3">
                        <span class="text-xl font-bold text-white">Endah Travel</span>
                        <p class="text-xs text-primary-300">Admin Panel</p>
                    </div>
                </div>
                <nav class="flex-1 overflow-y-auto py-6">
                    <ul class="space-y-1 px-3">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3.5 text-white rounded-xl hover:bg-white/10 transition">
                                <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-th-large"></i>
                                </div>
                                <span class="ml-3 font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-4 py-3.5 text-white rounded-xl hover:bg-white/10 transition">
                                <div class="w-10 h-10 bg-secondary-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <span class="ml-3 font-medium">Pemesanan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.packages.index') }}" class="flex items-center px-4 py-3.5 text-white rounded-xl hover:bg-white/10 transition">
                                <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-suitcase-rolling"></i>
                                </div>
                                <span class="ml-3 font-medium">Paket Wisata</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.destinations.index') }}" class="flex items-center px-4 py-3.5 text-white rounded-xl hover:bg-white/10 transition">
                                <div class="w-10 h-10 bg-secondary-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <span class="ml-3 font-medium">Destinasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-3.5 text-white rounded-xl hover:bg-white/10 transition">
                                <div class="w-10 h-10 bg-primary-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <span class="ml-3 font-medium">Pesan Masuk</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="h-20 bg-white shadow-sm flex items-center justify-between px-6 border-b border-gray-100">
                <div class="flex items-center">
                    <button @click="mobileSidebar = true" class="lg:hidden p-2 -ml-2 text-gray-600 hover:text-primary-600 hover:bg-gray-100 rounded-lg mr-3">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-gray-500">@yield('page-subtitle', 'Selamat datang di Admin Panel')</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <!-- Quick Stats -->
                    <div class="hidden md:flex items-center gap-4 pr-4 border-r border-gray-200">
                        @php $todayBookings = \App\Models\Booking::whereDate('created_at', today())->count(); @endphp
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Booking Hari Ini</p>
                            <p class="text-lg font-bold text-primary-600">{{ $todayBookings }}</p>
                        </div>
                    </div>
                    
                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-100 transition">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-primary-500/30">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email ?? 'admin@endahtravel.com' }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition flex items-center">
                                    <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Flash Messages -->
                @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mb-6 bg-gradient-to-r from-secondary-500 to-secondary-600 text-white px-5 py-4 rounded-2xl flex justify-between items-center shadow-lg shadow-secondary-500/30">
                    <span class="flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-check"></i>
                        </div>
                        {{ session('success') }}
                    </span>
                    <button @click="show = false" class="p-1 hover:bg-white/20 rounded-lg transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     class="mb-6 bg-gradient-to-r from-red-500 to-red-600 text-white px-5 py-4 rounded-2xl flex justify-between items-center shadow-lg shadow-red-500/30">
                    <span class="flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        {{ session('error') }}
                    </span>
                    <button @click="show = false" class="p-1 hover:bg-white/20 rounded-lg transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-5 py-4 rounded-r-2xl">
                    <p class="font-semibold mb-2"><i class="fas fa-exclamation-circle mr-2"></i>Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

