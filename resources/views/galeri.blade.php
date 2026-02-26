@extends('layouts.app')

@section('title', 'Galeri - Endah Trans')

@section('content')

    {{-- Hero --}}
    <section class="relative py-24 overflow-hidden bg-white">
        {{-- Dekorasi gelembung warna --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-br from-secondary-100 to-secondary-200 rounded-full blur-3xl opacity-50 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-gradient-to-tr from-primary-100 to-secondary-100 rounded-full blur-3xl opacity-40 -translate-x-1/4 translate-y-1/4"></div>
        {{-- Grid pattern --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #9d174d 1px, transparent 1px); background-size: 32px 32px;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-10">
                {{-- Teks --}}
                <div class="flex-1 text-center md:text-left" data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-600 px-4 py-2 rounded-full text-sm font-bold mb-5">
                        <i class="fas fa-images text-secondary-500"></i> GALERI FOTO
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-4">
                        Galeri
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-primary-500"> Endah Trans</span>
                    </h1>
                    <p class="text-lg text-gray-500 max-w-xl leading-relaxed">
                        Momen-momen berharga perjalanan wisata bersama kami — armada kami, destinasi indah, dan kebahagiaan pelanggan
                    </p>
                    {{-- Breadcrumb --}}
                    <div class="mt-6 flex items-center gap-2 text-sm text-gray-400 justify-center md:justify-start">
                        <a href="{{ route('home') }}" class="hover:text-secondary-500 transition">Beranda</a>
                        <i class="fas fa-chevron-right text-xs"></i>
                        <span class="text-secondary-500 font-semibold">Galeri</span>
                    </div>
                </div>
                {{-- Ikon dekoratif --}}
                <div class="flex-shrink-0" data-aos="fade-left">
                    <div class="relative w-48 h-48 md:w-56 md:h-56">
                        <div class="absolute inset-0 bg-gradient-to-br from-secondary-400 to-primary-500 rounded-3xl rotate-6 opacity-20"></div>
                        <div class="absolute inset-0 bg-gradient-to-br from-secondary-100 to-pink-100 rounded-3xl -rotate-3"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="grid grid-cols-2 gap-2 p-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-secondary-400 to-secondary-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-camera text-white text-2xl"></i>
                                </div>
                                <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-500 rounded-2xl flex items-center justify-center shadow-lg mt-4">
                                    <i class="fas fa-image text-white text-2xl"></i>
                                </div>
                                <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-secondary-400 rounded-2xl flex items-center justify-center shadow-lg -mt-2">
                                    <i class="fas fa-mountain text-white text-2xl"></i>
                                </div>
                                <div class="w-16 h-16 bg-gradient-to-br from-secondary-500 to-primary-400 rounded-2xl flex items-center justify-center shadow-lg mt-2">
                                    <i class="fas fa-bus text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Section --}}
    <section class="py-20 bg-gray-50" x-data="{ filter: 'semua', lightbox: false, activeImg: '' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-600 px-5 py-2 rounded-full text-sm font-bold mb-5">
                    <i class="fas fa-camera text-secondary-500"></i> KOLEKSI FOTO
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                    Lihat Sendiri <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-primary-500">Kualitas Kami</span>
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto">Bukti nyata armada terawat dan perjalanan berkesan bersama Endah Trans</p>
            </div>

            {{-- Filter Tabs --}}
            <div class="flex flex-wrap justify-center gap-3 mb-10" data-aos="fade-up">
                @foreach([['semua','Semua','fas fa-th'],['armada','Armada','fas fa-bus'],['perjalanan','Perjalanan','fas fa-road'],['destinasi','Destinasi','fas fa-mountain']] as $f)
                <button @click="filter='{{ $f[0] }}'"
                        :class="filter==='{{ $f[0] }}' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-lg shadow-secondary-200' : 'bg-white text-gray-600 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300">
                    <i class="{{ $f[2] }}"></i> {{ $f[1] }}
                </button>
                @endforeach
            </div>

            {{-- Gallery Grid --}}
            <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">

                @foreach([
                    ['src'=>'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&q=80','cat'=>'armada','label'=>'Big Bus Eksklusif','tall'=>true],
                    ['src'=>'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=600&q=80','cat'=>'armada','label'=>'Big Bus Reguler','tall'=>false],
                    ['src'=>'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=600&q=80','cat'=>'destinasi','label'=>'Pemandangan Alam','tall'=>false],
                    ['src'=>'https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=600&q=80','cat'=>'perjalanan','label'=>'Rombongan Wisata','tall'=>true],
                    ['src'=>'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=600&q=80','cat'=>'destinasi','label'=>'Destinasi Jawa Tengah','tall'=>false],
                    ['src'=>'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=600&q=80','cat'=>'armada','label'=>'Medium Bus','tall'=>false],
                    ['src'=>'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80','cat'=>'destinasi','label'=>'Pegunungan','tall'=>true],
                    ['src'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80','cat'=>'armada','label'=>'Interior Bus','tall'=>false],
                    ['src'=>'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600&q=80','cat'=>'destinasi','label'=>'Pantai Karimunjawa','tall'=>false],
                    ['src'=>'https://images.unsplash.com/photo-1495562569060-2eec283d3391?w=600&q=80','cat'=>'perjalanan','label'=>'Perjalanan Malam','tall'=>true],
                    ['src'=>'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&q=80','cat'=>'perjalanan','label'=>'Jalanan Wisata','tall'=>false],
                    ['src'=>'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80','cat'=>'perjalanan','label'=>'Pelanggan Puas','tall'=>false],
                ] as $i => $photo)
                <div x-show="filter==='semua' || filter==='{{ $photo['cat'] }}'"
                     x-transition:enter="transition duration-300 ease-out"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group relative overflow-hidden rounded-2xl cursor-pointer break-inside-avoid mb-4 shadow-sm hover:shadow-xl transition-all duration-300"
                     @click="lightbox=true; activeImg='{{ $photo['src'] }}'"
                     data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 80 }}">
                    <img src="{{ $photo['src'] }}"
                         alt="{{ $photo['label'] }}"
                         class="w-full object-cover group-hover:scale-110 transition-transform duration-500 {{ $photo['tall'] ? 'h-72' : 'h-48' }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-white font-semibold text-sm">{{ $photo['label'] }}</span>
                    </div>
                    <div class="absolute top-3 right-3 w-8 h-8 bg-white/80 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <i class="fas fa-expand text-gray-700 text-xs"></i>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

        {{-- Lightbox --}}
        <div x-show="lightbox" x-cloak
             @click="lightbox=false"
             @keydown.escape.window="lightbox=false"
             class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4"
             x-transition:enter="transition duration-200 ease-out"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100">
            <button @click="lightbox=false" class="absolute top-4 right-4 w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition">
                <i class="fas fa-times text-lg"></i>
            </button>
            <img :src="activeImg" alt="Foto" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain" @click.stop>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#080508] via-[#1a0414] to-[#080508]"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-secondary-500/35 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-secondary-600/30 rounded-full blur-3xl"></div>

        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <div class="w-16 h-16 bg-secondary-500/20 border border-secondary-400/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-bus text-secondary-300 text-2xl"></i>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                Ingin Perjalanan <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-300 to-secondary-500">Seperti Ini?</span>
            </h2>
            <p class="text-white/60 text-lg mb-8">Hubungi kami sekarang dan rencanakan perjalanan berkesan bersama Endah Trans</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold text-lg transition hover:-translate-y-1 shadow-xl">
                    <i class="fab fa-whatsapp mr-3 text-2xl"></i> Hubungi via WhatsApp
                </a>
                <a href="{{ route('cara-pesan') }}"
                   class="inline-flex items-center justify-center bg-white/10 border border-white/20 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/20 transition hover:-translate-y-1">
                    <i class="fas fa-info-circle mr-3"></i> Cara Pesan
                </a>
            </div>
        </div>
    </section>

@endsection
