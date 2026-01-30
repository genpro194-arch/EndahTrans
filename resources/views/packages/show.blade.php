@extends('layouts.app')

@section('title', $package->name . ' - Endah Travel')

@section('content')
    <!-- Hero Header -->
    <section class="relative h-[50vh] min-h-[400px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ $package->image_url }}" alt="{{ $package->name }}" 
                 class="w-full h-full object-cover"
                 onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1920'">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        
        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-end pb-12">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-4" data-aos="fade-up">
                <a href="{{ route('home') }}" class="text-white/70 hover:text-white transition">Beranda</a>
                <span class="mx-2 text-white/50">/</span>
                <a href="{{ route('packages.index') }}" class="text-white/70 hover:text-white transition">Paket Wisata</a>
                <span class="mx-2 text-white/50">/</span>
                <span class="text-white">{{ Str::limit($package->name, 30) }}</span>
            </nav>
            
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="inline-flex items-center bg-white/20 backdrop-blur text-white px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-map-marker-alt mr-1.5"></i> {{ $package->destination->name }}
                    </span>
                    <span class="inline-flex items-center bg-white/20 backdrop-blur text-white px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-clock mr-1.5"></i> {{ $package->duration_days }} Hari {{ $package->duration_nights }} Malam
                    </span>
                    @if($package->discount_price)
                    <span class="inline-flex items-center bg-gradient-to-r from-secondary-500 to-secondary-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                        <i class="fas fa-bolt mr-1"></i> DISKON {{ $package->discount_percent }}%
                    </span>
                    @endif
                    @if($package->is_featured)
                    <span class="inline-flex items-center bg-gradient-to-r from-primary-500 to-primary-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                        <i class="fas fa-star mr-1"></i> Best Seller
                    </span>
                    @endif
                </div>
                
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white mb-4">{{ $package->name }}</h1>
                
                <div class="flex flex-wrap items-center gap-6 text-white/80 text-sm">
                    <span><i class="fas fa-users mr-1.5"></i> {{ $package->min_person }}-{{ $package->max_person }} Orang</span>
                    @if($package->meeting_point)
                    <span><i class="fas fa-map-pin mr-1.5"></i> {{ $package->meeting_point }}</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Main Content -->
                <div class="lg:w-2/3 space-y-6">
                    <!-- Quick Info Cards -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up">
                        <div class="bg-white rounded-2xl p-4 shadow-lg text-center card-hover">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-calendar-alt text-primary-600 text-xl"></i>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">{{ $package->duration_days }}</div>
                            <div class="text-sm text-gray-500">Hari</div>
                        </div>
                        <div class="bg-white rounded-2xl p-4 shadow-lg text-center card-hover">
                            <div class="w-12 h-12 bg-secondary-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-moon text-secondary-600 text-xl"></i>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">{{ $package->duration_nights }}</div>
                            <div class="text-sm text-gray-500">Malam</div>
                        </div>
                        <div class="bg-white rounded-2xl p-4 shadow-lg text-center card-hover">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-users text-primary-600 text-xl"></i>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">{{ $package->max_person }}</div>
                            <div class="text-sm text-gray-500">Maks Orang</div>
                        </div>
                        <div class="bg-white rounded-2xl p-4 shadow-lg text-center card-hover">
                            <div class="w-12 h-12 bg-secondary-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-star text-secondary-600 text-xl"></i>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">4.9</div>
                            <div class="text-sm text-gray-500">Rating</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-3xl shadow-xl p-8" data-aos="fade-up">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-info-circle text-primary-600"></i>
                            </div>
                            Tentang Paket Ini
                        </h2>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $package->description }}</p>
                        
                        @if($package->highlights)
                            @php 
                                $highlights = is_string($package->highlights) ? json_decode($package->highlights, true) : $package->highlights;
                            @endphp
                            @if($highlights && count($highlights) > 0)
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <h3 class="font-bold text-gray-900 mb-4">Highlight Perjalanan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($highlights as $highlight)
                                    <div class="flex items-center bg-gradient-to-r from-primary-50 to-transparent p-3 rounded-xl">
                                        <i class="fas fa-check-circle text-primary-500 mr-3"></i>
                                        <span class="text-gray-700">{{ $highlight }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>

                    <!-- Itinerary -->
                    @if($package->itinerary)
                    <div class="bg-white rounded-3xl shadow-xl p-8" data-aos="fade-up">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="w-10 h-10 bg-secondary-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-route text-secondary-600"></i>
                            </div>
                            Itinerary Perjalanan
                        </h2>
                        
                        @php
                            $itinerary = is_string($package->itinerary) ? json_decode($package->itinerary, true) : $package->itinerary;
                        @endphp
                        
                        @if(is_array($itinerary))
                        <div class="space-y-4">
                            @foreach($itinerary as $day => $activities)
                            <div class="relative pl-8 pb-6 border-l-2 border-primary-200 last:border-l-0 last:pb-0">
                                <div class="absolute left-0 top-0 w-4 h-4 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full -translate-x-[9px] shadow-lg"></div>
                                <div class="bg-gradient-to-r from-primary-50 to-transparent rounded-2xl p-5">
                                    <h3 class="font-bold text-primary-600 mb-3 text-lg">{{ $day }}</h3>
                                    @if(is_array($activities))
                                    <ul class="space-y-2">
                                        @foreach($activities as $activity)
                                        <li class="flex items-start text-gray-600">
                                            <i class="fas fa-circle text-primary-400 text-[6px] mt-2 mr-3"></i>
                                            {{ $activity }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="text-gray-600">{{ $activities }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($package->itinerary)) !!}
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Includes & Excludes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($package->includes)
                        <div class="bg-white rounded-3xl shadow-xl p-6" data-aos="fade-up">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <div class="w-10 h-10 bg-secondary-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-check text-secondary-600"></i>
                                </div>
                                Termasuk
                            </h3>
                            @php
                                $includes = is_string($package->includes) ? json_decode($package->includes, true) : $package->includes;
                            @endphp
                            <ul class="space-y-3">
                                @if(is_array($includes))
                                    @foreach($includes as $item)
                                    <li class="flex items-start">
                                        <div class="w-6 h-6 bg-secondary-100 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                            <i class="fas fa-check text-secondary-600 text-xs"></i>
                                        </div>
                                        <span class="text-gray-600">{{ $item }}</span>
                                    </li>
                                    @endforeach
                                @else
                                    @foreach(explode("\n", $package->includes) as $item)
                                        @if(trim($item))
                                        <li class="flex items-start">
                                            <div class="w-6 h-6 bg-secondary-100 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                                <i class="fas fa-check text-secondary-600 text-xs"></i>
                                            </div>
                                            <span class="text-gray-600">{{ trim($item) }}</span>
                                        </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        @endif

                        @if($package->excludes)
                        <div class="bg-white rounded-3xl shadow-xl p-6" data-aos="fade-up" data-aos-delay="100">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-times text-primary-600"></i>
                                </div>
                                Tidak Termasuk
                            </h3>
                            @php
                                $excludes = is_string($package->excludes) ? json_decode($package->excludes, true) : $package->excludes;
                            @endphp
                            <ul class="space-y-3">
                                @if(is_array($excludes))
                                    @foreach($excludes as $item)
                                    <li class="flex items-start">
                                        <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                            <i class="fas fa-times text-primary-600 text-xs"></i>
                                        </div>
                                        <span class="text-gray-600">{{ $item }}</span>
                                    </li>
                                    @endforeach
                                @else
                                    @foreach(explode("\n", $package->excludes) as $item)
                                        @if(trim($item))
                                        <li class="flex items-start">
                                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-3 mt-0.5 flex-shrink-0">
                                                <i class="fas fa-times text-primary-600 text-xs"></i>
                                            </div>
                                            <span class="text-gray-600">{{ trim($item) }}</span>
                                        </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-3xl shadow-xl p-6 sticky top-24" data-aos="fade-left">
                        <!-- Price -->
                        <div class="text-center mb-6 pb-6 border-b border-gray-100">
                            @if($package->discount_price)
                                <div class="inline-block bg-secondary-100 text-secondary-600 px-3 py-1 rounded-full text-sm font-semibold mb-2">
                                    Hemat Rp {{ number_format($package->price - $package->discount_price, 0, ',', '.') }}
                                </div>
                                <p class="text-gray-400 line-through text-lg">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                <p class="text-4xl font-extrabold gradient-text">Rp {{ number_format($package->discount_price, 0, ',', '.') }}</p>
                            @else
                                <p class="text-4xl font-extrabold gradient-text">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                            @endif
                            <p class="text-gray-500 mt-1">per orang</p>
                            <p class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-users mr-1"></i> untuk {{ $package->min_person }}-{{ $package->max_person }} orang
                            </p>
                        </div>

                        <!-- Booking Buttons -->
                        <div class="space-y-3 mb-6">
                            <a href="{{ route('booking.create', $package->slug) }}" 
                               class="flex items-center justify-center w-full btn-gradient text-white py-4 rounded-2xl font-bold text-lg shadow-lg">
                                <i class="fas fa-ticket-alt mr-2"></i> Pesan Sekarang
                            </a>

                            <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Endah Travel, saya tertarik dengan paket: ' . $package->name . ' - ' . url()->current()) }}" 
                               target="_blank"
                               class="flex items-center justify-center w-full btn-gradient-green text-white py-4 rounded-2xl font-bold text-lg shadow-lg">
                                <i class="fab fa-whatsapp mr-2 text-xl"></i> Tanya via WhatsApp
                            </a>
                        </div>

                        <!-- Important Info -->
                        <div class="bg-gradient-to-br from-primary-50 to-secondary-50 rounded-2xl p-5 mb-6">
                            <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-exclamation-circle text-primary-500 mr-2"></i>
                                Informasi Penting
                            </h4>
                            <ul class="space-y-3 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-users text-primary-500 mt-1 mr-3"></i>
                                    <span>Minimal peserta: <strong>{{ $package->min_person }} orang</strong></span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-undo text-primary-500 mt-1 mr-3"></i>
                                    <span>Pembatalan gratis hingga <strong>3 hari</strong> sebelum keberangkatan</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-credit-card text-primary-500 mt-1 mr-3"></i>
                                    <span>Pembayaran DP minimal <strong>50%</strong></span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-shield-alt text-primary-500 mt-1 mr-3"></i>
                                    <span>Termasuk <strong>asuransi perjalanan</strong></span>
                                </li>
                            </ul>
                        </div>

                        <!-- Contact -->
                        <div class="text-center">
                            <h4 class="font-bold text-gray-900 mb-3">Butuh Bantuan?</h4>
                            <div class="flex justify-center gap-4">
                                <a href="tel:+6281234567890" class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 hover:bg-primary-200 transition">
                                    <i class="fas fa-phone"></i>
                                </a>
                                <a href="mailto:info@endahtravel.com" class="w-12 h-12 bg-secondary-100 rounded-xl flex items-center justify-center text-secondary-600 hover:bg-secondary-200 transition">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="https://wa.me/6281234567890" class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 hover:bg-green-200 transition">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Packages -->
            @if($relatedPackages->count() > 0)
            <div class="mt-16" data-aos="fade-up">
                <div class="text-center mb-10">
                    <span class="inline-block bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-semibold mb-3">
                        <i class="fas fa-compass mr-1"></i> REKOMENDASI
                    </span>
                    <h2 class="text-3xl font-extrabold text-gray-900">Paket Wisata Serupa</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedPackages as $index => $related)
                    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative h-44 overflow-hidden">
                            <img src="{{ $related->image_url }}" alt="{{ $related->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur px-2 py-1 rounded-full text-xs font-medium text-gray-700">
                                <i class="fas fa-clock text-primary-500 mr-1"></i> {{ $related->duration_days }}D
                            </span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">{{ $related->name }}</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-extrabold text-primary-600">Rp {{ number_format($related->final_price, 0, ',', '.') }}</span>
                                <a href="{{ route('packages.show', $related->slug) }}" 
                                   class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 hover:bg-primary-600 hover:text-white transition-colors">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection

