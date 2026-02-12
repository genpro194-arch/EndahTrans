<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitializeFeaturesSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('
            UPDATE package_bus_facilities pbf 
            SET pbf.features = (
                SELECT bf.features 
                FROM bus_facilities bf 
                WHERE bf.id = pbf.bus_facility_id
            )
            WHERE pbf.features IS NULL
        ');

        $this->command->info('Features initialized successfully!');
    }
}
