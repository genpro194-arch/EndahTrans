@extends('layouts.admin')

@section('page-title', 'Pengaturan Website')
@section('page-subtitle', 'Kelola informasi kontak, sosial media, dan tampilan website')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- LEFT COLUMN --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- Informasi Umum --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center">
                        <i class="fas fa-globe text-brand-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Informasi Umum</h3>
                        <p class="text-xs text-gray-500">Nama, tagline, dan deskripsi website</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Website <span class="text-red-500">*</span></label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Endah Trans' }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tagline</label>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}"
                               placeholder="Perjalanan Nyaman, Kenangan Tak Terlupakan"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat (Tentang Kami)</label>
                        <textarea name="site_about_short" rows="3"
                                  placeholder="Deskripsi singkat perusahaan untuk halaman tentang kami..."
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50 resize-none">{{ $settings['site_about_short'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tahun Berdiri</label>
                        <input type="number" name="site_founded_year" value="{{ $settings['site_founded_year'] ?? '2014' }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center">
                        <i class="fas fa-phone-alt text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Kontak</h3>
                        <p class="text-xs text-gray-500">Nomor telepon, WhatsApp, dan email</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="fas fa-phone text-gray-400 mr-1"></i> Nomor Telepon
                        </label>
                        <input type="text" name="site_phone" value="{{ $settings['site_phone'] ?? '' }}"
                               placeholder="+62 812-3456-7890"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="fab fa-whatsapp text-green-500 mr-1"></i> Nomor WhatsApp
                        </label>
                        <input type="text" name="site_whatsapp" value="{{ $settings['site_whatsapp'] ?? '' }}"
                               placeholder="6281234567890 (tanpa + atau 0)"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-50">
                        <p class="text-xs text-gray-400 mt-1">Format: 628xxx... (digunakan untuk link wa.me)</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="fas fa-envelope text-gray-400 mr-1"></i> Email
                        </label>
                        <input type="email" name="site_email" value="{{ $settings['site_email'] ?? '' }}"
                               placeholder="info@endahtrans.com"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-50">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i> Alamat Lengkap
                        </label>
                        <textarea name="site_address" rows="3"
                                  placeholder="Jl. Raya Jepara - Kudus, Rw. 03, Pelang, Kec. Mayong, Kab. Jepara, Jawa Tengah"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-50 resize-none">{{ $settings['site_address'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Jam Operasional --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center">
                        <i class="fas fa-clock text-orange-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Jam Operasional</h3>
                        <p class="text-xs text-gray-500">Ditampilkan di footer dan halaman kontak</p>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Senin – Jumat</label>
                        <input type="text" name="jam_senin_jumat" value="{{ $settings['jam_senin_jumat'] ?? '08:00 – 17:00' }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Sabtu</label>
                        <input type="text" name="jam_sabtu" value="{{ $settings['jam_sabtu'] ?? '09:00 – 14:00' }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Minggu</label>
                        <input type="text" name="jam_minggu" value="{{ $settings['jam_minggu'] ?? 'Tutup' }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-50">
                    </div>
                </div>
            </div>

            {{-- Google Maps --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center">
                        <i class="fas fa-map-marked-alt text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Google Maps</h3>
                        <p class="text-xs text-gray-500">Embed URL dan link directions</p>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Google Maps Embed URL</label>
                        <input type="text" name="site_maps_embed" value="{{ $settings['site_maps_embed'] ?? '' }}"
                               placeholder="https://www.google.com/maps/embed?pb=..."
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-50">
                        <p class="text-xs text-gray-400 mt-1">Dapatkan dari Google Maps → Share → Embed a map → Copy iframe src</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Link Google Maps (Directions)</label>
                        <input type="url" name="site_maps_link" value="{{ $settings['site_maps_link'] ?? '' }}"
                               placeholder="https://maps.app.goo.gl/..."
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-50">
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="space-y-6">

            {{-- Sosial Media --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center">
                        <i class="fas fa-share-alt text-pink-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Sosial Media</h3>
                        <p class="text-xs text-gray-500">Link akun sosial media</p>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="fab fa-instagram text-pink-500 mr-1"></i> Instagram
                        </label>
                        <input type="url" name="site_instagram" value="{{ $settings['site_instagram'] ?? '' }}"
                               placeholder="https://instagram.com/endahtranss"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="fab fa-facebook text-brand-600 mr-1"></i> Facebook
                        </label>
                        <input type="url" name="site_facebook" value="{{ $settings['site_facebook'] ?? '' }}"
                               placeholder="https://facebook.com/endahtrans"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 focus:ring-2 focus:ring-brand-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="fab fa-youtube text-red-600 mr-1"></i> YouTube
                        </label>
                        <input type="url" name="site_youtube" value="{{ $settings['site_youtube'] ?? '' }}"
                               placeholder="https://youtube.com/@endahtrans"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="fab fa-twitter text-sky-500 mr-1"></i> Twitter / X
                        </label>
                        <input type="url" name="site_twitter" value="{{ $settings['site_twitter'] ?? '' }}"
                               placeholder="https://twitter.com/endahtrans"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-50">
                    </div>
                </div>
            </div>

            {{-- Save Button --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <button type="submit"
                        class="w-full bg-[#346fff] hover:bg-[#1e4fd8] text-white font-bold py-3.5 rounded-xl transition-all flex items-center justify-center gap-2 shadow-[0_6px_20px_-4px_rgba(52,111,255,0.4)] hover:shadow-none active:scale-[0.98]">
                    <i class="fas fa-save"></i> Simpan Pengaturan
                </button>
                <p class="text-center text-xs text-gray-400 mt-3">Perubahan langsung tersimpan ke database</p>
            </div>

            {{-- Current Values Preview --}}
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-5 text-white">
                <h4 class="font-bold text-sm mb-4 text-white/80 flex items-center gap-2">
                    <i class="fas fa-eye text-blue-400"></i> Pratinjau Info Kontak
                </h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-2 text-white/60">
                        <i class="fas fa-phone w-4 mt-0.5 text-green-400"></i>
                        <span>{{ $settings['site_phone'] ?? '-' }}</span>
                    </div>
                    <div class="flex items-start gap-2 text-white/60">
                        <i class="fab fa-whatsapp w-4 mt-0.5 text-green-400"></i>
                        <span>{{ isset($settings['site_whatsapp']) ? '+' . $settings['site_whatsapp'] : '-' }}</span>
                    </div>
                    <div class="flex items-start gap-2 text-white/60">
                        <i class="fas fa-envelope w-4 mt-0.5 text-blue-400"></i>
                        <span>{{ $settings['site_email'] ?? '-' }}</span>
                    </div>
                    <div class="flex items-start gap-2 text-white/60">
                        <i class="fas fa-map-marker-alt w-4 mt-0.5 text-red-400"></i>
                        <span class="leading-relaxed">{{ $settings['site_address'] ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
@endsection
