<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            'Tour dalam kota' => 'tour-dalam-kota',
            'Jogja' => 'jogja',
            'Semarang' => 'semarang',
            'Jepara' => 'jepara',
            'Pati' => 'pati',
            'Purwokerto' => 'purwokerto',
            'Tegal' => 'tegal',
            'Surabaya' => 'surabaya',
            'Malang' => 'malang',
            'Bandung' => 'bandung',
            'Cirebon' => 'cirebon',
            'Jakarta' => 'jakarta',
            'Bogor' => 'bogor',
            'Tangerang' => 'tangerang',
            'Bekasi' => 'bekasi',
            'Lampung' => 'lampung',
            'Bali' => 'bali',
            'Lombok' => 'lombok',
            'Yogyakarta' => 'yogyakarta',
            'Labuan Bajo' => 'labuan-bajo',
            'Raja Ampat' => 'raja-ampat',
        ];

        // Gambar untuk setiap destinasi
        $destinationImages = [
            'Tour dalam kota' => 'https://images.unsplash.com/photo-1486299230070-85a89cecf806?w=500&h=300&fit=crop',
            'Jogja' => 'https://images.unsplash.com/photo-1537225228614-b4b27e15b489?w=500&h=300&fit=crop',
            'Semarang' => 'https://images.unsplash.com/photo-1488228695242-c3ee2992b146?w=500&h=300&fit=crop',
            'Jepara' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=500&h=300&fit=crop',
            'Pati' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=500&h=300&fit=crop',
            'Purwokerto' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=500&h=300&fit=crop',
            'Tegal' => 'https://images.unsplash.com/photo-1488292539222-f8b2b60faeb1?w=500&h=300&fit=crop',
            'Surabaya' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&h=300&fit=crop',
            'Malang' => 'https://images.unsplash.com/photo-1465056836offering-a55f1f7a4e9f?w=500&h=300&fit=crop',
            'Bandung' => 'https://images.unsplash.com/photo-1506929925346-21bda4d32df4?w=500&h=300&fit=crop',
            'Cirebon' => 'https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=500&h=300&fit=crop',
            'Jakarta' => 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=500&h=300&fit=crop',
            'Bogor' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=500&h=300&fit=crop',
            'Tangerang' => 'https://images.unsplash.com/photo-1513161455079-7ef1a827f7f5?w=500&h=300&fit=crop',
            'Bekasi' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=500&h=300&fit=crop',
            'Lampung' => 'https://images.unsplash.com/photo-1488292539222-f8b2b60faeb1?w=500&h=300&fit=crop',
            'Bali' => 'https://images.unsplash.com/photo-1513161455079-7ef1a827f7f5?w=500&h=300&fit=crop',
            'Lombok' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=500&h=300&fit=crop',
            'Yogyakarta' => 'https://images.unsplash.com/photo-1549465220-acada08988b7?w=500&h=300&fit=crop',
            'Labuan Bajo' => 'https://images.unsplash.com/photo-1509140846257-f9e1e0bd4dc3?w=500&h=300&fit=crop',
            'Raja Ampat' => 'https://images.unsplash.com/photo-1504681869696-d977e3f91d65?w=500&h=300&fit=crop',
        ];

        // Featured routes (rute populer)
        $featuredRoutes = ['jogja', 'jakarta', 'surabaya', 'bandung', 'lombok', 'bali'];

        // Harga untuk Big Bus
        $bigBusPrices = [
            'Tour dalam kota' => 2800000,
            'Jogja' => 5000000,
            'Semarang' => 5000000,
            'Jepara' => 6500000,
            'Pati' => 6500000,
            'Purwokerto' => 7500000,
            'Tegal' => 7500000,
            'Surabaya' => 9000000,
            'Malang' => 9500000,
            'Bandung' => 11000000,
            'Cirebon' => 11000000,
            'Jakarta' => 12000000,
            'Bogor' => 12000000,
            'Tangerang' => 12000000,
            'Bekasi' => 12000000,
            'Lampung' => 15000000,
            'Bali' => 17000000,
            'Lombok' => 24000000,
            'Yogyakarta' => 5000000,
            'Labuan Bajo' => 25000000,
            'Raja Ampat' => 30000000,
        ];

        // Harga untuk Medium Bus
        $mediumBusPrices = [
            'Tour dalam kota' => 2500000,
            'Jogja' => 4500000,
            'Semarang' => 4500000,
            'Jepara' => 6000000,
            'Pati' => 6000000,
            'Purwokerto' => 6500000,
            'Tegal' => 6500000,
            'Surabaya' => 7500000,
            'Malang' => 8000000,
            'Bandung' => 9000000,
            'Cirebon' => 9000000,
            'Jakarta' => 10000000,
            'Bogor' => 10000000,
            'Tangerang' => 10000000,
            'Bekasi' => 10000000,
            'Lampung' => 12000000,
            'Bali' => 13500000,
            'Lombok' => 18000000,
            'Yogyakarta' => 4500000,
            'Labuan Bajo' => 20000000,
            'Raja Ampat' => 22000000,
        ];

        // Create or get destinations first
        foreach ($destinations as $name => $slug) {
            Destination::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => 'Destinasi ' . $name,
                    'is_featured' => in_array($slug, $featuredRoutes),
                    'is_active' => true,
                ]
            );
        }

        // Create Big Bus packages
        foreach ($destinations as $destName => $destSlug) {
            $destination = Destination::where('slug', $destSlug)->first();
            
            Package::create([
                'destination_id' => $destination->id,
                'name' => 'Big Bus - ' . $destName,
                'bus_type' => 'big',
                'capacity' => 40,
                'slug' => 'big-bus-' . $destSlug,
                'description' => 'Paket tour Big Bus ke ' . $destName,
                'price' => $bigBusPrices[$destName],
                'duration_days' => 1,
                'max_person' => 40,
                'min_person' => 1,
                'image' => $destinationImages[$destName],
                'is_featured' => in_array($destSlug, $featuredRoutes),
                'is_active' => true,
            ]);
        }

        // Create Medium Bus packages
        foreach ($destinations as $destName => $destSlug) {
            $destination = Destination::where('slug', $destSlug)->first();
            
            Package::create([
                'destination_id' => $destination->id,
                'name' => 'Medium Bus - ' . $destName,
                'bus_type' => 'medium',
                'capacity' => 35,
                'slug' => 'medium-bus-' . $destSlug,
                'description' => 'Paket tour Medium Bus ke ' . $destName,
                'price' => $mediumBusPrices[$destName],
                'duration_days' => 1,
                'max_person' => 35,
                'min_person' => 1,
                'image' => $destinationImages[$destName],
                'is_featured' => in_array($destSlug, $featuredRoutes),
                'is_active' => true,
            ]);
        }
    }
}
