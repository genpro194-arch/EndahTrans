<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Rename column from number_of_persons to number_of_buses
            $table->renameColumn('number_of_persons', 'number_of_buses');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Rename back
            $table->renameColumn('number_of_buses', 'number_of_persons');
        });
    }
};
