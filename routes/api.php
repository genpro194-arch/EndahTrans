<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;

Route::middleware('api')->prefix('api')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Package Routes
    |--------------------------------------------------------------------------
    */

    // Get all packages with optional filters
    Route::get('/packages', [PackageController::class, 'apiIndex']);

    // Get packages by bus type (big or medium)
    Route::get('/packages/bus/{busType}', [PackageController::class, 'apiByBusType']);

    // Get pricing comparison for a destination
    Route::get('/packages/destination/{destinationSlug}/comparison', [PackageController::class, 'apiComparison']);

    // Get featured routes (rute populer)
    Route::get('/routes/featured', [PackageController::class, 'apiFeaturedRoutes']);

    // Get cheapest routes (harga terbaik)
    Route::get('/routes/cheapest', [PackageController::class, 'apiCheapestRoutes']);
});
