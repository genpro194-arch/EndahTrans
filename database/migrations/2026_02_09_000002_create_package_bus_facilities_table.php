<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_bus_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->foreignId('bus_facility_id')->constrained('bus_facilities')->onDelete('cascade');
            $table->decimal('price', 12, 2);
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->timestamps();

            // Unique constraint: Satu package tidak boleh punya 2x fasilitas yang sama
            $table->unique(['package_id', 'bus_facility_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_bus_facilities');
    }
};
