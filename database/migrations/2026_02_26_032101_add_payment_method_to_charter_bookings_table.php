<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('charter_bookings', function (Blueprint $table) {
            $table->string('payment_method', 30)->default('transfer_bca')->after('special_requests');
        });
    }

    public function down(): void
    {
        Schema::table('charter_bookings', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });
    }
};
