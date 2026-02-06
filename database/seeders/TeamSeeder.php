<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'name' => 'Endah Pratiwi',
            'role' => 'Founder & CEO',
            'image' => null,
            'linkedin_url' => 'https://linkedin.com/in/endah-pratiwi',
            'instagram_url' => 'https://instagram.com/endahpratiwi',
        ]);

        Team::create([
            'name' => 'Ahmad Rizky',
            'role' => 'Operations Manager',
            'image' => null,
            'linkedin_url' => 'https://linkedin.com/in/ahmad-rizky',
            'instagram_url' => 'https://instagram.com/ahmadrizky',
        ]);

        Team::create([
            'name' => 'Siti Nurhaliza',
            'role' => 'Customer Relations',
            'image' => null,
            'linkedin_url' => 'https://linkedin.com/in/siti-nurhaliza',
            'instagram_url' => 'https://instagram.com/sitinurhaliza',
        ]);
    }
}
