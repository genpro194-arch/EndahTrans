@extends('layouts.app')

@section('title', 'Rute Perjalanan - Endah Trans')

@section('content')

    {{-- Hero --}}
    <section class="relative py-24 overflow-hidden bg-white">
        {{-- Dekorasi --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-bl from-secondary-100 to-primary-100 rounded-full blur-3xl opacity-50 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-gradient-to-tr from-secondary-50 to-pink-100 rounded-full blur-3xl opacity-40 -translate-x-1/4 translate-y-1/4"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #9d174d 1px, transparent 1px); background-size: 32px 32px;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-10">
                {{-- Teks --}}
                <div class="flex-1 text-center md:text-left" data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-600 px-4 py-2 rounded-full text-sm font-bold mb-5">
                        <i class="fas fa-map-marked-alt text-secondary-500"></i> VIDEO RUTE
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-4">
                        Rute
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-500 to-primary-500"> Perjalanan</span>
                        Kami
                    </h1>
                    <p class="text-lg text-gray-500 max-w-xl leading-relaxed">
                        Lihat video rute perjalanan kami ke berbagai destinasi wisata Indonesia
                    </p>
                    @if($routeVideos->count() > 0)
                    <div class="mt-5 flex flex-wrap gap-3 justify-center md:justify-start">
                        <span class="inline-flex items-center gap-2 bg-secondary-50 border border-secondary-200 text-secondary-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-video text-secondary-500"></i> {{ $routeVideos->count() }} Video
                        </span>
                        @php $destCount = $routeVideos->pluck('destination')->filter()->unique()->count(); @endphp
                        @if($destCount > 0)
                        <span class="inline-flex items-center gap-2 bg-primary-50 border border-primary-200 text-primary-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-map-marker-alt text-primary-500"></i> {{ $destCount }} Destinasi
                        </span>
                        @endif
                    </div>
                    @endif
                    {{-- Breadcrumb --}}
                    <div class="mt-6 flex items-center gap-2 text-sm text-gray-400 justify-center md:justify-start">
                        <a href="{{ route('home') }}" class="hover:text-secondary-500 transition">Beranda</a>
                        <i class="fas fa-chevron-right text-xs"></i>
                        <span class="text-secondary-500 font-semibold">Rute</span>
                    </div>
                </div>
                {{-- Ikon dekoratif --}}
                <div class="flex-shrink-0" data-aos="fade-left">
                    <div class="relative w-48 h-48 md:w-56 md:h-56">
                        <div class="absolute inset-0 bg-gradient-to-br from-secondary-400 to-primary-500 rounded-full opacity-10"></div>
                        <div class="absolute inset-4 bg-gradient-to-br from-secondary-50 to-pink-50 rounded-full border-4 border-secondary-100"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-20 h-20 bg-gradient-to-br from-secondary-400 to-primary-500 rounded-2xl flex items-center justify-center mx-auto shadow-xl shadow-secondary-200">
                                    <i class="fas fa-map-marked-alt text-white text-3xl"></i>
                                </div>
                                <div class="mt-3 flex justify-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-secondary-400"></span>
                                    <span class="w-3 h-3 rounded-full bg-primary-400"></span>
                                    <span class="w-3 h-3 rounded-full bg-pink-400"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Video Grid --}}
    <section class="py-20 bg-gray-50" x-data="{ filterRute: 'semua' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($routeVideos->count() > 0)
            @php
                $destinations = $routeVideos->pluck('destination')->filter()->unique()->sort()->values();
            @endphp

            {{-- Filter --}}
            <div class="flex flex-wrap justify-center gap-3 mb-12" data-aos="fade-up">
                <button @click="filterRute='semua'"
                        :class="filterRute==='semua' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-lg shadow-secondary-200' : 'bg-white text-gray-600 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200">
                    <i class="fas fa-globe mr-1"></i> Semua Tujuan
                </button>
                @foreach($destinations as $dest)
                <button @click="filterRute='{{ $dest }}'"
                        :class="filterRute==='{{ $dest }}' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white shadow-lg shadow-secondary-200' : 'bg-white text-gray-600 border border-gray-200 hover:border-secondary-300 hover:text-secondary-600'"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200">
                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $dest }}
                </button>
                @endforeach
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($routeVideos as $i => $video)
                <div x-show="filterRute==='semua' || filterRute==='{{ $video->destination }}'"
                     x-transition:enter="transition duration-300 ease-out"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-secondary-200 hover:shadow-xl transition-all duration-300"
                     data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 100 }}">
                    <div class="relative aspect-video overflow-hidden">
                        <iframe src="{{ $video->embed_url }}"
                                class="w-full h-full"
                                frameborder="0" allowfullscreen
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                        </iframe>
                    </div>
                    <div class="p-5">
                        @if($video->destination)
                        <span class="inline-block text-xs bg-secondary-50 text-secondary-600 border border-secondary-100 font-semibold px-3 py-1 rounded-full mb-3">
                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $video->destination }}
                        </span>
                        @endif
                        <h3 class="font-extrabold text-gray-900 text-base leading-snug mb-2">{{ $video->title }}</h3>
                        @if($video->description)
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $video->description }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- No result notice --}}
            <div x-show="filterRute !== 'semua' && document.querySelectorAll('[x-show]:not([style*=\'display: none\'])').length === 0"
                 class="text-center py-16">
                <i class="fas fa-video-slash text-gray-300 text-5xl mb-4 block"></i>
                <p class="text-gray-500 font-medium">Belum ada video untuk destinasi ini.</p>
            </div>

            @else
            <div class="text-center py-24" data-aos="fade-up">
                <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <i class="fas fa-video text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-extrabold text-gray-700 mb-2">Belum Ada Video Rute</h3>
                <p class="text-gray-400 text-sm">Video rute perjalanan akan ditampilkan di sini.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#080508] via-[#1a0414] to-[#080508]"></div>
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-secondary-500/35 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-secondary-600/30 rounded-full blur-3xl"></div>
        <div class="relative max-w-3xl mx-auto px-4 text-center" data-aos="zoom-in">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-3">
                Tertarik dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-300 to-secondary-500">rute ini?</span>
            </h2>
            <p class="text-white/60 mb-7">Hubungi kami untuk konsultasi dan pemesanan armada</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white px-7 py-3.5 rounded-2xl font-bold transition hover:-translate-y-1 shadow-xl">
                    <i class="fab fa-whatsapp mr-2 text-xl"></i> Tanya via WhatsApp
                </a>
                <a href="{{ route('cara-pesan') }}"
                   class="inline-flex items-center justify-center bg-white/10 border border-white/20 text-white px-7 py-3.5 rounded-2xl font-bold hover:bg-white/20 transition hover:-translate-y-1">
                    <i class="fas fa-clipboard-list mr-2"></i> Cara Pesan
                </a>
            </div>
        </div>
    </section>

@endsection
