<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('charter_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 20)->unique();
            $table->enum('fleet_type', ['eksklusif', 'reguler']);
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 20);
            $table->string('destination');
            $table->date('departure_date');
            $table->string('departure_time', 10);
            $table->unsignedTinyInteger('duration_days')->default(1);
            $table->unsignedTinyInteger('num_buses')->default(1);
            $table->unsignedBigInteger('price_per_bus_per_day');
            $table->unsignedBigInteger('total_price');
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('charter_bookings');
    }
};
