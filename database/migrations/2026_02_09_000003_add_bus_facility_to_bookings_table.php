<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('bus_facility_id')
                ->nullable()
                ->after('package_id')
                ->constrained('bus_facilities')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['bus_facility_id']);
            $table->dropColumn('bus_facility_id');
        });
    }
};
