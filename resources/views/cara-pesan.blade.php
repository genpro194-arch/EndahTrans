@extends('layouts.app')

@section('title', 'Cara Pesan - Endah Trans')

@section('content')

    {{-- Hero --}}
    <section class="relative py-24 overflow-hidden bg-white">
        {{-- Dekorasi --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-bl from-primary-100 to-secondary-100 rounded-full blur-3xl opacity-50 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-gradient-to-tr from-secondary-100 to-pink-100 rounded-full blur-3xl opacity-40 -translate-x-1/4 translate-y-1/4"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #9d174d 1px, transparent 1px); background-size: 32px 32px;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-10">
                {{-- Teks --}}
                <div class="flex-1 text-center md:text-left" data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-600 px-4 py-2 rounded-full text-sm font-bold mb-5">
                        <i class="fas fa-clipboard-list text-secondary-500"></i> PANDUAN PEMESANAN
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-4">
                        Cara
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-primary-500"> Pesan</span>
                        Armada
                    </h1>
                    <p class="text-lg text-gray-500 max-w-xl leading-relaxed">
                        Proses pemesanan yang mudah, cepat, dan transparan — hanya 4 langkah dari kontak hingga berangkat
                    </p>
                    <div class="mt-5 flex flex-wrap gap-3 justify-center md:justify-start">
                        <span class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle text-secondary-500"></i> 4 Langkah Mudah
                        </span>
                        <span class="inline-flex items-center gap-2 bg-primary-50 border border-primary-200 text-primary-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-bolt text-primary-500"></i> Fast Response
                        </span>
                    </div>
                    {{-- Breadcrumb --}}
                    <div class="mt-6 flex items-center gap-2 text-sm text-gray-400 justify-center md:justify-start">
                        <a href="{{ route('home') }}" class="hover:text-secondary-500 transition">Beranda</a>
                        <i class="fas fa-chevron-right text-xs"></i>
                        <span class="text-secondary-500 font-semibold">Cara Pesan</span>
                    </div>
                </div>
                {{-- Ikon dekoratif: 4 langkah visual --}}
                <div class="flex-shrink-0" data-aos="fade-left">
                    <div class="relative flex flex-col gap-3">
                        @foreach([['fas fa-phone-alt','from-secondary-400 to-secondary-600','Hubungi'],['fas fa-comments','from-secondary-500 to-primary-500','Diskusi'],['fas fa-file-contract','from-primary-400 to-secondary-500','DP'],['fas fa-bus','from-secondary-400 to-primary-600','Berangkat!']] as $i => $s)
                        <div class="flex items-center gap-3 {{ $i % 2 === 1 ? 'ml-8' : '' }}" data-aos="fade-left" data-aos-delay="{{ $i * 80 }}">
                            <div class="w-10 h-10 bg-gradient-to-br {{ $s[1] }} rounded-xl flex items-center justify-center shadow-md flex-shrink-0">
                                <i class="{{ $s[0] }} text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-bold text-gray-700">{{ $s[2] }}</span>
                            @if($i < 3)<i class="fas fa-arrow-right text-gray-300 text-xs"></i>@endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Steps Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-600 px-5 py-2 rounded-full text-sm font-bold mb-5">
                    <i class="fas fa-list-ol text-secondary-500"></i> LANGKAH PEMESANAN
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                    Hanya <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-primary-500">4 Langkah</span> Mudah
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto">Dari pertama kontak hingga berangkat, kami pastikan prosesnya mulus</p>
            </div>

            <div class="relative">
                {{-- Garis vertikal penghubung --}}
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-secondary-400 via-primary-400 to-secondary-400 hidden md:block"></div>

                <div class="space-y-10">
                    @foreach([
                        [
                            'num'  => '01',
                            'icon' => 'fas fa-phone-alt',
                            'from' => 'from-secondary-400', 'to' => 'to-secondary-600',
                            'title'=> 'Hubungi Kami',
                            'desc' => 'Kontak kami via WhatsApp, telepon, atau email. Ceritakan kebutuhan Anda: tanggal berangkat, jumlah penumpang, dan tujuan.',
                            'tip'  => 'Tersedia 7 hari seminggu, fast response via WhatsApp',
                            'tip_icon' => 'fas fa-check-circle',
                        ],
                        [
                            'num'  => '02',
                            'icon' => 'fas fa-comments',
                            'from' => 'from-secondary-500', 'to' => 'to-primary-500',
                            'title'=> 'Diskusi & Penawaran',
                            'desc' => 'Tim kami akan memberikan rekomendasi armada yang paling sesuai beserta detail harga, fasilitas, dan jadwal perjalanan.',
                            'tip'  => 'Penawaran gratis, tanpa biaya konsultasi',
                            'tip_icon' => 'fas fa-tag',
                        ],
                        [
                            'num'  => '03',
                            'icon' => 'fas fa-file-contract',
                            'from' => 'from-primary-400', 'to' => 'to-secondary-500',
                            'title'=> 'Konfirmasi & DP',
                            'desc' => 'Setelah setuju dengan penawaran, konfirmasi pemesanan dengan membayar uang muka (DP) minimal 30% dari total biaya.',
                            'tip'  => 'Transfer bank / tunai / QRIS tersedia',
                            'tip_icon' => 'fas fa-credit-card',
                        ],
                        [
                            'num'  => '04',
                            'icon' => 'fas fa-bus',
                            'from' => 'from-secondary-400', 'to' => 'to-primary-600',
                            'title'=> 'Berangkat!',
                            'desc' => 'Pada hari keberangkatan, armada kami tiba di lokasi penjemputan sesuai jadwal. Pelunasan dilakukan sebelum berangkat.',
                            'tip'  => 'Driver berpengalaman & armada terawat siap melayani',
                            'tip_icon' => 'fas fa-shield-alt',
                        ],
                    ] as $i => $step)
                    <div class="flex items-start gap-6" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        {{-- Nomor & Ikon --}}
                        <div class="relative flex-shrink-0 z-10">
                            <div class="w-16 h-16 bg-gradient-to-br {{ $step['from'] }} {{ $step['to'] }} rounded-2xl flex items-center justify-center shadow-lg shadow-secondary-200">
                                <i class="{{ $step['icon'] }} text-white text-xl"></i>
                            </div>
                            <span class="absolute -top-2 -right-2 w-6 h-6 bg-white border-2 border-secondary-400 rounded-full flex items-center justify-center text-xs font-black text-secondary-600">{{ $i+1 }}</span>
                        </div>

                        {{-- Konten --}}
                        <div class="flex-1 bg-gray-50 hover:bg-white border border-gray-100 hover:border-secondary-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-xs font-black tracking-widest text-secondary-400">LANGKAH {{ $step['num'] }}</span>
                                <div class="h-px flex-1 bg-gradient-to-r {{ $step['from'] }} {{ $step['to'] }} opacity-30"></div>
                            </div>
                            <h3 class="text-xl font-extrabold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                            <p class="text-gray-500 leading-relaxed mb-4">{{ $step['desc'] }}</p>
                            <div class="flex items-center gap-2 text-sm text-secondary-600 font-semibold">
                                <i class="{{ $step['tip_icon'] }} text-secondary-500"></i>
                                {{ $step['tip'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Info Penting --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-3">
                    Informasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-primary-500">Penting</span>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['icon'=>'fas fa-clock','color'=>'text-secondary-500','bg'=>'bg-secondary-50','border'=>'border-secondary-100','title'=>'Waktu Pemesanan','desc'=>'Disarankan memesan minimal 3-7 hari sebelum keberangkatan. Untuk high season (libur nasional/lebaran) minimal 2 minggu sebelumnya.'],
                    ['icon'=>'fas fa-money-bill-wave','color'=>'text-secondary-500','bg'=>'bg-secondary-50','border'=>'border-secondary-100','title'=>'Pembayaran','desc'=>'DP minimal 30% saat konfirmasi. Pelunasan dilakukan H-1 atau sebelum kendaraan berangkat. Tersedia transfer bank, tunai, dan QRIS.'],
                    ['icon'=>'fas fa-undo','color'=>'text-primary-500','bg'=>'bg-primary-50','border'=>'border-primary-100','title'=>'Pembatalan','desc'=>'Pembatalan lebih dari 3 hari: DP kembali 50%. Pembatalan kurang dari 3 hari: DP tidak kembali. Force majeure dikaji case by case.'],
                ] as $info)
                <div class="bg-white rounded-2xl p-6 border {{ $info['border'] }} hover:shadow-lg transition-all duration-300" data-aos="fade-up">
                    <div class="w-12 h-12 {{ $info['bg'] }} rounded-xl flex items-center justify-center mb-4 border {{ $info['border'] }}">
                        <i class="{{ $info['icon'] }} {{ $info['color'] }} text-xl"></i>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-lg mb-2">{{ $info['title'] }}</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $info['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="py-16 bg-white" x-data="{ open: null }">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-600 px-5 py-2 rounded-full text-sm font-bold mb-5">
                    <i class="fas fa-question-circle text-secondary-500"></i> FAQ
                </span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-3">Pertanyaan yang Sering Ditanyakan</h2>
            </div>

            <div class="space-y-3">
                @foreach([
                    ['q'=>'Apakah bisa pesan tanpa DP?','a'=>'Tidak bisa. DP minimal 30% diperlukan untuk konfirmasi dan pemblokiran unit armada pada tanggal yang Anda inginkan.'],
                    ['q'=>'Berapa jumlah penumpang minimal?','a'=>'Tidak ada minimal penumpang. Kami melayani dari kapasitas kecil (medium bus 35 kursi) hingga besar (big bus 45 kursi).'],
                    ['q'=>'Apakah harga sudah termasuk BBM dan tol?','a'=>'Harga biasanya sudah all-in (BBM, tol, driver). Namun harap konfirmasi saat diskusi karena tergantung rute dan jenis charter.'],
                    ['q'=>'Bisa pesan untuk perjalanan luar kota/pulau?','a'=>'Bisa! Kami melayani perjalanan dalam dan luar kota Jawa Tengah. Hubungi kami untuk rute dan estimasi biaya.'],
                    ['q'=>'Apakah driver menginap jika perjalanan multi-hari?','a'=>'Ya, biaya akomodasi driver (hotel/penginapan) ditanggung oleh pemesan, atau bisa dikoordinasikan bersama saat pemesanan.'],
                ] as $i => $faq)
                <div class="border border-gray-100 rounded-2xl overflow-hidden hover:border-secondary-200 transition-colors" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <button @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                            class="w-full flex items-center justify-between px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-bold text-gray-800 pr-4">{{ $faq['q'] }}</span>
                        <span class="flex-shrink-0 w-7 h-7 bg-secondary-50 border border-secondary-200 rounded-full flex items-center justify-center transition-transform duration-300"
                              :class="open === {{ $i }} ? 'rotate-45 bg-secondary-500 border-secondary-500' : ''">
                            <i class="fas fa-plus text-xs" :class="open === {{ $i }} ? 'text-white' : 'text-secondary-500'"></i>
                        </span>
                    </button>
                    <div x-show="open === {{ $i }}"
                         x-transition:enter="transition duration-200 ease-out"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="px-6 pb-5 text-gray-500 text-sm leading-relaxed border-t border-gray-50 pt-3">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#080508] via-[#1a0414] to-[#080508]"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-secondary-500/35 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-secondary-600/30 rounded-full blur-3xl"></div>

        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <div class="w-16 h-16 bg-secondary-500/20 border border-secondary-400/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-comments text-secondary-300 text-2xl"></i>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                Siap <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-300 to-secondary-500">Memesan?</span>
            </h2>
            <p class="text-white/60 text-lg mb-8">Hubungi kami sekarang — konsultasi gratis, tanpa syarat</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="https://wa.me/6281234567890?text=Halo%20Endah%20Trans,%20saya%20ingin%20memesan%20armada" target="_blank"
                   class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold text-lg transition hover:-translate-y-1 shadow-xl">
                    <i class="fab fa-whatsapp mr-3 text-2xl"></i> Pesan via WhatsApp
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center bg-white/10 border border-white/20 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/20 transition hover:-translate-y-1">
                    <i class="fas fa-envelope mr-3"></i> Kirim Pesan
                </a>
            </div>
        </div>
    </section>

@endsection
