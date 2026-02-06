<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Endah Travel</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
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
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; height: 100%; }
        body { 
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }
        
        input::-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px #f9fafb inset !important;
            -webkit-text-fill-color: #1f2937 !important;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(79, 70, 229, 0.3);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Logo & Header -->
            <div class="text-center mb-12">
                <div class="w-16 h-16 bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-md">
                    <i class="fas fa-plane-departure text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Endah Travel</h1>
                <p class="text-slate-600">Admin Dashboard</p>
            </div>

            <!-- Login Form Card -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-900">Masuk</h2>
                    <p class="text-slate-500 text-sm mt-1">Masukkan kredensial admin Anda</p>
                </div>

                <!-- Error Messages -->
                @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-6 flex items-start gap-3">
                    <i class="fas fa-exclamation-circle mt-0.5 flex-shrink-0"></i>
                    <span class="text-sm">{{ session('error') }}</span>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-sm flex items-center gap-2 mb-2">
                            <i class="fas fa-circle text-xs"></i>{{ $error }}
                        </p>
                    @endforeach
                </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-900 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                               autocomplete="email"
                               class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/10 transition-all text-slate-900 placeholder-slate-400"
                               placeholder="admin@endahtravel.com">
                    </div>

                    <!-- Password Field -->
                    <div x-data="{ showPassword: false }">
                        <label for="password" class="block text-sm font-medium text-slate-900 mb-2">Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" 
                                   required autocomplete="current-password"
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-slate-500 focus:ring-2 focus:ring-slate-500/10 transition-all text-slate-900 placeholder-slate-400 pr-11"
                                   placeholder="••••••••">
                            <button type="button" @click="showPassword = !showPassword" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition focus:outline-none">
                                <i :class="showPassword ? 'fa-eye-slash' : 'fa-eye'" class="fas text-base"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" 
                               class="w-4 h-4 text-slate-700 border-slate-300 rounded focus:ring-slate-500 cursor-pointer">
                        <label for="remember" class="ml-2.5 text-sm text-slate-600 cursor-pointer">
                            Ingat saya
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn-primary w-full bg-slate-700 hover:bg-slate-800 text-white py-3 rounded-lg font-medium transition-all duration-200 shadow-md flex items-center justify-center gap-2 mt-6">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </button>
                </form>

                <!-- Demo Credentials -->
                <div class="mt-8 pt-8 border-t border-slate-200 bg-slate-50 rounded-lg p-4 text-center">
                    <p class="text-slate-600 text-xs font-medium mb-2">Kredensial Demo:</p>
                    <p class="text-slate-900 text-sm font-mono mb-1">admin@endahtravel.com</p>
                    <p class="text-slate-900 text-sm font-mono">password</p>
                </div>
            </div>

            <!-- Back Link -->
            <div class="text-center mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center text-slate-600 hover:text-slate-900 text-sm font-medium transition gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>


