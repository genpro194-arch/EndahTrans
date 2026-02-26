<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('slug')->unique()->after('name');
            $table->enum('type', ['eksklusif', 'reguler', 'bigtop', 'superexec'])->default('reguler')->after('slug');
            $table->integer('capacity')->default(40)->after('type');
            $table->string('short_desc')->nullable()->after('capacity');
            $table->text('description')->nullable()->after('short_desc');
            $table->bigInteger('base_price')->default(0)->after('description')->comment('Harga dasar charter per hari');
            $table->string('image')->nullable()->after('base_price');
            $table->json('extra_images')->nullable()->after('image');
            $table->json('facilities')->nullable()->after('extra_images')->comment('[{"icon":"fas fa-wifi","label":"WiFi"}]');
            $table->boolean('is_active')->default(true)->after('facilities');
            $table->integer('sort_order')->default(0)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->dropColumn(['name','slug','type','capacity','short_desc','description','base_price','image','extra_images','facilities','is_active','sort_order']);
        });
    }
};
