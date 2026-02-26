<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\RouteVideoController;
use App\Http\Controllers\Admin\CharterBookingController as AdminCharterController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\CharteredBookingController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Temporary auto-login for preview (remove after done)
Route::get('/dev-autologin', function () {
    $user = \App\Models\User::where('email', 'admin@endahtravel.com')->first();
    if ($user) { auth()->login($user); return redirect()->route('admin.dashboard'); }
    return 'User not found';
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/paket-unggulan', [HomeController::class, 'popularRoutes'])->name('popular-routes');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/armada', [HomeController::class, 'armada'])->name('armada');
Route::get('/armada/{kelas}', [HomeController::class, 'armadaDetail'])->name('armada.detail')
    ->whereIn('kelas', ['eksklusif', 'reguler', 'bigtop', 'superexec']);
Route::get('/destinasi', [HomeController::class, 'destinations'])->name('destinasi');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/rute', [HomeController::class, 'rute'])->name('rute');
Route::get('/cara-pesan', [HomeController::class, 'caraPesan'])->name('cara-pesan');

// Charter (Armada) Booking
Route::post('/charter-armada', [CharteredBookingController::class, 'store'])->name('charter.store');
Route::get('/charter-armada/{code}/nota', [CharteredBookingController::class, 'receipt'])->name('charter.receipt');
Route::get('/charter-price', [HomeController::class, 'charterPrice'])->name('charter.price');

// Packages
Route::get('/paket', [PackageController::class, 'index'])->name('packages.index');
Route::get('/paket/{slug}', [PackageController::class, 'show'])->name('packages.show');

// Booking
Route::get('/booking/{packageSlug}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/konfirmasi/{bookingCode}', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/cek-booking', [BookingController::class, 'showCheckStatus'])->name('booking.check-status');
Route::post('/cek-booking', [BookingController::class, 'checkStatus'])->name('booking.check-status.post');
Route::get('/booking/status/{bookingCode}', function ($bookingCode) {
    $booking = \App\Models\Booking::with('package.destination')
        ->where('booking_code', $bookingCode)
        ->firstOrFail();
    return view('booking.status', compact('booking'));
})->name('booking.status');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Auth
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/revenue-update', [DashboardController::class, 'getRevenueUpdate'])->name('revenue-update');
    
    // Packages
    Route::resource('packages', AdminPackageController::class);
    Route::post('packages/{package}/toggle-featured', [AdminPackageController::class, 'toggleFeatured'])->name('packages.toggle-featured');
    Route::get('packages/{package}/facilities', [AdminPackageController::class, 'editFacilities'])->name('packages.edit-facilities');
    Route::post('packages/{package}/facilities', [AdminPackageController::class, 'updateFacilities'])->name('packages.update-facilities');
    
    // Destinations
    Route::resource('destinations', DestinationController::class);
    
    // Teams
    Route::resource('teams', TeamController::class);

    // Route Videos
    Route::resource('route-videos', RouteVideoController::class)->except(['show']);
    
    // Bookings
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::post('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::post('bookings/{booking}/payment', [AdminBookingController::class, 'updatePaymentStatus'])->name('bookings.update-payment');
    Route::post('bookings/{booking}/note', [AdminBookingController::class, 'addNote'])->name('bookings.add-note');
    Route::delete('bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
    
    // Contacts
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{contact}/reply', [AdminContactController::class, 'reply'])->name('contacts.reply');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Charter Bookings
    Route::get('charter-bookings', [AdminCharterController::class, 'index'])->name('charter-bookings.index');
    Route::get('charter-bookings/{charterBooking}', [AdminCharterController::class, 'show'])->name('charter-bookings.show');
    Route::post('charter-bookings/{charterBooking}/status', [AdminCharterController::class, 'updateStatus'])->name('charter-bookings.update-status');
    Route::post('charter-bookings/{charterBooking}/payment', [AdminCharterController::class, 'updatePaymentStatus'])->name('charter-bookings.update-payment');
    Route::delete('charter-bookings/{charterBooking}', [AdminCharterController::class, 'destroy'])->name('charter-bookings.destroy');

    // Testimonials
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::post('testimonials/{testimonial}/toggle-active', [TestimonialController::class, 'toggleActive'])->name('testimonials.toggle-active');

    // Buses (Armada)
    Route::resource('buses', BusController::class);
    Route::post('buses/{bus}/toggle-active', [BusController::class, 'toggleActive'])->name('buses.toggle-active');

    // Gallery
    Route::resource('gallery', GalleryController::class)->except(['show']);
    Route::post('gallery/{gallery}/toggle-active', [GalleryController::class, 'toggleActive'])->name('gallery.toggle-active');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
});
