<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\BusFacility;
use App\Models\PackageBusFacility;
use Illuminate\Database\Seeder;

class PackageBusFacilitiesSeeder extends Seeder
{
    public function run(): void
    {
        // Get all facilities
        $reguler = BusFacility::where('slug', 'reguler')->first();
        $ekslusif = BusFacility::where('slug', 'ekslusif')->first();

        if (!$reguler || !$ekslusif) {
            $this->command->warn('Bus facilities not found! Please run bus facilities migration first.');
            return;
        }

        // Get all packages
        $packages = Package::active()->get();

        $createdCount = 0;

        foreach ($packages as $package) {
            // Skip if facilities already exist for this package
            if ($package->packageFacilities()->count() > 0) {
                continue;
            }

            $basePrice = $package->price;

            // Create Reguler facility for this package
            PackageBusFacility::create([
                'package_id' => $package->id,
                'bus_facility_id' => $reguler->id,
                'price' => $basePrice, // Same as package base price
                'discount_price' => $package->discount_price,
            ]);

            // Create Ekslusif facility for this package
            // Ekslusif price = +30% dari base price
            $ekslusifPrice = round($basePrice * 1.3);
            
            // Ekslusif discount = +25% dari harga normal (lebih murah dari base +30%)
            $ekslusifDiscount = round($ekslusifPrice * 0.85);

            PackageBusFacility::create([
                'package_id' => $package->id,
                'bus_facility_id' => $ekslusif->id,
                'price' => $ekslusifPrice,
                'discount_price' => $ekslusifDiscount,
            ]);

            $createdCount += 2;
        }

        $this->command->info("✅ Created $createdCount package-facility relationships for " . ($createdCount / 2) . " packages!");
    }
}
