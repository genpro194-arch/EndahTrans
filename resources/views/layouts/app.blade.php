<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Endah Travel - Jasa travel dan perjalanan wisata terpercaya dengan harga terjangkau">
    <title>@yield('title', 'Endah Travel - Perjalanan Wisata Terpercaya')</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        },
                        secondary: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            200: '#fbcfe8',
                            300: '#f9a8d4',
                            400: '#f472b6',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                            800: '#9d174d',
                            900: '#831843',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite',
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #1e293b;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #dc2626, #db2777);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #b91c1c, #be185d);
        }
        
        /* Hero Gradient */
        .hero-gradient {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.85) 0%, rgba(219, 39, 119, 0.75) 100%);
        }
        
        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        .glass-dark {
            background: rgba(17, 24, 39, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Button Gradient */
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(79, 70, 229, 0.4);
        }
        
        .btn-gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient-green:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(16, 185, 129, 0.4);
        }
        
        .btn-gradient-orange {
            background: linear-gradient(135deg, #6366f1 0%, #10b981 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient-orange:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #059669 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.4);
        }
        
        /* Card Hover Effects */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        
        /* Blob Animation */
        .blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: blob 8s ease-in-out infinite;
        }
        @keyframes blob {
            0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
            75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
        }
        
        /* Shimmer Effect */
        .shimmer {
            position: relative;
            overflow: hidden;
        }
        .shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 2s infinite;
        }
        @keyframes shimmer {
            100% { left: 100%; }
        }
        
        /* Nav Link Underline Animation */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #dc2626, #db2777);
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        /* Line Clamp */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Pattern Background */
        .pattern-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Form Input Text Visibility */
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        input[type="password"],
        select,
        textarea {
            color: #000000 !important;
            font-weight: 600 !important;
        }
        input::placeholder,
        textarea::placeholder {
            color: #374151 !important;
            opacity: 1 !important;
            font-weight: 500 !important;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col overflow-x-hidden">
    <!-- Navigation -->
    <nav x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="scrolled ? 'glass shadow-lg' : 'bg-white/80'"
         class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <!-- Logo Image or Icon -->
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Endah Travel Logo" class="h-14 group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-12 h-12 bg-gradient-to-br from-primary-500 via-secondary-500 to-primary-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-plane-departure text-white text-xl"></i>
                            </div>
                        @endif
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="nav-link text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('home') ? 'active text-primary-600' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}" class="nav-link text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('about') ? 'active text-primary-600' : '' }}">
                        Tentang Kami
                    </a>
                    <div class="relative" x-data="{ ekspOpen: false }" @mouseenter="ekspOpen = true" @mouseleave="ekspOpen = false">
                        <button class="nav-link flex items-center gap-1 text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('galeri','rute','cara-pesan') ? 'active text-primary-600' : '' }}">
                            Eksplorasi
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="ekspOpen ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="ekspOpen"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             x-cloak
                             class="absolute top-full left-1/2 -translate-x-1/2 pt-2 w-52 z-50">
                            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                                <a href="{{ route('galeri') }}" class="flex items-center gap-3 px-5 py-3.5 hover:bg-secondary-50 hover:text-secondary-600 transition {{ request()->routeIs('galeri') ? 'bg-secondary-50 text-secondary-600' : 'text-gray-700' }}">
                                    <span class="w-8 h-8 bg-secondary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-images text-secondary-500 text-sm"></i>
                                    </span>
                                    <div>
                                        <div class="font-semibold text-sm">Galeri</div>
                                        <div class="text-xs text-gray-400">Foto perjalanan kami</div>
                                    </div>
                                </a>
                                <div class="h-px bg-gray-100 mx-4"></div>
                                <a href="{{ route('rute') }}" class="flex items-center gap-3 px-5 py-3.5 hover:bg-secondary-50 hover:text-secondary-600 transition {{ request()->routeIs('rute') ? 'bg-secondary-50 text-secondary-600' : 'text-gray-700' }}">
                                    <span class="w-8 h-8 bg-secondary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-map-marked-alt text-secondary-500 text-sm"></i>
                                    </span>
                                    <div>
                                        <div class="font-semibold text-sm">Rute</div>
                                        <div class="text-xs text-gray-400">Video rute perjalanan</div>
                                    </div>
                                </a>
                                <div class="h-px bg-gray-100 mx-4"></div>
                                <a href="{{ route('cara-pesan') }}" class="flex items-center gap-3 px-5 py-3.5 hover:bg-primary-50 hover:text-primary-600 transition {{ request()->routeIs('cara-pesan') ? 'bg-primary-50 text-primary-600' : 'text-gray-700' }}">
                                    <span class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-clipboard-list text-primary-500 text-sm"></i>
                                    </span>
                                    <div>
                                        <div class="font-semibold text-sm">Cara Pesan</div>
                                        <div class="text-xs text-gray-400">Panduan pemesanan</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="nav-link text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('contact') ? 'active text-primary-600' : '' }}">
                        Kontak
                    </a>
                    <a href="{{ route('armada') }}" class="nav-link text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('armada') ? 'active text-primary-600' : '' }}">
                        Armada
                    </a>
                    <a href="{{ route('agen') }}" class="nav-link text-gray-700 hover:text-primary-600 font-medium transition {{ request()->routeIs('agen') ? 'active text-primary-600' : '' }}">
                        Agen
                    </a>
                    <a href="{{ route('booking.check-status') }}" class="btn-gradient text-white px-6 py-2.5 rounded-xl font-medium shadow-lg">
                        <i class="fas fa-search mr-2"></i>Cek Booking
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button @click="open = !open" class="text-gray-700 hover:text-primary-600 p-2 rounded-lg hover:bg-gray-100 transition">
                        <i x-show="!open" class="fas fa-bars text-2xl"></i>
                        <i x-show="open" x-cloak class="fas fa-times text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             x-cloak
             class="lg:hidden glass border-t">
            <div class="px-4 py-4 space-y-2">
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-600' : '' }}">
                    <i class="fas fa-home w-6"></i> Beranda
                </a>
                <a href="{{ route('about') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-600' : '' }}">
                    <i class="fas fa-info-circle w-6"></i> Tentang Kami
                </a>
                <div x-data="{ ekspOpen: {{ request()->routeIs('galeri','cara-pesan') ? 'true' : 'false' }} }">
                        <button @click="ekspOpen = !ekspOpen" class="w-full flex items-center justify-between px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('galeri','rute','cara-pesan') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                        <span class="flex items-center"><i class="fas fa-compass w-6"></i> Eksplorasi</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="ekspOpen ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="ekspOpen" x-cloak class="ml-6 mt-1 space-y-1 border-l-2 border-secondary-200 pl-3">
                        <a href="{{ route('galeri') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('galeri') ? 'bg-secondary-50 text-secondary-600' : 'text-gray-600 hover:bg-secondary-50 hover:text-secondary-600' }}">
                            <i class="fas fa-images w-5"></i> Galeri
                        </a>
                        <a href="{{ route('rute') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('rute') ? 'bg-secondary-50 text-secondary-600' : 'text-gray-600 hover:bg-secondary-50 hover:text-secondary-600' }}">
                            <i class="fas fa-map-marked-alt w-5"></i> Rute
                        </a>
                        <a href="{{ route('cara-pesan') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('cara-pesan') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600' }}">
                            <i class="fas fa-clipboard-list w-5"></i> Cara Pesan
                        </a>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-600' : '' }}">
                    <i class="fas fa-envelope w-6"></i> Kontak
                </a>
                <a href="{{ route('armada') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition {{ request()->routeIs('armada') ? 'bg-primary-50 text-primary-600' : '' }}">
                    <i class="fas fa-bus w-6"></i> Armada
                </a>
                <a href="{{ route('agen') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-600 font-medium transition {{ request()->routeIs('agen') ? 'bg-primary-50 text-primary-600' : '' }}">
                    <i class="fas fa-user-tie w-6"></i> Agen
                </a>
                <a href="{{ route('booking.check-status') }}" class="flex items-center justify-center btn-gradient text-white px-4 py-3 rounded-xl font-medium mt-2">
                    <i class="fas fa-search mr-2"></i> Cek Booking
                </a>
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed nav -->
    <div class="h-20"></div>

    <!-- Flash Messages -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-8"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-8"
         class="fixed top-24 right-4 z-50 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-2xl shadow-2xl">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-check text-lg"></i>
            </div>
            <span class="font-medium">{{ session('success') }}</span>
            <button @click="show = false" class="ml-4 hover:bg-white/20 p-1 rounded-full transition"><i class="fas fa-times"></i></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-8"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-8"
         class="fixed top-24 right-4 z-50 bg-gradient-to-r from-red-500 to-rose-600 text-white px-6 py-4 rounded-2xl shadow-2xl">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-exclamation text-lg"></i>
            </div>
            <span class="font-medium">{{ session('error') }}</span>
            <button @click="show = false" class="ml-4 hover:bg-white/20 p-1 rounded-full transition"><i class="fas fa-times"></i></button>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary-500/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Company Info -->
                <div class="lg:col-span-1">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 via-secondary-500 to-primary-500 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                            <i class="fas fa-plane-departure text-white text-xl"></i>
                        </div>
                        <div>
                            <span class="text-2xl font-bold text-white">Endah Travel</span>
                            <span class="block text-xs text-gray-400 -mt-1">Explore Indonesia</span>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Jasa travel dan perjalanan wisata terpercaya dengan pengalaman melayani ribuan pelanggan.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-primary-500 transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-pink-500 transition-colors duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-green-500 transition-colors duration-300">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-red-500 transition-colors duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-blue-400 transition-colors duration-300">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6 flex items-center">
                        <span class="w-2 h-2 bg-primary-500 rounded-full mr-2"></span>
                        Link Cepat
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Tentang Kami</a></li>
                        <li><a href="{{ route('galeri') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Galeri</a></li>
                        <li><a href="{{ route('rute') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Rute</a></li>
                        <li><a href="{{ route('cara-pesan') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Cara Pesan</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Kontak</a></li>
                        <li><a href="{{ route('armada') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Armada</a></li>
                        <li><a href="{{ route('agen') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Agen</a></li>
                        <li><a href="{{ route('booking.check-status') }}" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-primary-400"></i>Cek Booking</a></li>
                    </ul>
                </div>
                
                <!-- Destinations -->
                <div>
                    <h4 class="text-lg font-semibold mb-6 flex items-center">
                        <span class="w-2 h-2 bg-secondary-500 rounded-full mr-2"></span>
                        Destinasi Populer
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-map-marker-alt text-xs mr-2 text-secondary-400"></i>Bali</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-map-marker-alt text-xs mr-2 text-secondary-400"></i>Yogyakarta</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-map-marker-alt text-xs mr-2 text-secondary-400"></i>Raja Ampat</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-map-marker-alt text-xs mr-2 text-secondary-400"></i>Labuan Bajo</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center"><i class="fas fa-map-marker-alt text-xs mr-2 text-secondary-400"></i>Lombok</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-6 flex items-center">
                        <span class="w-2 h-2 bg-primary-500 rounded-full mr-2"></span>
                        Hubungi Kami
                    </h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start group">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mr-3 group-hover:bg-primary-500 transition-colors flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-primary-400 group-hover:text-white transition-colors"></i>
                            </div>
                            <span class="pt-2">Jl. Pariwisata No. 123<br>Jakarta Selatan, 12345</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mr-3 group-hover:bg-green-500 transition-colors flex-shrink-0">
                                <i class="fas fa-phone text-green-400 group-hover:text-white transition-colors"></i>
                            </div>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mr-3 group-hover:bg-blue-500 transition-colors flex-shrink-0">
                                <i class="fas fa-envelope text-blue-400 group-hover:text-white transition-colors"></i>
                            </div>
                            <span>info@endahtravel.com</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mr-3 group-hover:bg-yellow-500 transition-colors flex-shrink-0">
                                <i class="fas fa-clock text-yellow-400 group-hover:text-white transition-colors"></i>
                            </div>
                            <span>Sen - Sab: 08:00 - 17:00</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Endah Travel. All rights reserved.</p>
                    <div class="flex items-center space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Travel,%20saya%20ingin%20bertanya" target="_blank" 
       class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-2xl hover:bg-green-600 hover:scale-110 transition-all duration-300 group">
        <i class="fab fa-whatsapp text-white text-2xl"></i>
        <span class="absolute right-full mr-3 bg-white text-gray-800 px-4 py-2 rounded-lg shadow-lg text-sm font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">
            Chat via WhatsApp
        </span>
    </a>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: false,
            offset: 50
        });
    </script>

    <!-- Animated Counter Script -->
    <script>
        function animateCounter(el) {
            const target = parseInt(el.getAttribute('data-target')) || 0;
            const duration = 2000;
            const startFrom = Math.max(1, Math.floor(target * 0.01));
            const range = target - startFrom;
            const stepTime = Math.max(Math.floor(duration / range), 10);
            let current = startFrom;
            el.textContent = current + '+';
            const timer = setInterval(() => {
                const increment = Math.max(1, Math.ceil((target - current) / ((duration / stepTime) * 0.3)));
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                el.textContent = current + '+';
            }, stepTime);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                } else {
                    // Reset saat keluar layar agar bisa animasi ulang
                    const target = parseInt(entry.target.getAttribute('data-target')) || 0;
                    entry.target.textContent = Math.max(1, Math.floor(target * 0.01)) + '+';
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.counter').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>

