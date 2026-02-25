@extends('layouts.app')

@section('title', 'Agen Resmi - Endah Trans')

@section('content')

    <!-- Hero Section -->
    <section class="relative py-28 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1560264280-88b68371db39?w=1600&q=80"
                 alt="Agen Endah Trans" class="w-full h-full object-cover">
        </div>
        <div class="hero-gradient absolute inset-0"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <span class="inline-block bg-white/20 backdrop-blur text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <i class="fas fa-user-tie mr-1"></i> AGEN RESMI
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 leading-tight">
                Jaringan <span class="text-primary-300">Agen Resmi</span><br>Endah Trans
            </h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto leading-relaxed">
                Bergabunglah dengan jaringan agen resmi kami dan raih keuntungan bersama. Tersebar di berbagai wilayah Jawa dan sekitarnya.
            </p>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-12 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach([
                    ['num' => '50+', 'label' => 'Agen Aktif', 'icon' => 'fas fa-user-tie', 'color' => 'text-primary-600'],
                    ['num' => '10+', 'label' => 'Kota Terjangkau', 'icon' => 'fas fa-map-marker-alt', 'color' => 'text-secondary-600'],
                    ['num' => '10%', 'label' => 'Komisi Agen', 'icon' => 'fas fa-percentage', 'color' => 'text-green-600'],
                    ['num' => '24/7', 'label' => 'Dukungan Tim', 'icon' => 'fas fa-headset', 'color' => 'text-blue-600'],
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

    <!-- Daftar Agen -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-map-marker-alt mr-1"></i> AGEN KAMI
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                    Agen Resmi <span class="gradient-text">Endah Trans</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Temukan agen terdekat di kota Anda untuk pemesanan dan informasi lebih lanjut
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    ['name' => 'Agen Jepara Pusat', 'area' => 'Jepara, Jawa Tengah', 'contact' => '+62 811-1234-5678', 'address' => 'Jl. Raya Jepara-Kudus No.15, Jepara', 'status' => 'Aktif', 'verified' => true, 'img' => '1'],
                    ['name' => 'Agen Kudus', 'area' => 'Kudus, Jawa Tengah', 'contact' => '+62 812-3456-7890', 'address' => 'Jl. A. Yani No.22, Kudus', 'status' => 'Aktif', 'verified' => true, 'img' => '2'],
                    ['name' => 'Agen Pati', 'area' => 'Pati, Jawa Tengah', 'contact' => '+62 813-5678-9012', 'address' => 'Jl. Panglima Sudirman No.8, Pati', 'status' => 'Aktif', 'verified' => true, 'img' => '3'],
                    ['name' => 'Agen Demak', 'area' => 'Demak, Jawa Tengah', 'contact' => '+62 814-7890-1234', 'address' => 'Jl. Sultan Fatah No.10, Demak', 'status' => 'Aktif', 'verified' => false, 'img' => '4'],
                    ['name' => 'Agen Semarang', 'area' => 'Semarang, Jawa Tengah', 'contact' => '+62 815-9012-3456', 'address' => 'Jl. Pandanaran No.45, Semarang', 'status' => 'Aktif', 'verified' => true, 'img' => '5'],
                    ['name' => 'Agen Rembang', 'area' => 'Rembang, Jawa Tengah', 'contact' => '+62 816-1234-5678', 'address' => 'Jl. Pemuda No.33, Rembang', 'status' => 'Aktif', 'verified' => false, 'img' => '6'],
                ] as $index => $agent)
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden card-hover border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="bg-gradient-to-br from-primary-500 to-primary-700 p-6 text-center relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($agent['name']) }}&background=ffffff&color=ef4444&bold=true&size=80"
                             alt="{{ $agent['name'] }}"
                             class="w-20 h-20 rounded-2xl mx-auto shadow-lg border-4 border-white/20">
                        <h3 class="text-white font-bold text-lg mt-3">{{ $agent['name'] }}</h3>
                        <p class="text-white/80 text-sm">{{ $agent['area'] }}</p>
                        @if($agent['verified'])
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                                <i class="fas fa-check-circle"></i> Terverifikasi
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 mb-5">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-map-marker-alt text-primary-500 mt-1 w-4 flex-shrink-0"></i>
                                <p class="text-gray-600 text-sm">{{ $agent['address'] }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone text-primary-500 w-4 flex-shrink-0"></i>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent['contact']) }}" class="text-gray-700 text-sm font-semibold hover:text-primary-600">{{ $agent['contact'] }}</a>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-circle text-green-500 text-xs w-4 flex-shrink-0"></i>
                                <span class="text-green-600 text-sm font-semibold">{{ $agent['status'] }}</span>
                            </div>
                        </div>
                        <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20menghubungi%20{{ urlencode($agent['name']) }}" target="_blank"
                           class="w-full inline-flex items-center justify-center bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition hover:shadow-lg">
                            <i class="fab fa-whatsapp mr-2"></i> Hubungi Agen
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Keuntungan Menjadi Agen -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-secondary-100 text-secondary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-handshake mr-1"></i> BERGABUNG BERSAMA KAMI
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                    Keuntungan <span class="gradient-text">Menjadi Agen</span> Endah Trans
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Raih pendapatan tambahan dengan menjadi agen resmi kami tanpa modal besar
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    ['icon' => 'fas fa-percentage', 'color' => 'from-green-400 to-green-600', 'title' => 'Komisi Menarik', 'desc' => 'Dapatkan komisi kompetitif hingga 10% untuk setiap booking yang berhasil Anda lakukan melalui jaringan kami.'],
                    ['icon' => 'fas fa-graduation-cap', 'color' => 'from-blue-400 to-blue-600', 'title' => 'Pelatihan Gratis', 'desc' => 'Kami menyediakan pelatihan produk, sistem pemesanan, dan strategi penjualan secara gratis untuk semua agen baru.'],
                    ['icon' => 'fas fa-headset', 'color' => 'from-primary-400 to-primary-600', 'title' => 'Dukungan 24/7', 'desc' => 'Tim support kami selalu siap membantu menjawab pertanyaan dan membantu proses booking kapan saja dibutuhkan.'],
                    ['icon' => 'fas fa-tools', 'color' => 'from-purple-400 to-purple-600', 'title' => 'Materi Promosi', 'desc' => 'Dapatkan berbagai materi promosi digital dan fisik secara gratis untuk memudahkan pemasaran layanan kami.'],
                    ['icon' => 'fas fa-trophy', 'color' => 'from-yellow-400 to-yellow-600', 'title' => 'Bonus & Reward', 'desc' => 'Agen dengan performa terbaik mendapatkan bonus bulanan dan hadiah menarik setiap tahunnya dari perusahaan.'],
                    ['icon' => 'fas fa-network-wired', 'color' => 'from-secondary-400 to-secondary-600', 'title' => 'Jaringan Luas', 'desc' => 'Bergabung dalam jaringan agen resmi yang solid dan saling mendukung untuk meraih keuntungan bersama.'],
                ] as $index => $benefit)
                <div class="p-8 rounded-3xl bg-gradient-to-br from-gray-50 to-white border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="w-16 h-16 bg-gradient-to-br {{ $benefit['color'] }} rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="{{ $benefit['icon'] }} text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $benefit['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $benefit['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Cara Mendaftar -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-clipboard-list mr-1"></i> LANGKAH MUDAH
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                    Cara <span class="gradient-text">Mendaftar</span> sebagai Agen
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach([
                    ['step' => '1', 'icon' => 'fas fa-phone', 'title' => 'Hubungi Kami', 'desc' => 'Hubungi tim kami via WhatsApp atau telepon untuk informasi awal program keagenan.'],
                    ['step' => '2', 'icon' => 'fas fa-file-alt', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi formulir pendaftaran agen dengan data diri dan area kerja yang diinginkan.'],
                    ['step' => '3', 'icon' => 'fas fa-handshake', 'title' => 'Penandatanganan', 'desc' => 'Lakukan penandatanganan perjanjian keagenan resmi dengan tim kami.'],
                    ['step' => '4', 'icon' => 'fas fa-rocket', 'title' => 'Mulai Berjualan', 'desc' => 'Anda sudah resmi menjadi agen dan dapat mulai melayani pelanggan dengan dukungan penuh dari kami.'],
                ] as $index => $step)
                <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="{{ $step['icon'] }} text-white text-xl"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-7 h-7 bg-secondary-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow">
                            {{ $step['step'] }}
                        </div>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ $step['title'] }}</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Daftar Agen -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-secondary-700"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                Tertarik Menjadi Agen Resmi Kami?
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Hubungi kami sekarang dan mulai perjalanan bisnis Anda bersama Endah Trans!
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Trans,%20saya%20tertarik%20menjadi%20agen%20resmi" target="_blank"
                   class="inline-flex items-center justify-center bg-green-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-green-600 transition hover:-translate-y-1">
                    <i class="fab fa-whatsapp mr-3 text-2xl"></i> Daftar via WhatsApp
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center bg-white text-primary-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition hover:-translate-y-1">
                    <i class="fas fa-envelope mr-3"></i> Kirim Formulir
                </a>
            </div>
        </div>
    </section>

@endsection
