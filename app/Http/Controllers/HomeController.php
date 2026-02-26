<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use App\Models\DestinationPrice;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\RouteVideo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPackages = Package::with('destination')
            ->active()
            ->featured()
            ->orderBy('name', 'asc')
            ->get();

        $destinations = Destination::where('is_active', true)
            ->whereNotIn('name', ['Yogyakarta', 'Labuan Bajo', 'Raja Ampat'])
            ->withCount(['packages' => function ($query) {
                $query->where('is_active', true);
            }])
            ->take(3)
            ->get();

        $testimonials = Testimonial::active()
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'destinations' => Destination::where('is_active', true)->count(),
            'packages' => Package::active()->count(),
            'customers' => \App\Models\Booking::where('status', 'completed')->count(),
        ];

        $routeVideos = RouteVideo::active()->get();

        return view('home', compact('featuredPackages', 'destinations', 'testimonials', 'stats', 'routeVideos'));
    }

    public function about()
    {
        $teams = Team::all()->toArray();
        
        $stats = [
            'destinations' => Destination::where('is_active', true)->count(),
            'packages' => Package::active()->count(),
            'customers' => \App\Models\Booking::where('status', 'completed')->count(),
        ];

        return view('about', compact('teams', 'stats'));
    }

    public function popularRoutes()
    {
        $popularPackages = Package::with('destination')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('name', 'asc')
            ->get();

        $stats = [
            'destinations' => Destination::where('is_active', true)->count(),
            'packages' => Package::active()->count(),
            'customers' => \App\Models\Booking::where('status', 'completed')->count(),
        ];

        return view('featured-packages', compact('popularPackages', 'stats'));
    }

    public function armada()
    {
        return view('armada');
    }

    public function armadaDetail(string $kelas)
    {
        $fleetDetails = [
            'eksklusif' => [
                'label'     => 'Sleeper Bus',
                'badge'     => 'SLEEPER BUS',
                'badgeColor'=> 'primary',
                'desc'      => 'Kursi bisa rebahan penuh. Ideal untuk perjalanan malam jarak jauh.',
                'imgs'      => [
                    'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1200&q=80',
                    'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=600&q=80',
                    'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=600&q=80',
                ],
                'stats'     => [['fa-users','Kapasitas','30 Kursi'],['fa-ruler-combined','Panjang','12 m'],['fa-road','Jarak','≤ 1.200 km']],
                'fasilitas' => [['fa-snowflake','AC Double Blower'],['fa-wifi','WiFi Unlimited'],['fa-tv','LCD TV 42"'],['fa-bolt','USB Charger/Kursi'],['fa-couch','Kursi Sleeper Full'],['fa-restroom','Toilet VIP'],['fa-music','Surround Audio'],['fa-video','CCTV'],['fa-suitcase','Bagasi XL'],['fa-utensils','Snack & Minuman'],['fa-bed','Bantal & Selimut'],['fa-user-tie','Guide Opsional']],
                'rate'      => 4500000,
                'btnClass'  => 'from-primary-600 to-secondary-600',
                'iconColor' => 'text-primary-400',
                'cardBg'    => 'bg-white/5',
                'cardBorder'=> 'border-white/10',
                'glowColor' => 'bg-primary-600',
                'glowColor2'=> 'bg-secondary-600',
                'vip'       => false,
            ],
            'reguler' => [
                'label'     => 'Executive',
                'badge'     => 'EXECUTIVE',
                'badgeColor'=> 'secondary',
                'desc'      => 'Kenyamanan bisnis dengan fasilitas premium untuk semua rute.',
                'imgs'      => [
                    'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=1200&q=80',
                    'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=600&q=80',
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
                ],
                'stats'     => [['fa-users','Kapasitas','40 Kursi'],['fa-ruler-combined','Panjang','11 m'],['fa-road','Jarak','≤ 900 km']],
                'fasilitas' => [['fa-snowflake','AC Full'],['fa-wifi','WiFi'],['fa-tv','LCD TV 32"'],['fa-bolt','USB Charger'],['fa-couch','Kursi Reclining'],['fa-restroom','Toilet'],['fa-music','Audio System'],['fa-video','CCTV'],['fa-suitcase','Bagasi Luas'],['fa-first-aid','P3K'],['fa-id-badge','Driver Bersertifikat'],['fa-clock','Tepat Waktu']],
                'rate'      => 2500000,
                'btnClass'  => 'from-secondary-600 to-secondary-700',
                'iconColor' => 'text-secondary-400',
                'cardBg'    => 'bg-white/5',
                'cardBorder'=> 'border-white/10',
                'glowColor' => 'bg-secondary-600',
                'glowColor2'=> 'bg-primary-600',
                'vip'       => false,
            ],
            'bigtop' => [
                'label'     => 'Executive Big Top',
                'badge'     => 'EXECUTIVE BIG TOP',
                'badgeColor'=> 'indigo',
                'desc'      => 'Ruang ekstra luas, jendela panorama, pemandangan terbaik.',
                'imgs'      => [
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&q=80',
                    'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&q=80',
                    'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=600&q=80',
                ],
                'stats'     => [['fa-users','Kapasitas','45 Kursi'],['fa-expand','Jendela','Panorama'],['fa-road','Jarak','Semua Rute']],
                'fasilitas' => [['fa-snowflake','AC Panorama'],['fa-wifi','WiFi Premium'],['fa-tv','TV Wide Screen'],['fa-bolt','USB Charger'],['fa-window-maximize','Jendela Panorama'],['fa-restroom','Toilet'],['fa-couch','Kursi Lega'],['fa-video','CCTV'],['fa-suitcase','Bagasi XL'],['fa-music','Surround Audio'],['fa-map-marked-alt','GPS Tracker'],['fa-shield-alt','Asuransi']],
                'rate'      => 3500000,
                'btnClass'  => 'from-indigo-600 to-indigo-700',
                'iconColor' => 'text-indigo-400',
                'cardBg'    => 'bg-white/5',
                'cardBorder'=> 'border-white/10',
                'glowColor' => 'bg-indigo-600',
                'glowColor2'=> 'bg-purple-600',
                'vip'       => false,
            ],
            'superexec' => [
                'label'     => 'Super Executive',
                'badge'     => 'SUPER EXECUTIVE',
                'badgeColor'=> 'amber',
                'desc'      => 'Fasilitas VIP paling lengkap untuk perjalanan tak terlupakan.',
                'imgs'      => [
                    'https://images.unsplash.com/photo-1530521954074-e64f6810b32d?w=1200&q=80',
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80',
                    'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&q=80',
                ],
                'stats'     => [['fa-users','Kapasitas','32 VIP'],['fa-star','Kelas','Premium'],['fa-road','Jarak','Bebas']],
                'fasilitas' => [['fa-snowflake','AC VIP Premium'],['fa-wifi','WiFi Super Cepat'],['fa-tv','LCD 42" 4K'],['fa-bolt','Wireless Charger'],['fa-couch','Kursi Sleeper VIP'],['fa-restroom','Toilet Executive'],['fa-utensils','Snack & Minuman'],['fa-bed','Bantal & Selimut'],['fa-music','Surround Premium'],['fa-video','CCTV 360°'],['fa-map-marked-alt','GPS Realtime'],['fa-user-tie','Guide Profesional']],
                'rate'      => 5500000,
                'btnClass'  => 'from-amber-500 to-orange-600',
                'iconColor' => 'text-amber-400',
                'cardBg'    => 'bg-amber-500/10',
                'cardBorder'=> 'border-amber-500/20',
                'glowColor' => 'bg-amber-600',
                'glowColor2'=> 'bg-orange-600',
                'vip'       => true,
            ],
        ];

        if (!array_key_exists($kelas, $fleetDetails)) {
            abort(404);
        }

        $detail = $fleetDetails[$kelas];
        $destinations = \App\Models\Destination::where('is_active', true)->orderBy('name')->pluck('name')->toArray();

        return view('armada-detail', compact('kelas', 'detail', 'destinations'));
    }

    public function galeri()
    {
        return view('galeri');
    }

    public function rute()
    {
        $routeVideos = RouteVideo::active()->get();
        return view('rute', compact('routeVideos'));
    }

    public function caraPesan()
    {
        return view('cara-pesan');
    }

    /**
     * API: return charter price for a destination + fleet combo.
     * GET /charter-price?destination=Bali&fleet=eksklusif
     */
    public function charterPrice(Request $request)
    {
        $destName  = $request->input('destination', '');
        $fleetType = $request->input('fleet', '');

        $validFleets = ['eksklusif', 'reguler', 'bigtop', 'superexec'];
        if (!in_array($fleetType, $validFleets) || empty($destName)) {
            return response()->json(['price' => 0, 'formatted' => null]);
        }

        $destination = Destination::where('name', $destName)
            ->where('is_active', true)
            ->first();

        if (!$destination) {
            return response()->json(['price' => 0, 'formatted' => null]);
        }

        $record = DestinationPrice::where('destination_id', $destination->id)
            ->where('fleet_type', $fleetType)
            ->first();

        if (!$record || $record->price_per_day <= 0) {
            return response()->json(['price' => 0, 'formatted' => null]);
        }

        $price = $record->price_per_day;
        $formatted = 'Rp\u00a0' . number_format($price, 0, ',', '.');

        return response()->json([
            'price'     => $price,
            'formatted' => 'Rp\u00a0' . number_format($price, 0, ',', '.'),
        ]);
    }
}
