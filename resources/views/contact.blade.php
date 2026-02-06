@extends('layouts.app')

@section('title', 'Hubungi Kami - Endah Travel')

@section('content')
    <!-- Hero Header -->
    <section class="relative min-h-[50vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-600"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-20 w-96 h-96 bg-secondary-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        <!-- Floating Icons -->
        <div class="absolute top-1/4 left-[15%] w-16 h-16 bg-white/10 backdrop-blur rounded-2xl flex items-center justify-center animate-bounce" style="animation-duration: 3s;">
            <i class="fas fa-envelope text-white text-2xl"></i>
        </div>
        <div class="absolute bottom-1/4 right-[15%] w-14 h-14 bg-white/10 backdrop-blur rounded-xl flex items-center justify-center animate-bounce" style="animation-duration: 4s;">
            <i class="fab fa-whatsapp text-white text-xl"></i>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <span class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-medium mb-6" data-aos="fade-down">
                <i class="fas fa-headset mr-2"></i> Kami Siap Membantu
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6" data-aos="fade-up">
                Hubungi <span class="text-secondary-300">Kami</span>
            </h1>
            <p class="text-xl text-white/80 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Ada pertanyaan atau ingin konsultasi? Tim kami siap membantu mewujudkan perjalanan impian Anda
            </p>
        </div>
    </section>

    <!-- Contact Cards -->
    <section class="py-16 -mt-16 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- WhatsApp -->
                <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Travel,%20saya%20ingin%20bertanya" target="_blank" 
                   class="group bg-white rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100" data-aos="fade-up">
                    <div class="w-16 h-16 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-secondary-500/30 group-hover:scale-110 transition-transform">
                        <i class="fab fa-whatsapp text-white text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">WhatsApp</h3>
                    <p class="text-gray-600 mb-3">+62 812-3456-7890</p>
                    <span class="text-secondary-600 font-semibold text-sm group-hover:underline">Chat Sekarang →</span>
                </a>
                
                <!-- Phone -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-primary-500/30">
                        <i class="fas fa-phone text-white text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600 mb-3">+62 21-1234-5678</p>
                    <span class="text-primary-600 font-semibold text-sm">Senin - Sabtu</span>
                </div>
                
                <!-- Email -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-primary-500/30">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600 mb-3">info@endahtravel.com</p>
                    <span class="text-primary-600 font-semibold text-sm">Respon cepat!</span>
                </div>
                
                <!-- Address -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-primary-500/30">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Alamat</h3>
                    <p class="text-gray-600 mb-3">Jl. Raya Utama No. 123</p>
                    <span class="text-primary-600 font-semibold text-sm">Jakarta, Indonesia</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
                <!-- Contact Info -->
                <div class="lg:col-span-2" data-aos="fade-right">
                    <div class="sticky top-8">
                        <span class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                            <i class="fas fa-info-circle mr-2"></i> Informasi Kontak
                        </span>
                        <h2 class="text-3xl font-extrabold text-gray-900 mb-6">
                            Mari Bicara Tentang <span class="gradient-text">Perjalanan Anda</span>
                        </h2>
                        <p class="text-gray-600 mb-8 text-lg">
                            Kami senang mendengar dari Anda! Hubungi kami melalui form atau kontak di bawah.
                        </p>
                        
                        <!-- Info Items -->
                        <div class="space-y-6 mb-8">
                            <div class="flex items-start p-4 bg-white rounded-2xl shadow-sm">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900">Jam Operasional</h4>
                                    <p class="text-gray-600">Senin - Sabtu, 08:00 - 17:00 WIB</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-4 bg-white rounded-2xl shadow-sm">
                                <div class="w-12 h-12 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-comments text-white"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900">Response Time</h4>
                                    <p class="text-gray-600">Rata-rata dalam 30 menit</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Media -->
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Ikuti Kami</p>
                            <div class="flex space-x-3">
                                <a href="#" class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform shadow-lg shadow-primary-500/30">
                                    <i class="fab fa-facebook-f text-lg"></i>
                                </a>
                                <a href="#" class="w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform shadow-lg shadow-primary-500/30">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a>
                                <a href="#" class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform shadow-lg shadow-primary-500/30">
                                    <i class="fab fa-youtube text-lg"></i>
                                </a>
                                <a href="#" class="w-12 h-12 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-transform shadow-lg shadow-secondary-500/30">
                                    <i class="fab fa-tiktok text-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-3" data-aos="fade-left">
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Kirim Pesan</h3>
                            <p class="text-gray-600">Isi form di bawah dan kami akan segera menghubungi Anda</p>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-user text-primary-500 mr-1"></i> Nama Lengkap
                                    </label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                           class="w-full px-4 py-3.5 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all @error('name') border-red-500 @enderror"
                                           placeholder="John Doe">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-envelope text-primary-500 mr-1"></i> Email
                                    </label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           class="w-full px-4 py-3.5 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all @error('email') border-red-500 @enderror"
                                           placeholder="email@contoh.com">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-phone text-primary-500 mr-1"></i> No. HP
                                    </label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}"
                                           class="w-full px-4 py-3.5 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all"
                                           placeholder="08xxxxxxxxxx">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-tag text-primary-500 mr-1"></i> Subjek
                                    </label>
                                    <select name="subject" required
                                            class="w-full px-4 py-3.5 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all @error('subject') border-red-500 @enderror">
                                        <option value="">Pilih Subjek</option>
                                        <option value="Informasi Paket" {{ old('subject') == 'Informasi Paket' ? 'selected' : '' }}>📦 Informasi Paket</option>
                                        <option value="Pemesanan" {{ old('subject') == 'Pemesanan' ? 'selected' : '' }}>🎫 Pemesanan</option>
                                        <option value="Pembayaran" {{ old('subject') == 'Pembayaran' ? 'selected' : '' }}>💳 Pembayaran</option>
                                        <option value="Keluhan" {{ old('subject') == 'Keluhan' ? 'selected' : '' }}>⚠️ Keluhan</option>
                                        <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>📝 Lainnya</option>
                                    </select>
                                    @error('subject')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-comment-alt text-primary-500 mr-1"></i> Pesan
                                </label>
                                <textarea name="message" rows="5" required
                                          class="w-full px-4 py-3.5 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all resize-none @error('message') border-red-500 @enderror"
                                          placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full btn-gradient text-white py-4 rounded-xl font-bold text-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Maps Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12" data-aos="fade-up">
                <div class="inline-flex items-center bg-primary-100 text-primary-700 px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span class="text-sm font-semibold">Lokasi Kami</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Kunjungi Kantor Endah Trans
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Lokasi strategis di pusat kota, mudah diakses dari berbagai tempat. Kunjungi kantor kami untuk konsultasi dan pemesanan paket wisata.
                </p>
            </div>

            <!-- Maps Container -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                <!-- Maps Embed -->
                <div class="lg:col-span-2" data-aos="fade-right">
                    <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-primary-100 h-96 lg:h-96">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.200488506536!2d110.750231!3d-6.7453843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70ddc096dc10ad%3A0xef6083aef28b357b!2sPo.Endah%20Trans%20Jepara!5e0!3m2!1sid!2sid!4v1769998406551!5m2!1sid!2sid" 
                                width="100%" 
                                height="100%" 
                                style="border:0; min-height: 384px;" 
                                allowfullscreen="" 
                                loading="lazy"
                                allow="geolocation"
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="lg:col-span-1" data-aos="fade-left">
                    <div class="bg-gradient-to-br from-primary-600 to-primary-700 text-white rounded-2xl p-8 shadow-xl">
                        <h3 class="text-2xl font-bold mb-6">
                            <i class="fas fa-map-location-dot mr-2"></i> Informasi Lokasi
                        </h3>

                        <!-- Address -->
                        <div class="mb-6 pb-6 border-b border-white/20">
                            <p class="text-sm text-white/70 mb-2 font-semibold">ALAMAT</p>
                            <p class="text-base font-semibold">Jl. Raya Jepara - Kudus, Rw. 03<br>Pelang, Kec. Mayong<br>Kabupaten Jepara, Jawa Tengah</p>
                        </div>

                        <!-- Phone -->
                        <div class="mb-6 pb-6 border-b border-white/20">
                            <p class="text-sm text-white/70 mb-2 font-semibold">TELEPON</p>
                            <a href="tel:+6281234567890" class="text-lg font-semibold hover:text-primary-200 transition">
                                <i class="fas fa-phone-alt mr-2"></i> +62 812-3456-7890
                            </a>
                        </div>

                        <!-- Email -->
                        <div class="mb-6 pb-6 border-b border-white/20">
                            <p class="text-sm text-white/70 mb-2 font-semibold">EMAIL</p>
                            <a href="mailto:info@endahtravel.com" class="text-lg font-semibold hover:text-primary-200 transition">
                                <i class="fas fa-envelope mr-2"></i> info@endahtravel.com
                            </a>
                        </div>

                        <!-- Operating Hours -->
                        <div class="mb-6">
                            <p class="text-sm text-white/70 mb-3 font-semibold">JAM OPERASIONAL</p>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-semibold">Senin - Jumat:</span> 08:00 - 17:00 WIB</p>
                                <p><span class="font-semibold">Sabtu:</span> 09:00 - 14:00 WIB</p>
                                <p><span class="font-semibold">Minggu:</span> Tutup</p>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="space-y-3 mt-8">
                            <a href="https://maps.app.goo.gl/SQ1EFkbtUonSbyha7?g_st=aw" target="_blank"
                               class="w-full inline-flex items-center justify-center bg-white text-primary-600 py-3 rounded-xl font-bold hover:bg-gray-100 transition-all hover:shadow-lg">
                                <i class="fas fa-directions mr-2"></i> Lihat di Google Maps
                            </a>
                            <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Travel,%20saya%20ingin%20bertanya%20tentang%20lokasi%20dan%20jam%20operasional" target="_blank"
                               class="w-full inline-flex items-center justify-center bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition-all hover:shadow-lg">
                                <i class="fab fa-whatsapp mr-2"></i> Hubungi WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-question-circle mr-2"></i> FAQ
                </span>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Pertanyaan yang Sering Diajukan</h2>
            </div>
            
            <div class="space-y-4" x-data="{ active: 1 }">
                @foreach([
                    ['q' => 'Bagaimana cara melakukan pemesanan?', 'a' => 'Anda bisa melakukan pemesanan melalui website kami dengan memilih paket yang diinginkan, atau langsung menghubungi kami via WhatsApp untuk konsultasi dan pemesanan.'],
                    ['q' => 'Apakah bisa request jadwal custom?', 'a' => 'Tentu! Kami menerima permintaan jadwal khusus untuk grup minimal 10 orang. Silakan hubungi tim kami untuk diskusi lebih lanjut.'],
                    ['q' => 'Bagaimana kebijakan pembatalan?', 'a' => 'Pembatalan H-7 sebelum keberangkatan akan mendapat refund 50%. Pembatalan H-3 atau kurang tidak mendapat refund kecuali ada kondisi darurat yang bisa dipertimbangkan.'],
                    ['q' => 'Apakah sudah termasuk asuransi perjalanan?', 'a' => 'Ya, semua paket wisata kami sudah termasuk asuransi perjalanan dasar. Untuk coverage yang lebih lengkap, silakan hubungi kami.']
                ] as $index => $faq)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <button @click="active = active === {{ $index + 1 }} ? 0 : {{ $index + 1 }}" 
                            class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 transition">
                        <span class="font-semibold text-gray-900">{{ $faq['q'] }}</span>
                        <i class="fas" :class="active === {{ $index + 1 }} ? 'fa-minus text-primary-600' : 'fa-plus text-gray-400'"></i>
                    </button>
                    <div x-show="active === {{ $index + 1 }}" x-collapse>
                        <div class="px-6 pb-5 text-gray-600">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

