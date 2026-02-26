<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Endah Travel Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#fdf2f8', 100: '#fce7f3', 200: '#fbcfe8',
                            300: '#f9a8d4', 400: '#f472b6', 500: '#ec4899',
                            600: '#db2777', 700: '#be185d', 800: '#9d174d',
                            900: '#831843', 950: '#500724',
                        },
                        danger: {
                            50: '#fef2f2', 100: '#fee2e2', 200: '#fecaca',
                            300: '#fca5a5', 400: '#f87171', 500: '#ef4444',
                            600: '#dc2626', 700: '#b91c1c', 800: '#991b1b',
                            900: '#7f1d1d',
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
    
    <!-- Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --sidebar-w: 240px;
            --sidebar-collapsed: 64px;
            --topbar-h: 60px;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f1f5;
            color: #1a1a2e;
        }

        /* ─── SIDEBAR ─── */
        #sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: #080810;
            display: flex;
            flex-direction: column;
            transition: width .25s cubic-bezier(.4,0,.2,1);
            position: fixed;
            left: 0; top: 0; bottom: 0;
            z-index: 40;
            overflow: hidden;
            border-right: 1px solid rgba(236,72,153,.08);
        }
        #sidebar.collapsed { width: var(--sidebar-collapsed); }

        .logo-area {
            height: var(--topbar-h);
            display: flex;
            align-items: center;
            padding: 0 16px;
            border-bottom: 1px solid rgba(236,72,153,.1);
            flex-shrink: 0;
            gap: 10px;
        }
        .logo-icon {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #ec4899, #ef4444);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 13px; color: #fff;
            box-shadow: 0 0 14px rgba(236,72,153,.4);
        }
        .logo-text {
            white-space: nowrap; overflow: hidden;
            opacity: 1; transition: opacity .2s;
        }
        #sidebar.collapsed .logo-text { opacity: 0; width: 0; }

        .nav-section-label {
            padding: 20px 16px 6px;
            font-size: 10px; letter-spacing: .1em; font-weight: 700;
            color: rgba(236,72,153,.3); text-transform: uppercase;
            white-space: nowrap; overflow: hidden;
            transition: opacity .2s;
        }
        #sidebar.collapsed .nav-section-label { opacity: 0; }

        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 12px; margin: 2px 8px;
            border-radius: 8px; color: rgba(255,255,255,.35);
            font-size: 13px; font-weight: 500;
            text-decoration: none;
            transition: background .15s, color .15s;
            white-space: nowrap;
        }
        .nav-link:hover {
            background: rgba(236,72,153,.1);
            color: rgba(255,255,255,.7);
        }
        .nav-link.active {
            background: linear-gradient(90deg, rgba(236,72,153,.2), rgba(239,68,68,.1));
            color: #f472b6;
            border-left: 2px solid #ec4899;
            margin-left: 8px; padding-left: 10px;
        }
        .nav-icon {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 7px; font-size: 13px; flex-shrink: 0;
            transition: background .15s;
        }
        .nav-link:hover .nav-icon { background: rgba(236,72,153,.12); color: #f472b6; }
        .nav-link.active .nav-icon { background: rgba(236,72,153,.2); color: #f472b6; }
        .nav-label { overflow: hidden; transition: opacity .2s, width .2s; }
        #sidebar.collapsed .nav-label { opacity: 0; width: 0; }
        .nav-badge {
            margin-left: auto; color: #fff; font-size: 10px; font-weight: 700;
            padding: 1px 6px; border-radius: 10px; flex-shrink: 0;
            transition: opacity .2s;
        }
        #sidebar.collapsed .nav-badge { opacity: 0; width: 0; padding: 0; overflow: hidden; }

        /* ─── SIDEBAR SCROLL ─── */
        nav::-webkit-scrollbar { width: 3px; }
        nav::-webkit-scrollbar-track { background: transparent; }
        nav::-webkit-scrollbar-thumb { background: rgba(236,72,153,.2); border-radius: 4px; }

        /* ─── DIVIDER ─── */
        .sb-divider {
            height: 1px;
            background: rgba(236,72,153,.07);
            margin: 6px 12px;
        }

        /* ─── MAIN ─── */
        #main-wrapper {
            margin-left: var(--sidebar-w);
            transition: margin-left .25s cubic-bezier(.4,0,.2,1);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }
        #main-wrapper.sb-collapsed { margin-left: var(--sidebar-collapsed); }

        /* ─── TOPBAR ─── */
        #topbar {
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #ececf4;
            display: flex; align-items: center;
            padding: 0 24px; gap: 12px;
            position: sticky; top: 0; z-index: 30;
        }

        /* ─── PAGE ─── */
        #page-content { flex:1; padding: 24px 28px; }

        /* ─── SCROLLBAR ─── */
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #f9a8d4; border-radius: 4px; }

        /* ─── TOAST ─── */
        .toast { animation: slideInRight .3s ease; }
        @keyframes slideInRight {
            from { transform: translateX(30px); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }

        /* ─── MOBILE ─── */
        #mobile-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.6); z-index: 39;
            backdrop-filter: blur(3px);
        }
        #mobile-overlay.open { display: block; }

        @media (max-width: 1023px) {
            #sidebar { left: calc(-1 * var(--sidebar-w)); width: var(--sidebar-w) !important; transition: left .25s; }
            #sidebar.mobile-open { left: 0; }
            #main-wrapper { margin-left: 0 !important; }
        }

        .font-display { font-family: 'Sora', 'Inter', sans-serif; }
    </style>
    
    @stack('styles')
</head>
<body x-data="{
    sc: localStorage.getItem('sb_c') === '1',
    mob: false,
    toggle() {
        this.sc = !this.sc;
        localStorage.setItem('sb_c', this.sc ? '1' : '0');
        document.getElementById('sidebar').classList.toggle('collapsed', this.sc);
        document.getElementById('main-wrapper').classList.toggle('sb-collapsed', this.sc);
    },
    openMob() {
        this.mob = true;
        document.getElementById('sidebar').classList.add('mobile-open');
        document.getElementById('mobile-overlay').classList.add('open');
    },
    closeMob() {
        this.mob = false;
        document.getElementById('sidebar').classList.remove('mobile-open');
        document.getElementById('mobile-overlay').classList.remove('open');
    }
}" x-init="
    document.getElementById('sidebar').classList.toggle('collapsed', sc);
    document.getElementById('main-wrapper').classList.toggle('sb-collapsed', sc);
">

<!-- Mobile Overlay -->
<div id="mobile-overlay" @click="closeMob()"></div>

<!-- ══════════════════════ SIDEBAR ══════════════════════ -->
<aside id="sidebar">
    <div class="logo-area">
        <div class="logo-icon"><i class="fas fa-bus-simple"></i></div>
        <div class="logo-text">
            <div class="text-white text-sm font-bold leading-none" style="font-family:'Sora',sans-serif">EndahTrans</div>
            <div class="text-xs mt-0.5" style="color:rgba(236,72,153,.45)">Admin Panel</div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto overflow-x-hidden pb-4">

        <div class="nav-section-label">Utama</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
            <span class="nav-label">Dashboard</span>
        </a>

        <a href="{{ route('admin.bookings.index') }}"
           class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-ticket"></i></span>
            <span class="nav-label">Pemesanan Paket</span>
            @php $pendingCount = \App\Models\Booking::where('status','pending')->count(); @endphp
            @if($pendingCount > 0)
                <span class="nav-badge" style="background:#ef4444;">{{ $pendingCount }}</span>
            @endif
        </a>

        <a href="{{ route('admin.charter-bookings.index') }}"
           class="nav-link {{ request()->routeIs('admin.charter-bookings.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-bus"></i></span>
            <span class="nav-label">Charter Armada</span>
            @php $pendingCharter = \App\Models\CharterBooking::where('status','pending')->count(); @endphp
            @if($pendingCharter > 0)
                <span class="nav-badge" style="background:#ec4899;">{{ $pendingCharter }}</span>
            @endif
        </a>

        <div class="sb-divider"></div>

        <div class="nav-section-label">Konten</div>

        <a href="{{ route('admin.destinations.index') }}"
           class="nav-link {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-map-location-dot"></i></span>
            <span class="nav-label">Destinasi</span>
        </a>

        <a href="{{ route('admin.testimonials.index') }}"
           class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-star"></i></span>
            <span class="nav-label">Testimoni</span>
        </a>

        <a href="{{ route('admin.route-videos.index') }}"
           class="nav-link {{ request()->routeIs('admin.route-videos.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-video"></i></span>
            <span class="nav-label">Video Rute</span>
        </a>

        <div class="sb-divider"></div>

        <div class="nav-section-label">Lainnya</div>

        <a href="{{ route('admin.contacts.index') }}"
           class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-inbox"></i></span>
            <span class="nav-label">Pesan Masuk</span>
            @php $unreadCount = \App\Models\Contact::where('is_read', false)->count(); @endphp
            @if($unreadCount > 0)
                <span class="nav-badge" style="background:#8b5cf6;">{{ $unreadCount }}</span>
            @endif
        </a>

        <a href="{{ route('admin.teams.index') }}"
           class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-users"></i></span>
            <span class="nav-label">Tim Profesional</span>
        </a>

        <a href="{{ route('home') }}" target="_blank" class="nav-link">
            <span class="nav-icon"><i class="fas fa-arrow-up-right-from-square"></i></span>
            <span class="nav-label">Lihat Website</span>
        </a>
    </nav>

    <!-- Collapse toggle -->
    <div style="padding:10px 8px; border-top:1px solid rgba(255,255,255,.06); flex-shrink:0;">
        <button @click="toggle()"
                style="width:100%; display:flex; align-items:center; justify-content:center; gap:6px;
                       padding:9px; border-radius:8px; font-size:12px; font-family:Inter;
                       background:none; border:none; cursor:pointer;
                       color:rgba(236,72,153,.3); transition: background .15s, color .15s;"
                onmouseover="this.style.background='rgba(236,72,153,.08)';this.style.color='rgba(244,114,182,.7)'"
                onmouseout="this.style.background='none';this.style.color='rgba(236,72,153,.3)'">
            <i :class="sc ? 'fa-chevron-right' : 'fa-chevron-left'" class="fas text-xs"></i>
            <span x-show="!sc" style="white-space:nowrap;">Sembunyikan</span>
        </button>
    </div>
</aside>

<!-- ══════════════════════ MAIN ══════════════════════ -->
<div id="main-wrapper">

    <!-- Topbar -->
    <header id="topbar">
        <button class="lg:hidden w-9 h-9 flex items-center justify-center rounded-xl hover:bg-pink-50 text-gray-500 hover:text-brand-600 transition"
                @click="openMob()">
            <i class="fas fa-bars text-sm"></i>
        </button>
        <button class="hidden lg:flex w-9 h-9 items-center justify-center rounded-xl hover:bg-pink-50 text-gray-400 hover:text-brand-600 transition"
                @click="toggle()">
            <i class="fas fa-bars text-sm"></i>
        </button>

        <div class="flex-1 min-w-0">
            <h1 class="text-sm font-semibold text-gray-800 leading-none">@yield('page-title', 'Dashboard')</h1>
            <p class="text-xs text-gray-400 mt-0.5 hidden sm:block">@yield('page-subtitle', '')</p>
        </div>

        <div class="flex items-center gap-2">
            @php $todayBookings = \App\Models\Booking::whereDate('created_at', today())->count(); @endphp
            <div class="hidden md:inline-flex items-center gap-1.5 bg-pink-50 text-brand-700 text-xs font-semibold px-3 py-1.5 rounded-full border border-pink-100">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span>
                {{ $todayBookings }} booking hari ini
            </div>

            <!-- Bell -->
            @php
                $pb = \App\Models\Booking::where('status','pending')->count();
                $pc = \App\Models\CharterBooking::where('status','pending')->count();
                $ur = \App\Models\Contact::where('is_read',false)->count();
                $totalAlerts = $pb + $pc + $ur;
            @endphp
            <div x-data="{open:false}" class="relative">
                <button @click="open=!open"
                        class="relative w-9 h-9 flex items-center justify-center rounded-xl hover:bg-gray-100 text-gray-500 hover:text-gray-700 transition">
                    <i class="fas fa-bell text-sm"></i>
                    @if($totalAlerts > 0)
                    <span class="absolute top-2 right-2 w-1.5 h-1.5 bg-red-500 rounded-full border border-white"></span>
                    @endif
                </button>
                <div x-show="open" @click.away="open=false"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     class="absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50">
                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                        <p class="text-xs font-bold text-gray-600 uppercase tracking-wider">Notifikasi</p>
                    </div>
                    @if($pb > 0)
                    <a href="{{ route('admin.bookings.index', ['status'=>'pending']) }}"
                       class="flex items-center gap-3 px-4 py-3 hover:bg-pink-50 transition">
                        <div class="w-8 h-8 rounded-xl bg-pink-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-ticket text-brand-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-800">{{ $pb }} pemesanan paket pending</p>
                            <p class="text-xs text-gray-400">Menunggu konfirmasi</p>
                        </div>
                    </a>
                    @endif
                    @if($pc > 0)
                    <a href="{{ route('admin.charter-bookings.index', ['status'=>'pending']) }}"
                       class="flex items-center gap-3 px-4 py-3 hover:bg-red-50 transition">
                        <div class="w-8 h-8 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-bus text-danger-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-800">{{ $pc }} charter pending</p>
                            <p class="text-xs text-gray-400">Belum dikonfirmasi</p>
                        </div>
                    </a>
                    @endif
                    @if($ur > 0)
                    <a href="{{ route('admin.contacts.index') }}"
                       class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition">
                        <div class="w-8 h-8 rounded-xl bg-violet-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-violet-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-800">{{ $ur }} pesan belum dibaca</p>
                            <p class="text-xs text-gray-400">Pesan masuk baru</p>
                        </div>
                    </a>
                    @endif
                    @if($totalAlerts === 0)
                    <div class="px-4 py-8 text-center">
                        <i class="fas fa-check-circle text-emerald-400 text-2xl mb-2 block"></i>
                        <p class="text-xs text-gray-500">Semua sudah ditangani!</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- User -->
            <div x-data="{open:false}" class="relative">
                <button @click="open=!open"
                        class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl hover:bg-gray-100 transition">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center text-white text-xs font-bold" style="background:linear-gradient(135deg,#ec4899,#ef4444);">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-xs font-semibold text-gray-800 leading-none">{{ \Illuminate\Support\Str::limit(auth()->user()->name ?? 'Admin', 14) }}</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Administrator</p>
                    </div>
                    <i class="fas fa-chevron-down text-[9px] text-gray-400"></i>
                </button>
                <div x-show="open" @click.away="open=false"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-400">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                    <a href="{{ route('home') }}" target="_blank"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-pink-50 transition">
                        <i class="fas fa-globe w-4 text-gray-400"></i> Lihat Website
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                            <i class="fas fa-right-from-bracket w-4"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main id="page-content">

        @if(session('success'))
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,5000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="toast mb-5 flex items-center gap-3 bg-white border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl shadow-lg shadow-emerald-500/10">
            <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-circle-check text-emerald-600 text-xs"></i>
            </div>
            <span class="text-sm font-medium flex-1">{{ session('success') }}</span>
            <button @click="show=false" class="text-gray-400 hover:text-gray-600 text-xs transition"><i class="fas fa-xmark"></i></button>
        </div>
        @endif

        @if(session('error'))
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,6000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="toast mb-5 flex items-center gap-3 bg-white border border-red-200 text-red-800 px-4 py-3 rounded-2xl shadow-lg shadow-red-500/10">
            <div class="w-7 h-7 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-circle-exclamation text-red-600 text-xs"></i>
            </div>
            <span class="text-sm font-medium flex-1">{{ session('error') }}</span>
            <button @click="show=false" class="text-gray-400 hover:text-gray-600 text-xs transition"><i class="fas fa-xmark"></i></button>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-5 bg-white border border-red-200 rounded-2xl px-5 py-4 shadow-sm">
            <p class="text-sm font-semibold text-red-700 mb-2 flex items-center gap-2">
                <i class="fas fa-triangle-exclamation"></i> Terdapat kesalahan:
            </p>
            <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>

