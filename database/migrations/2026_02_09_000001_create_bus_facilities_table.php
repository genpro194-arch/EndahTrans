<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bus_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('bus_facilities')->insert([
            [
                'name' => 'Reguler',
                'slug' => 'reguler',
                'description' => 'Fasilitas standar dengan kenyamanan dasar',
                'features' => json_encode(['AC', 'Kursi Busa', 'Toilet']),
                'display_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ekslusif',
                'slug' => 'ekslusif',
                'description' => 'Fasilitas premium dengan kenyamanan maksimal',
                'features' => json_encode(['AC Premium', 'Kursi Reclining', 'WiFi', 'Monitor Individual', 'Toilet VIP', 'Makanan & Minuman']),
                'display_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bus_facilities');
    }
};
