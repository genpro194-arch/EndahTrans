<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destination_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->enum('fleet_type', ['eksklusif', 'reguler', 'bigtop', 'superexec']);
            $table->unsignedBigInteger('price_per_day')->default(0);
            $table->timestamps();

            $table->unique(['destination_id', 'fleet_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destination_prices');
    }
};
