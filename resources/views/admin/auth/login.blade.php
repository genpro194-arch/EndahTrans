<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Endah Travel</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Sora', 'sans-serif'],
                    },
                    colors: {
                        brand: { DEFAULT: '#ec4899', dark: '#db2777', light: '#f472b6', faint: '#fdf2f8' },
                        danger: { 500: '#ef4444', 600: '#dc2626' },
                    },
                    boxShadow: {
                        'brand': '0 8px 32px -4px rgba(236,72,153,0.35)',
                    }
                }
            }
        }
    </script>

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body { font-family: 'Inter', sans-serif; }

        @keyframes blob { 0%,100%{border-radius:60% 40% 30% 70%/60% 30% 70% 40%} 50%{border-radius:30% 60% 70% 40%/50% 60% 30% 60%} }
        .blob { animation: blob 8s ease-in-out infinite; }
        .blob-2 { animation: blob 10s ease-in-out infinite reverse; }
        .blob-3 { animation: blob 12s ease-in-out infinite 2s; }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #fff inset !important;
            -webkit-text-fill-color: #111827 !important;
        }
        .input-field:focus { box-shadow: 0 0 0 3px rgba(236,72,153,0.15); }
    </style>
</head>
<body class="bg-slate-50" x-data="{ showPass: false }">

    <div class="min-h-screen flex">

        <!-- Left Panel (branding) -->
        <div class="hidden lg:flex lg:w-1/2 xl:w-3/5 relative bg-[#08080f] overflow-hidden flex-col justify-between p-12">
            <!-- Animated blobs -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="blob absolute -top-20 -left-20 w-80 h-80 bg-[#ec4899]/25 opacity-50"></div>
                <div class="blob-2 absolute top-1/3 -right-16 w-96 h-96 bg-[#ef4444]/15 opacity-40"></div>
                <div class="blob-3 absolute -bottom-24 left-1/3 w-72 h-72 bg-[#db2777]/20 opacity-30"></div>
            </div>
            <!-- Grid pattern -->
            <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 40px 40px;"></div>

            <!-- Logo -->
            <div class="relative z-10">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Endah Travel" class="h-12 w-auto object-contain drop-shadow-lg">
                </div>
            </div>

            <!-- Hero text -->
            <div class="relative z-10">
                <p class="text-[#f472b6] text-sm font-semibold tracking-widest uppercase mb-4">Admin Dashboard</p>
                <h2 class="text-4xl xl:text-5xl font-bold text-white leading-tight mb-6">
                    Kelola semua dengan<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f472b6] to-[#ef4444]">mudah &amp; efisien</span>
                </h2>
                <p class="text-slate-400 text-base leading-relaxed max-w-sm">
                    Panel administrasi terpusat untuk memantau pemesanan, paket wisata, armada charter, testimoni, dan semua aktivitas Endah Travel.
                </p>
                <div class="flex flex-wrap gap-3 mt-8">
                    <span class="flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full px-4 py-2">
                        <i class="fas fa-chart-line text-[#f472b6] text-xs"></i>
                        <span class="text-white text-xs font-medium">Statistik Real-time</span>
                    </span>
                    <span class="flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full px-4 py-2">
                        <i class="fas fa-shield-alt text-[#ef4444] text-xs"></i>
                        <span class="text-white text-xs font-medium">Aman &amp; Terenkripsi</span>
                    </span>
                    <span class="flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full px-4 py-2">
                        <i class="fas fa-mobile-alt text-[#f472b6] text-xs"></i>
                        <span class="text-white text-xs font-medium">Responsif</span>
                    </span>
                </div>
            </div>

            <div class="relative z-10">
                <p class="text-slate-600 text-xs">&copy; {{ date('Y') }} Endah Travel. Hak cipta dilindungi.</p>
            </div>
        </div>

        <!-- Right Panel (form) -->
        <div class="w-full lg:w-1/2 xl:w-2/5 flex items-center justify-center p-6 sm:p-10">
            <div class="w-full max-w-md">

                <!-- Mobile logo -->
                <div class="flex lg:hidden items-center justify-center mb-10">
                    <img src="{{ asset('images/logo.png') }}" alt="Endah Travel" class="h-14 w-auto object-contain">
                </div>

                <!-- Heading -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">Selamat datang</h1>
                    <p class="text-slate-500 text-sm">Masuk ke panel administrasi Anda</p>
                </div>

                <!-- Alerts -->
                @if(session('error'))
                <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3.5 mb-6 text-sm">
                    <i class="fas fa-circle-exclamation mt-0.5 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                @if($errors->any())
                <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3.5 mb-6 text-sm">
                    <i class="fas fa-circle-exclamation mt-0.5 shrink-0"></i>
                    <ul class="space-y-0.5">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-900 mb-1.5">Email</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                <i class="fas fa-envelope text-sm"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-gray-900 text-sm placeholder-slate-400 transition outline-none focus:border-[#ec4899] @error('email') border-red-400 @enderror"
                                   placeholder="admin@endahtravel.com">
                        </div>
                        @error('email')<p class="mt-1.5 text-red-500 text-xs">{{ $message }}</p>@enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-900 mb-1.5">Password</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                <i class="fas fa-lock text-sm"></i>
                            </span>
                            <input type="password" id="password" name="password" required
                                   class="input-field w-full pl-10 pr-12 py-3 rounded-xl border border-slate-200 bg-white text-gray-900 text-sm placeholder-slate-400 transition outline-none focus:border-[#ec4899] @error('password') border-red-400 @enderror"
                                   placeholder="••••••••">
                            <button type="button" onclick="(function(){var i=document.getElementById('password'),ic=document.getElementById('togglePassIcon');i.type=i.type==='password'?'text':'password';ic.classList.toggle('fa-eye');ic.classList.toggle('fa-eye-slash');})()"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#ec4899] transition">
                                <i id="togglePassIcon" class="fas fa-eye text-sm"></i>
                            </button>
                        </div>
                        @error('password')<p class="mt-1.5 text-red-500 text-xs">{{ $message }}</p>@enderror
                    </div>

                    <!-- Remember -->
                    <div>
                        <label class="flex items-center gap-2.5 cursor-pointer select-none">
                            <div class="relative">
                                <input type="checkbox" name="remember" id="remember" class="sr-only peer">
                                <div class="w-9 h-5 bg-slate-200 rounded-full peer-checked:bg-[#ec4899] transition-colors"></div>
                                <div class="absolute left-0.5 top-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-4"></div>
                            </div>
                            <span class="text-sm text-slate-600">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-[#ec4899] to-[#ef4444] hover:from-[#db2777] hover:to-[#dc2626] text-white font-semibold text-sm py-3.5 rounded-xl transition-all duration-200 shadow-[0_8px_32px_-4px_rgba(236,72,153,0.4)] hover:shadow-none flex items-center justify-center gap-2 mt-2 active:scale-[0.98]">
                        <i class="fas fa-right-to-bracket"></i>
                        Masuk ke Dashboard
                    </button>
                </form>

                <p class="text-center text-slate-400 text-xs mt-8">
                    Halaman ini hanya untuk administrator.
                    <a href="{{ route('home') }}" class="text-[#ec4899] hover:underline ml-1">Ke Website →</a>
                </p>

            </div>
        </div>
    </div>

</body>
</html>
