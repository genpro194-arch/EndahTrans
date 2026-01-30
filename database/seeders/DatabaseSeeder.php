<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Endah Travel',
            'email' => 'admin@endahtravel.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Settings
        $settings = [
            'site_name' => 'Endah Travel',
            'site_tagline' => 'Perjalanan Nyaman, Kenangan Tak Terlupakan',
            'site_email' => 'info@endahtravel.com',
            'site_phone' => '(021) 1234-5678',
            'site_whatsapp' => '6281234567890',
            'site_address' => 'Jl. Pariwisata No. 123, Jakarta Selatan, Indonesia 12345',
            'site_facebook' => 'https://facebook.com/endahtravel',
            'site_instagram' => 'https://instagram.com/endahtravel',
            'site_twitter' => 'https://twitter.com/endahtravel',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // Create Destinations
        $destinations = [
            [
                'name' => 'Bali',
                'slug' => 'bali',
                'description' => 'Pulau Dewata dengan keindahan alam, budaya, dan pantai yang menakjubkan. Destinasi wisata paling populer di Indonesia.',
                'is_active' => true,
            ],
            [
                'name' => 'Yogyakarta',
                'slug' => 'yogyakarta',
                'description' => 'Kota budaya dengan warisan sejarah yang kaya, mulai dari Candi Borobudur hingga Keraton Yogyakarta.',
                'is_active' => true,
            ],
            [
                'name' => 'Raja Ampat',
                'slug' => 'raja-ampat',
                'description' => 'Surga bawah laut dengan keindahan terumbu karang dan keanekaragaman hayati laut yang luar biasa.',
                'is_active' => true,
            ],
            [
                'name' => 'Lombok',
                'slug' => 'lombok',
                'description' => 'Pulau seribu masjid dengan pantai-pantai eksotis dan Gunung Rinjani yang megah.',
                'is_active' => true,
            ],
            [
                'name' => 'Labuan Bajo',
                'slug' => 'labuan-bajo',
                'description' => 'Gerbang menuju Taman Nasional Komodo dengan keindahan alam yang memukau.',
                'is_active' => true,
            ],
            [
                'name' => 'Bandung',
                'slug' => 'bandung',
                'description' => 'Kota kembang dengan udara sejuk, wisata alam pegunungan, dan kuliner yang lezat.',
                'is_active' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }

        // Create Packages
        $packages = [
            [
                'destination_id' => 1, // Bali
                'name' => 'Pesona Bali 4 Hari 3 Malam',
                'slug' => 'pesona-bali-4-hari-3-malam',
                'description' => 'Jelajahi keindahan Pulau Dewata dalam paket wisata lengkap yang mencakup tempat-tempat ikonik Bali.',
                'highlights' => json_encode([
                    'Kunjungan ke Tanah Lot saat sunset',
                    'Tour Ubud: Monkey Forest, Tegallalang Rice Terrace',
                    'Pantai Kuta dan Seminyak',
                    'Pura Uluwatu dengan Tari Kecak',
                    'Free time di Nusa Dua Beach',
                ]),
                'itinerary' => json_encode([
                    'Hari 1' => [
                        'Penjemputan di Bandara Ngurah Rai',
                        'Check-in hotel',
                        'Sore: Tour ke Tanah Lot',
                        'Dinner di tepi pantai',
                    ],
                    'Hari 2' => [
                        'Breakfast di hotel',
                        'Full day tour Ubud',
                        'Monkey Forest & Tegallalang',
                        'Makan siang di restoran lokal',
                        'Kembali ke hotel',
                    ],
                    'Hari 3' => [
                        'Breakfast di hotel',
                        'Free time di Kuta/Seminyak',
                        'Sore: Uluwatu Temple + Tari Kecak',
                        'Seafood dinner di Jimbaran',
                    ],
                    'Hari 4' => [
                        'Breakfast di hotel',
                        'Check-out',
                        'Belanja oleh-oleh',
                        'Transfer ke Bandara',
                    ],
                ]),
                'includes' => json_encode([
                    'Hotel bintang 4 (3 malam)',
                    'Breakfast daily',
                    'Transportasi AC selama tour',
                    'Guide berbahasa Indonesia',
                    'Tiket masuk wisata',
                    'Air mineral selama perjalanan',
                ]),
                'excludes' => json_encode([
                    'Tiket pesawat PP',
                    'Makan selain yang disebutkan',
                    'Pengeluaran pribadi',
                    'Tips guide dan driver',
                    'Travel insurance',
                ]),
                'price' => 3500000,
                'discount_price' => 2999000,
                'duration_days' => 4,
                'duration_nights' => 3,
                'min_person' => 2,
                'max_person' => 15,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'destination_id' => 1, // Bali
                'name' => 'Honeymoon Romantic Bali',
                'slug' => 'honeymoon-romantic-bali',
                'description' => 'Paket bulan madu romantis di Bali dengan akomodasi premium dan pengalaman tak terlupakan.',
                'highlights' => json_encode([
                    'Private villa dengan kolam renang',
                    'Romantic dinner di tepi pantai',
                    'Couples spa treatment',
                    'Sunrise trekking di Batur',
                    'Sunset sailing cruise',
                ]),
                'itinerary' => json_encode([
                    'Hari 1' => ['Arrival', 'Check-in private villa', 'Welcome dinner'],
                    'Hari 2' => ['Sunrise trekking Gunung Batur', 'Hot spring', 'Spa treatment'],
                    'Hari 3' => ['Free time', 'Romantic dinner di pantai'],
                    'Hari 4' => ['Sunset sailing cruise', 'Candlelight dinner'],
                    'Hari 5' => ['Check-out', 'Transfer ke bandara'],
                ]),
                'includes' => json_encode([
                    'Private villa 4 malam',
                    'Daily breakfast',
                    'Romantic dinner 2x',
                    'Couples spa',
                    'Private transport',
                    'Sunset cruise',
                ]),
                'excludes' => json_encode([
                    'Tiket pesawat',
                    'Pengeluaran pribadi',
                    'Aktivitas tidak disebutkan',
                ]),
                'price' => 12500000,
                'discount_price' => 10999000,
                'duration_days' => 5,
                'duration_nights' => 4,
                'min_person' => 2,
                'max_person' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'destination_id' => 2, // Yogyakarta
                'name' => 'Explore Jogja Heritage 3D2N',
                'slug' => 'explore-jogja-heritage-3d2n',
                'description' => 'Telusuri warisan budaya dan sejarah Yogyakarta, kota yang kaya akan tradisi dan keindahan.',
                'highlights' => json_encode([
                    'Candi Borobudur sunrise',
                    'Candi Prambanan',
                    'Keraton Yogyakarta',
                    'Malioboro street',
                    'Kuliner khas Jogja',
                ]),
                'itinerary' => json_encode([
                    'Hari 1' => ['Arrival', 'Check-in', 'Malioboro tour', 'Dinner gudeg'],
                    'Hari 2' => ['Sunrise Borobudur', 'Prambanan', 'Keraton', 'Taman Sari'],
                    'Hari 3' => ['Breakfast', 'Shopping oleh-oleh', 'Transfer out'],
                ]),
                'includes' => json_encode([
                    'Hotel 2 malam',
                    'Breakfast',
                    'Transport AC',
                    'Guide',
                    'Tiket wisata',
                ]),
                'excludes' => json_encode([
                    'Tiket pesawat/kereta',
                    'Makan tidak disebutkan',
                    'Personal expenses',
                ]),
                'price' => 1850000,
                'discount_price' => null,
                'duration_days' => 3,
                'duration_nights' => 2,
                'min_person' => 2,
                'max_person' => 20,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'destination_id' => 3, // Raja Ampat
                'name' => 'Raja Ampat Diving Paradise 5D4N',
                'slug' => 'raja-ampat-diving-paradise-5d4n',
                'description' => 'Eksplorasi surga bawah laut Raja Ampat dengan pemandangan terumbu karang yang menakjubkan.',
                'highlights' => json_encode([
                    'Diving/Snorkeling di spot terbaik',
                    'Pianemo viewpoint',
                    'Pulau Wayag',
                    'Manta Point',
                    'Sunset di Piaynemo',
                ]),
                'itinerary' => json_encode([
                    'Hari 1' => ['Arrival Sorong', 'Speedboat ke Raja Ampat', 'Check-in'],
                    'Hari 2' => ['Snorkeling trip 1', 'Island hopping'],
                    'Hari 3' => ['Diving/Snorkeling trip 2', 'Pianemo'],
                    'Hari 4' => ['Pulau Wayag', 'Free time'],
                    'Hari 5' => ['Check-out', 'Return to Sorong'],
                ]),
                'includes' => json_encode([
                    'Penginapan 4 malam',
                    '3x meals daily',
                    'Speedboat transfer',
                    'Snorkeling gear',
                    'Local guide',
                    'Entry permit',
                ]),
                'excludes' => json_encode([
                    'Tiket pesawat ke Sorong',
                    'Diving equipment',
                    'Personal expenses',
                    'Travel insurance',
                ]),
                'price' => 8500000,
                'discount_price' => 7999000,
                'duration_days' => 5,
                'duration_nights' => 4,
                'min_person' => 4,
                'max_person' => 10,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'destination_id' => 4, // Lombok
                'name' => 'Lombok Adventure 4D3N',
                'slug' => 'lombok-adventure-4d3n',
                'description' => 'Petualangan seru di Lombok dengan pantai eksotis dan wisata alam yang memukau.',
                'highlights' => json_encode([
                    'Gili Trawangan',
                    'Pantai Pink',
                    'Air Terjun Sendang Gile',
                    'Bukit Merese',
                    'Snorkeling 3 Gili',
                ]),
                'itinerary' => json_encode([
                    'Hari 1' => ['Arrival', 'Pantai Kuta Lombok', 'Bukit Merese sunset'],
                    'Hari 2' => ['Gili Trawangan', 'Snorkeling', 'Free time'],
                    'Hari 3' => ['Air Terjun Sendang Gile', 'Pantai Pink'],
                    'Hari 4' => ['Check-out', 'Transfer bandara'],
                ]),
                'includes' => json_encode([
                    'Hotel 3 malam',
                    'Breakfast',
                    'Transport',
                    'Boat ke Gili',
                    'Snorkeling gear',
                ]),
                'excludes' => json_encode([
                    'Tiket pesawat',
                    'Makan selain breakfast',
                    'Personal expenses',
                ]),
                'price' => 2750000,
                'discount_price' => 2499000,
                'duration_days' => 4,
                'duration_nights' => 3,
                'min_person' => 2,
                'max_person' => 15,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'destination_id' => 5, // Labuan Bajo
                'name' => 'Komodo Explorer 4D3N',
                'slug' => 'komodo-explorer-4d3n',
                'description' => 'Petualangan ke Taman Nasional Komodo, rumah bagi komodo dan keindahan alam yang spektakuler.',
                'highlights' => json_encode([
                    'Pulau Komodo',
                    'Pulau Padar',
                    'Pink Beach',
                    'Manta Point',
                    'Taka Makassar',
                ]),
                'itinerary' => json_encode([
                    'Hari 1' => ['Arrival Labuan Bajo', 'Check-in', 'Explore kota'],
                    'Hari 2' => ['Boat trip', 'Pulau Padar', 'Pink Beach', 'Manta Point'],
                    'Hari 3' => ['Pulau Komodo', 'Taka Makassar', 'Snorkeling'],
                    'Hari 4' => ['Check-out', 'Transfer bandara'],
                ]),
                'includes' => json_encode([
                    'Hotel 3 malam',
                    'Boat trip',
                    'Meals on boat',
                    'Snorkeling gear',
                    'Entrance fee',
                    'Ranger guide',
                ]),
                'excludes' => json_encode([
                    'Tiket pesawat',
                    'Travel insurance',
                    'Personal expenses',
                ]),
                'price' => 4500000,
                'discount_price' => null,
                'duration_days' => 4,
                'duration_nights' => 3,
                'min_person' => 4,
                'max_person' => 12,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'destination_id' => 6, // Bandung
                'name' => 'Bandung City & Nature 3D2N',
                'slug' => 'bandung-city-nature-3d2n',
                'description' => 'Nikmati kesejukan Bandung dengan wisata alam dan kuliner yang menggugah selera.',
                'highlights' => json_encode([
                    'Kawah Putih',
                    'Farm House Lembang',
                    'Floating Market',
                    'Factory Outlet',
                    'Kuliner Bandung',
                ]),
                'itinerary' => json_encode([
                    'Hari 1' => ['Arrival', 'Farm House', 'Floating Market', 'Check-in'],
                    'Hari 2' => ['Kawah Putih', 'Situ Patenggang', 'Kebun Teh'],
                    'Hari 3' => ['Factory Outlet', 'Oleh-oleh', 'Transfer out'],
                ]),
                'includes' => json_encode([
                    'Hotel 2 malam',
                    'Breakfast',
                    'Transport AC',
                    'Tiket wisata',
                ]),
                'excludes' => json_encode([
                    'Transport ke/dari Bandung',
                    'Makan selain breakfast',
                    'Belanja pribadi',
                ]),
                'price' => 1250000,
                'discount_price' => 1099000,
                'duration_days' => 3,
                'duration_nights' => 2,
                'min_person' => 2,
                'max_person' => 20,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }

        // Create Testimonials
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@email.com',
                'location' => 'Jakarta',
                'content' => 'Pengalaman liburan yang luar biasa! Tour guide sangat ramah dan profesional. Semua berjalan lancar sesuai jadwal. Pasti akan booking lagi di Endah Travel!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@email.com',
                'location' => 'Surabaya',
                'content' => 'Paket honeymoon kami di Bali sangat romantis. Private villa-nya cantik banget, pelayanan first class. Terima kasih Endah Travel sudah membuat bulan madu kami sempurna!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@email.com',
                'location' => 'Bandung',
                'content' => 'Raja Ampat trip-nya amazing! Pemandangan bawah lautnya surga dunia. Tim Endah Travel sangat helpful dari booking sampai perjalanan selesai.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Diana Putri',
                'email' => 'diana@email.com',
                'location' => 'Medan',
                'content' => 'Liburan keluarga ke Jogja sangat menyenangkan. Anak-anak senang, orang tua juga puas. Harga terjangkau dengan kualitas pelayanan premium.',
                'rating' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Reza Mahendra',
                'email' => 'reza@email.com',
                'location' => 'Semarang',
                'content' => 'Booking di Endah Travel sangat mudah, CS-nya responsive. Perjalanan ke Labuan Bajo berjalan lancar. Highly recommended!',
                'rating' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Login: admin@endahtravel.com / password');
    }
}
