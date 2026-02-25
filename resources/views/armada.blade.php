@extends('layouts.app')

@section('title', 'Armada Kami - Endah Trans')

@section('content')

    <!-- Hero Section -->
    <section class="relative py-28 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1600&q=80"
                 alt="Armada Endah Trans" class="w-full h-full object-cover">
        </div>
        <div class="hero-gradient absolute inset-0"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <span class="inline-block bg-white/20 backdrop-blur text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <i class="fas fa-bus mr-1"></i> ARMADA KAMI
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 leading-tight">
                Armada Bus <span class="text-primary-300">Modern & Nyaman</span>
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto leading-relaxed">
                Armada bus lengkap dengan fasilitas terkini untuk memberikan kenyamanan perjalanan wisata terbaik Anda
            </p>
        </div>
    </section>

    <!-- Stats Armada -->
    <section class="py-12 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach([
                    ['num' => '15+', 'label' => 'Unit Armada', 'icon' => 'fas fa-bus', 'color' => 'text-primary-600'],
                    ['num' => '3', 'label' => 'Tipe Bus', 'icon' => 'fas fa-layer-group', 'color' => 'text-secondary-600'],
                    ['num' => '100%', 'label' => 'Ber-AC', 'icon' => 'fas fa-snowflake', 'color' => 'text-blue-600'],
                    ['num' => '10+', 'label' => 'Tahun Beroperasi', 'icon' => 'fas fa-award', 'color' => 'text-green-600'],
                ] as $stat)
                <div class="text-center p-6" data-aos="fade-up">
                    <i class="{{ $stat['icon'] }} text-3xl {{ $stat['color'] }} mb-2"></i>
                    <div class="text-3xl font-extrabold gradient-text">{{ $stat['num'] }}</div>
                    <div class="text-gray-600 font-medium text-sm">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Tipe Armada -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-bus mr-1"></i> TIPE BUS
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                    Pilih <span class="gradient-text">Armada</span> Sesuai Kebutuhan
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Tersedia berbagai tipe bus untuk menyesuaikan kebutuhan jumlah penumpang dan anggaran Anda
                </p>
            </div>

            <div class="space-y-10">
                @foreach([
                    [
                        'type' => 'Big Bus',
                        'capacity' => '45',
                        'img' => 'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=800&q=80',
                        'price' => 'Rp 2.000.000',
                        'desc' => 'Bus besar ideal untuk rombongan besar. Dilengkapi fasilitas premium dengan tempat duduk reclining dan kaki lega untuk perjalanan jarak jauh yang nyaman.',
                        'features' => ['AC Double Blower', 'WiFi Gratis', 'LCD TV 32"', 'USB Charger', 'Kursi Reclining Full', 'Toilet', 'Audio System', 'CCTV', 'Bagasi Extra Large'],
                        'color' => 'primary',
                    ],
                    [
                        'type' => 'Medium Bus',
                        'capacity' => '35',
                        'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
                        'price' => 'Rp 1.800.000',
                        'desc' => 'Pilihan tepat untuk rombongan menengah. Maneuver mudah di berbagai medan jalan, cocok untuk destinasi wisata yang memerlukan akses lebih fleksibel.',
                        'features' => ['AC Full', 'WiFi Gratis', 'LCD TV 24"', 'USB Charger', 'Kursi Reclining', 'Audio System', 'CCTV', 'Bagasi Luas', 'P3K'],
                        'color' => 'secondary',
                    ],
                    [
                        'type' => 'Mini Bus (Elf)',
                        'capacity' => '19',
                        'img' => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=800&q=80',
                        'price' => 'Rp 800.000',
                        'desc' => 'Cocok untuk rombongan kecil atau keluarga. Lebih lincah dan mudah bermanuver di jalan sempit, ideal untuk wisata ke tempat-tempat yang kurang bisa diakses bus besar.',
                        'features' => ['AC Full', 'Audio', 'USB Charger', 'Bagasi', 'Driver Profesional', 'Asuransi Perjalanan'],
                        'color' => 'primary',
                    ],
                ] as $index => $bus)
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <div class="relative h-64 lg:h-auto overflow-hidden {{ $index % 2 == 1 ? 'lg:order-last' : '' }}">
                            <img src="{{ $bus['img'] }}" alt="{{ $bus['type'] }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent lg:bg-none"></div>
                            <div class="absolute top-4 left-4">
                                <span class="bg-{{ $bus['color'] }}-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    {{ $bus['type'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-4 left-4 lg:hidden text-white">
                                <p class="text-2xl font-extrabold">{{ $bus['capacity'] }} Seat</p>
                            </div>
                        </div>
                        <div class="p-8 lg:p-10 flex flex-col justify-center">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-2xl font-extrabold text-gray-900">{{ $bus['type'] }}</h3>
                                <div class="hidden lg:block text-right">
                                    <p class="text-sm text-gray-500">Kapasitas</p>
                                    <p class="text-2xl font-extrabold gradient-text">{{ $bus['capacity'] }} <span class="text-base text-gray-500">Seat</span></p>
                                </div>
                            </div>
                            <p class="text-gray-600 leading-relaxed mb-6">{{ $bus['desc'] }}</p>
                            <div class="mb-6">
                                <p class="text-sm font-semibold text-gray-700 mb-3">Fasilitas Tersedia:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($bus['features'] as $feature)
                                    <span class="inline-flex items-center bg-{{ $bus['color'] }}-50 text-{{ $bus['color'] }}-700 px-3 py-1 rounded-full text-xs font-semibold border border-{{ $bus['color'] }}-200">
                                        <i class="fas fa-check mr-1 text-{{ $bus['color'] }}-500"></i> {{ $feature }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-500">Mulai dari</p>
                                    <p class="text-2xl font-extrabold text-{{ $bus['color'] }}-600">{{ $bus['price'] }}<span class="text-sm font-normal text-gray-500">/hari</span></p>
                                </div>
                                <a href="{{ route('contact') }}" class="btn-gradient text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition hover:-translate-y-1">
                                    <i class="fas fa-phone mr-2"></i> Pesan Bus Ini
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fasilitas Lengkap -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-secondary-100 text-secondary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-star mr-1"></i> FASILITAS STANDAR
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                    Semua <span class="gradient-text">Armada Dilengkapi</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Setiap unit armada kami memiliki standar kualitas dan fasilitas yang terjamin
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach([
                    ['icon' => 'fas fa-snowflake', 'title' => 'AC Full', 'desc' => 'Pendingin udara kapasitas penuh untuk kenyamanan semua penumpang', 'color' => 'from-blue-400 to-blue-600'],
                    ['icon' => 'fas fa-wifi', 'title' => 'WiFi Gratis', 'desc' => 'Koneksi internet cepat untuk semua penumpang selama perjalanan', 'color' => 'from-green-400 to-green-600'],
                    ['icon' => 'fas fa-couch', 'title' => 'Kursi Reclining', 'desc' => 'Kursi berteknologi reclining untuk istirahat nyaman di perjalanan', 'color' => 'from-primary-400 to-primary-600'],
                    ['icon' => 'fas fa-tv', 'title' => 'LCD TV', 'desc' => 'Hiburan layar lebar selama perjalanan dengan konten pilihan', 'color' => 'from-purple-400 to-purple-600'],
                    ['icon' => 'fas fa-bolt', 'title' => 'USB Charger', 'desc' => 'Port pengisian daya tersedia di setiap kursi penumpang', 'color' => 'from-yellow-400 to-yellow-600'],
                    ['icon' => 'fas fa-shield-alt', 'title' => 'Asuransi', 'desc' => 'Perlindungan asuransi penumpang untuk setiap perjalanan', 'color' => 'from-red-400 to-red-600'],
                    ['icon' => 'fas fa-id-badge', 'title' => 'Driver Bersertifikat', 'desc' => 'Pengemudi profesional dengan SIM B1 dan pengalaman luas', 'color' => 'from-secondary-400 to-secondary-600'],
                    ['icon' => 'fas fa-wrench', 'title' => 'Servis Rutin', 'desc' => 'Perawatan berkala untuk menjamin kelaikan jalan setiap armada', 'color' => 'from-gray-500 to-gray-700'],
                ] as $index => $item)
                <div class="p-6 rounded-2xl bg-gradient-to-br from-gray-50 to-white border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 text-center" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 75 }}">
                    <div class="w-16 h-16 bg-gradient-to-br {{ $item['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="{{ $item['icon'] }} text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ $item['title'] }}</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Booking -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-secondary-700"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                Tertarik Menyewa Armada Kami?
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Hubungi kami sekarang untuk informasi harga dan ketersediaan armada
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Trans,%20saya%20ingin%20menyewa%20bus%20untuk%20wisata" target="_blank"
                   class="inline-flex items-center justify-center bg-green-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-green-600 transition hover:shadow-2xl hover:-translate-y-1">
                    <i class="fab fa-whatsapp mr-3 text-2xl"></i> Chat via WhatsApp
                </a>
                <a href="{{ route('packages.index') }}"
                   class="inline-flex items-center justify-center bg-white text-primary-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition hover:shadow-2xl hover:-translate-y-1">
                    <i class="fas fa-suitcase mr-3"></i> Lihat Paket Wisata
                </a>
            </div>
        </div>
    </section>

@endsection
