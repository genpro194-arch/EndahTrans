<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('doku_order_id')->nullable()->after('payment_proof');
            $table->string('doku_payment_url', 1000)->nullable()->after('doku_order_id');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['doku_order_id', 'doku_payment_url']);
        });
    }
};
