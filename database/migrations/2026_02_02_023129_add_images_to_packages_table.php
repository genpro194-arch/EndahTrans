<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Package;
use App\Models\Destination;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mapping gambar untuk setiap destinasi
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

        // Update semua paket dengan gambar berdasarkan destinasinya
        foreach ($destinationImages as $destinationName => $imageUrl) {
            $destination = Destination::where('name', $destinationName)->first();
            if ($destination) {
                Package::where('destination_id', $destination->id)->update(['image' => $imageUrl]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('packages')->update(['image' => null]);
    }
};
