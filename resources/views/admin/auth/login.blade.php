<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Endah Travel</title>
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #10b981 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
        }
        .blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: blob 8s ease-in-out infinite;
        }
        @keyframes blob {
            0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
        }
    </style>
</head>
<body class="min-h-screen flex">
    <!-- Left Side - Branding -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
        <!-- Decorative Blobs -->
        <div class="absolute top-20 left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl blob"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl blob" style="animation-delay: 2s;"></div>
        
        <!-- Floating Icons -->
        <div class="absolute top-1/4 right-1/4 w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center animate-bounce" style="animation-duration: 3s;">
            <i class="fas fa-plane text-white text-xl"></i>
        </div>
        <div class="absolute bottom-1/3 left-1/4 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center animate-bounce" style="animation-duration: 4s; animation-delay: 1s;">
            <i class="fas fa-umbrella-beach text-white text-lg"></i>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
            <div class="w-24 h-24 bg-white/20 rounded-3xl flex items-center justify-center mb-8 backdrop-blur">
                <i class="fas fa-plane-departure text-5xl"></i>
            </div>
            <h1 class="text-4xl font-extrabold mb-4 text-center">Endah Travel</h1>
            <p class="text-xl text-white/80 mb-8 text-center">Admin Dashboard</p>
            <div class="max-w-sm text-center text-white/70">
                <p class="mb-6">Kelola paket wisata, booking, dan pelanggan dengan mudah dari satu tempat.</p>
                <div class="flex justify-center gap-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold">6+</div>
                        <div class="text-sm text-white/60">Destinasi</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">7+</div>
                        <div class="text-sm text-white/60">Paket</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">10K+</div>
                        <div class="text-sm text-white/60">Pelanggan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
        <div class="max-w-md w-full">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-plane-departure text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold gradient-text">Endah Travel</h1>
                <p class="text-gray-500 text-sm">Admin Dashboard</p>
            </div>

            <div class="glass rounded-3xl shadow-2xl p-8 border border-gray-100">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang! 👋</h2>
                    <p class="text-gray-500">Silakan login untuk melanjutkan</p>
                </div>

                @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-primary-500 mr-1"></i> Email
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3.5 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all text-gray-800"
                               placeholder="admin@endahtravel.com">
                    </div>

                    <div x-data="{ show: false }">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-primary-500 mr-1"></i> Password
                        </label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" required
                                   class="w-full px-4 py-3.5 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all text-gray-800 pr-12"
                                   placeholder="••••••••">
                            <button type="button" @click="show = !show" 
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary-500 transition">
                                <i :class="show ? 'fa-eye-slash' : 'fa-eye'" class="fas text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-4 rounded-xl font-bold text-lg hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                    <p class="text-gray-500 text-sm mb-2">Demo Credentials:</p>
                    <code class="text-xs bg-gray-100 px-3 py-1 rounded-lg text-gray-600">admin@endahtravel.com / password</code>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-primary-600 font-medium transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>

