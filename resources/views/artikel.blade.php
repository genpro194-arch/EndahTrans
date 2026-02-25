@extends('layouts.app')

@section('title', 'Artikel & Tips Wisata - Endah Trans')

@section('content')

    <!-- Hero Section -->
    <section class="relative py-28 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1600&q=80"
                 alt="Artikel Wisata" class="w-full h-full object-cover">
        </div>
        <div class="hero-gradient absolute inset-0"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <span class="inline-block bg-white/20 backdrop-blur text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <i class="fas fa-newspaper mr-1"></i> ARTIKEL & TIPS
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 leading-tight">
                Artikel & <span class="text-primary-300">Tips Wisata</span>
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto leading-relaxed">
                Temukan inspirasi perjalanan, tips wisata, dan informasi menarik seputar destinasi wisata Indonesia
            </p>
        </div>
    </section>

    <!-- Artikel Unggulan -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-fire mr-1"></i> ARTIKEL TERBARU
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                    Inspirasi <span class="gradient-text">Perjalanan</span> Anda
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Panduan lengkap dan tips wisata dari tim perencana perjalanan profesional kami
                </p>
            </div>

            <!-- Artikel Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    [
                        'img' => 'https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=600&q=80',
                        'category' => 'Tips Wisata',
                        'cat_color' => 'bg-primary-100 text-primary-700',
                        'title' => '10 Tips Perjalanan Wisata Rombongan yang Wajib Diketahui',
                        'excerpt' => 'Merencanakan perjalanan wisata bersama rombongan bisa jadi tantangan tersendiri. Berikut tips dan trik agar perjalanan Anda berjalan lancar dan menyenangkan.',
                        'date' => '20 Februari 2026',
                        'read_time' => '5 menit',
                        'author' => 'Tim Endah Trans',
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=600&q=80',
                        'category' => 'Destinasi',
                        'cat_color' => 'bg-secondary-100 text-secondary-700',
                        'title' => 'Destinasi Wisata Terbaik di Jawa Tengah yang Wajib Dikunjungi 2026',
                        'excerpt' => 'Jawa Tengah menyimpan begitu banyak keindahan alam dan budaya yang menakjubkan. Mulai dari Dieng, Karimunjawa, hingga Borobudur yang ikonik.',
                        'date' => '15 Februari 2026',
                        'read_time' => '7 menit',
                        'author' => 'Tim Endah Trans',
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80',
                        'category' => 'Panduan',
                        'cat_color' => 'bg-green-100 text-green-700',
                        'title' => 'Panduan Lengkap Memilih Bus Wisata yang Tepat untuk Rombongan',
                        'excerpt' => 'Memilih bus wisata bukan hanya soal harga. Ada banyak faktor yang perlu dipertimbangkan agar perjalanan Anda nyaman dan aman.',
                        'date' => '10 Februari 2026',
                        'read_time' => '6 menit',
                        'author' => 'Tim Endah Trans',
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600&q=80',
                        'category' => 'Destinasi',
                        'cat_color' => 'bg-secondary-100 text-secondary-700',
                        'title' => 'Keindahan Tersembunyi Karimunjawa yang Belum Banyak Diketahui',
                        'excerpt' => 'Karimunjawa adalah surga tersembunyi di Laut Jawa. Dengan pantai berpasir putih dan air jernih, destinasi ini cocok untuk wisata keluarga maupun rombongan.',
                        'date' => '5 Februari 2026',
                        'read_time' => '8 menit',
                        'author' => 'Tim Endah Trans',
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1495562569060-2eec283d3391?w=600&q=80',
                        'category' => 'Tips Wisata',
                        'cat_color' => 'bg-primary-100 text-primary-700',
                        'title' => 'Tips Hemat Wisata Bersama Grup Tanpa Mengorbankan Kenyamanan',
                        'excerpt' => 'Siapa bilang wisata grup harus mahal? Dengan perencanaan yang tepat, Anda bisa mendapatkan pengalaman wisata berkualitas dengan anggaran terbatas.',
                        'date' => '1 Februari 2026',
                        'read_time' => '4 menit',
                        'author' => 'Tim Endah Trans',
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&q=80',
                        'category' => 'Panduan',
                        'cat_color' => 'bg-green-100 text-green-700',
                        'title' => 'Cara Memesan Bus Wisata dengan Mudah dan Aman',
                        'excerpt' => 'Proses pemesanan bus wisata kini semakin mudah. Berikut panduan langkah demi langkah untuk memesan armada bus wisata kami secara online maupun offline.',
                        'date' => '25 Januari 2026',
                        'read_time' => '3 menit',
                        'author' => 'Tim Endah Trans',
                    ],
                ] as $index => $article)
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden card-hover border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ $article['img'] }}" alt="{{ $article['title'] }}"
                             class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center {{ $article['cat_color'] }} px-3 py-1 rounded-full text-xs font-bold shadow">
                                {{ $article['category'] }}
                            </span>
                        </div>
                    </div>
                    <div class="p-7">
                        <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                            <span><i class="fas fa-calendar mr-1"></i> {{ $article['date'] }}</span>
                            <span><i class="fas fa-clock mr-1"></i> {{ $article['read_time'] }}</span>
                        </div>
                        <h3 class="font-extrabold text-gray-900 text-lg mb-3 leading-snug line-clamp-2">{{ $article['title'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-5 line-clamp-3">{{ $article['excerpt'] }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($article['author']) }}&background=ef4444&color=fff&bold=true&size=32"
                                     alt="{{ $article['author'] }}" class="w-8 h-8 rounded-full">
                                <span class="text-xs text-gray-500 font-medium">{{ $article['author'] }}</span>
                            </div>
                            <a href="{{ route('contact') }}" class="inline-flex items-center text-primary-600 font-semibold text-sm hover:text-primary-800 transition">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Kategori Artikel -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">
                    Jelajahi Berdasarkan <span class="gradient-text">Kategori</span>
                </h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach([
                    ['icon' => 'fas fa-map-marked-alt', 'label' => 'Destinasi', 'count' => '12 Artikel', 'color' => 'from-primary-500 to-primary-700'],
                    ['icon' => 'fas fa-lightbulb', 'label' => 'Tips Wisata', 'count' => '8 Artikel', 'color' => 'from-yellow-400 to-yellow-600'],
                    ['icon' => 'fas fa-book-open', 'label' => 'Panduan', 'count' => '6 Artikel', 'color' => 'from-green-500 to-green-700'],
                    ['icon' => 'fas fa-camera', 'label' => 'Galeri Wisata', 'count' => '15 Album', 'color' => 'from-secondary-500 to-secondary-700'],
                ] as $cat)
                <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-gray-50 to-white border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all cursor-pointer" data-aos="fade-up">
                    <div class="w-14 h-14 bg-gradient-to-br {{ $cat['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-md">
                        <i class="{{ $cat['icon'] }} text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-1">{{ $cat['label'] }}</h4>
                    <p class="text-xs text-gray-500">{{ $cat['count'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter / Subscribe -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-secondary-700"></div>
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-envelope text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                Ingin Info Wisata Terbaru?
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Hubungi kami untuk mendapatkan update artikel, tips wisata, dan penawaran spesial langsung ke WhatsApp Anda
            </p>
            <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Trans,%20saya%20ingin%20mendapatkan%20update%20wisata%20terbaru" target="_blank"
               class="inline-flex items-center justify-center bg-green-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-green-600 transition hover:-translate-y-1">
                <i class="fab fa-whatsapp mr-3 text-2xl"></i> Subscribe via WhatsApp
            </a>
        </div>
    </section>

@endsection
