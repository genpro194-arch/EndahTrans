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
        $packages = [];

        foreach ($packages as $package) {
            Package::create($package);
        }

        // Run PackageSeeder for Bus packages
        $this->call(PackageSeeder::class);

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
