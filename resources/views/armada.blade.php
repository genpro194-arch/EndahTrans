@extends('layouts.app')

@section('title', 'Armada Bus - EndahTrans Bus')

@section('content')
@php
    $kelasInfo = [
        'sleeper'           => ['nama' => 'Sleeper Bus',        'icon' => 'fa-bed',    'deskripsi' => 'Kursi dapat dilayangkan untuk rebahan. Ideal untuk perjalanan jauh yang membutuhkan istirahat.'],
        'executive'         => ['nama' => 'Executive',           'icon' => 'fa-crown',  'deskripsi' => 'Kenyamanan tingkat bisnis dengan fasilitas premium. Cocok untuk perjalanan bisnis dan liburan.'],
        'executive_big_top' => ['nama' => 'Executive Big Top',   'icon' => 'fa-bus',    'deskripsi' => 'Ruang lebih luas dengan jendela besar dan pemandangan maksimal untuk pengalaman istimewa.'],
        'super_executive'   => ['nama' => 'Super Executive ⭐',  'icon' => 'fa-star',   'deskripsi' => 'Premium terbaik dengan fasilitas lengkap. Untuk pengalaman perjalanan yang tak terlupakan.'],
    ];
@endphp
<!-- Header Section -->
<div style="padding: 3rem 0; background: linear-gradient(135deg, #d32f2f, #c62828); color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50%; right: -10%; width: 400px; height: 400px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        @if($kelasFilter && isset($kelasInfo[$kelasFilter]))
            <p style="font-size: 13px; opacity: 0.8; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">
                <a href="{{ route('armada') }}" style="color: white; text-decoration: none; opacity: 0.8;">Armada Bus</a>
                &rsaquo; {{ $kelasInfo[$kelasFilter]['nama'] }}
            </p>
            <h1 style="font-size: 2.8rem; margin-bottom: 1rem; font-weight: 700;">
                <i class="fas {{ $kelasInfo[$kelasFilter]['icon'] }}" style="margin-right: 12px;"></i>{{ $kelasInfo[$kelasFilter]['nama'] }}
            </h1>
            <p style="font-size: 16px; opacity: 0.95;">{{ $kelasInfo[$kelasFilter]['deskripsi'] }}</p>
        @else
            <h1 style="font-size: 2.8rem; margin-bottom: 1rem; font-weight: 700;">Armada Bus Kami</h1>
            <p style="font-size: 16px; opacity: 0.95;">Pilih kelas bus yang sesuai dengan gaya dan kebutuhan perjalanan Anda</p>
        @endif
    </div>
</div>

<section style="padding: 4rem 0; background: white;">
    <div class="container">
        @if($buses->count() > 0)

        <!-- Filter Tombol Kelas (hanya tampil jika belum memilih kelas) -->
        @if(!$kelasFilter)
        <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 3rem; justify-content: center;">
            @foreach($kelasInfo as $key => $info)
                @if($allClasses->contains($key))
                <a href="{{ route('armada', ['kelas' => $key]) }}"
                    style="padding: 10px 24px; border-radius: 50px; border: 2px solid #d32f2f; background: white; color: #d32f2f; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s;">
                    <i class="fas {{ $info['icon'] }}" style="margin-right: 6px;"></i> {{ $info['nama'] }}
                </a>
                @endif
            @endforeach
        </div>
        @else
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('armada') }}"
                style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 50px; border: 2px solid #d32f2f; background: white; color: #d32f2f; text-decoration: none; font-weight: 600; font-size: 14px;">
                <i class="fas fa-arrow-left"></i> Lihat Semua Kelas
            </a>
        </div>
        @endif

        <!-- Sleeper Bus -->
        @if(isset($busesByClass['sleeper']))
        <div data-kelas="sleeper" style="margin-bottom: 4rem;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 2.5rem; padding-bottom: 1.5rem; border-bottom: 3px solid #d32f2f;">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #d32f2f, #f44336); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                    <i class="fas fa-bed"></i>
                </div>
                <div>
                    <h2 style="font-size: 1.8rem; margin: 0; font-weight: 700; color: #222;">Sleeper Bus</h2>
                    <p style="color: #666; font-size: 13px; margin: 0; margin-top: 0.3rem;">Kursi dapat dilayangkan untuk rebahan. Ideal untuk perjalanan jauh yang membutuhkan istirahat.</p>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                @foreach($busesByClass['sleeper'] as $bus)
                <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: all 0.3s; hover: box-shadow 0 8px 16px rgba(0,0,0,0.1);">
                    <div style="background: linear-gradient(135deg, #d32f2f, #f44336); color: white; padding: 2rem; text-align: center;">
                        <i class="fas fa-bed" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                    </div>
                    <div style="padding: 1.8rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1rem; color: #222; font-size: 16px;">{{ $bus->name }}</h3>
                        <div style="background: #f5f5f5; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                            <p style="color: #666; margin-bottom: 0.5rem; font-size: 13px;"><span style="font-weight: 600; color: #d32f2f;">Kapasitas:</span> {{ $bus->capacity }} penumpang</p>
                            <p style="color: #666; font-size: 13px;"><span style="font-weight: 600; color: #d32f2f;">Plat Nomor:</span> {{ $bus->plate_number }}</p>
                        </div>
                        <div>
                            <p style="font-weight: 700; margin-bottom: 0.8rem; color: #222; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Fasilitas:</p>
                            <ul style="color: #666; font-size: 12px; list-style: none;">
                                @foreach($bus->facilities as $facility)
                                <li style="margin-bottom: 0.6rem; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check-circle" style="color: #d32f2f; flex-shrink: 0;"></i>
                                    <span>{{ $facility }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Executive -->
        @if(isset($busesByClass['executive']))
        <div data-kelas="executive" style="margin-bottom: 4rem;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 2.5rem; padding-bottom: 1.5rem; border-bottom: 3px solid #d32f2f;">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #d32f2f, #f44336); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                    <i class="fas fa-crown"></i>
                </div>
                <div>
                    <h2 style="font-size: 1.8rem; margin: 0; font-weight: 700; color: #222;">Executive</h2>
                    <p style="color: #666; font-size: 13px; margin: 0; margin-top: 0.3rem;">Kenyamanan tingkat bisnis dengan fasilitas premium. Cocok untuk perjalanan bisnis dan liburan.</p>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                @foreach($busesByClass['executive'] as $bus)
                <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: all 0.3s;">
                    <div style="background: linear-gradient(135deg, #d32f2f, #f44336); color: white; padding: 2rem; text-align: center;">
                        <i class="fas fa-crown" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                    </div>
                    <div style="padding: 1.8rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1rem; color: #222; font-size: 16px;">{{ $bus->name }}</h3>
                        <div style="background: #f5f5f5; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                            <p style="color: #666; margin-bottom: 0.5rem; font-size: 13px;"><span style="font-weight: 600; color: #d32f2f;">Kapasitas:</span> {{ $bus->capacity }} penumpang</p>
                            <p style="color: #666; font-size: 13px;"><span style="font-weight: 600; color: #d32f2f;">Plat Nomor:</span> {{ $bus->plate_number }}</p>
                        </div>
                        <div>
                            <p style="font-weight: 700; margin-bottom: 0.8rem; color: #222; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Fasilitas:</p>
                            <ul style="color: #666; font-size: 12px; list-style: none;">
                                @foreach($bus->facilities as $facility)
                                <li style="margin-bottom: 0.6rem; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check-circle" style="color: #d32f2f; flex-shrink: 0;"></i>
                                    <span>{{ $facility }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Executive Big Top -->
        @if(isset($busesByClass['executive_big_top']))
        <div data-kelas="executive_big_top" style="margin-bottom: 4rem;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 2.5rem; padding-bottom: 1.5rem; border-bottom: 3px solid #d32f2f;">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #d32f2f, #f44336); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                    <i class="fas fa-bus"></i>
                </div>
                <div>
                    <h2 style="font-size: 1.8rem; margin: 0; font-weight: 700; color: #222;">Executive Big Top</h2>
                    <p style="color: #666; font-size: 13px; margin: 0; margin-top: 0.3rem;">Ruang lebih luas dengan jendela besar dan pemandangan maksimal untuk pengalaman istimewa.</p>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                @foreach($busesByClass['executive_big_top'] as $bus)
                <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: all 0.3s;">
                    <div style="background: linear-gradient(135deg, #d32f2f, #f44336); color: white; padding: 2rem; text-align: center;">
                        <i class="fas fa-window-maximize" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                    </div>
                    <div style="padding: 1.8rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1rem; color: #222; font-size: 16px;">{{ $bus->name }}</h3>
                        <div style="background: #f5f5f5; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                            <p style="color: #666; margin-bottom: 0.5rem; font-size: 13px;"><span style="font-weight: 600; color: #d32f2f;">Kapasitas:</span> {{ $bus->capacity }} penumpang</p>
                            <p style="color: #666; font-size: 13px;"><span style="font-weight: 600; color: #d32f2f;">Plat Nomor:</span> {{ $bus->plate_number }}</p>
                        </div>
                        <div>
                            <p style="font-weight: 700; margin-bottom: 0.8rem; color: #222; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Fasilitas:</p>
                            <ul style="color: #666; font-size: 12px; list-style: none;">
                                @foreach($bus->facilities as $facility)
                                <li style="margin-bottom: 0.6rem; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check-circle" style="color: #d32f2f; flex-shrink: 0;"></i>
                                    <span>{{ $facility }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Super Executive -->
        @if(isset($busesByClass['super_executive']))
        <div data-kelas="super_executive" style="margin-bottom: 0;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 2.5rem; padding-bottom: 1.5rem; border-bottom: 3px solid #d32f2f;">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #d32f2f, #f44336); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h2 style="font-size: 1.8rem; margin: 0; font-weight: 700; color: #222;">Super Executive ⭐</h2>
                    <p style="color: #666; font-size: 13px; margin: 0; margin-top: 0.3rem;">Premium terbaik dengan fasilitas lengkap. Untuk pengalaman perjalanan yang tak terlupakan.</p>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                @foreach($busesByClass['super_executive'] as $bus)
                <div style="background: white; border: 2px solid #d32f2f; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(211, 47, 47, 0.15); transition: all 0.3s;">
                    <div style="background: linear-gradient(135deg, #d32f2f, #f44336); color: white; padding: 2rem; text-align: center;">
                        <i class="fas fa-star" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                    </div>
                    <div style="padding: 1.8rem;">
                        <h3 style="font-weight: 700; margin-bottom: 1rem; color: #222; font-size: 16px;">{{ $bus->name }}</h3>
                        <div style="background: #f5f5f5; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                            <p style="color: #666; margin-bottom: 0.5rem; font-size: 13px;"><span style="font-weight: 600; color: #d32f2f;">Kapasitas:</span> {{ $bus->capacity }} penumpang</p>
                            <p style="color: #666; font-size: 13px;"><span style="font-weight: 600; color: #d32f2f;">Plat Nomor:</span> {{ $bus->plate_number }}</p>
                        </div>
                        <div>
                            <p style="font-weight: 700; margin-bottom: 0.8rem; color: #222; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Fasilitas:</p>
                            <ul style="color: #666; font-size: 12px; list-style: none;">
                                @foreach($bus->facilities as $facility)
                                <li style="margin-bottom: 0.6rem; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check-circle" style="color: #d32f2f; flex-shrink: 0;"></i>
                                    <span>{{ $facility }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @else
        <div style="text-align: center; padding: 3rem 0;">
            <i class="fas fa-bus" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
            <p style="color: #666; font-size: 16px;">Belum ada armada bus yang tersedia.</p>
        </div>
        @endif
    </div>
</section>
@endsection

