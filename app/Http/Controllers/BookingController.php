<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function create($packageSlug)
    {
        $package = Package::where('slug', $packageSlug)
            ->active()
            ->firstOrFail();

        return view('booking.create', compact('package'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string|max:500',
            'number_of_persons' => 'required|integer|min:1',
            'booking_date' => 'required|date|after_or_equal:today',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        $package = Package::findOrFail($validated['package_id']);

        // Check min/max persons
        if ($validated['number_of_persons'] < $package->min_person) {
            return back()->withErrors(['number_of_persons' => 'Jumlah penumpang minimal ' . $package->min_person . ' orang.'])->withInput();
        }
        
        if ($validated['number_of_persons'] > $package->max_person) {
            return back()->withErrors(['number_of_persons' => 'Jumlah penumpang maksimal ' . $package->max_person . ' orang.'])->withInput();
        }

        // Calculate total price
        $pricePerPerson = $package->final_price;
        $totalPrice = $pricePerPerson * $validated['number_of_persons'];

        $booking = Booking::create([
            'booking_code' => Booking::generateBookingCode(),
            'package_id' => $validated['package_id'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'number_of_persons' => $validated['number_of_persons'],
            'booking_date' => $validated['booking_date'],
            'total_price' => $totalPrice,
            'special_requests' => $validated['special_requests'],
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('booking.confirmation', $booking->booking_code)
            ->with('success', 'Pemesanan berhasil dibuat!');
    }

    public function confirmation($bookingCode)
    {
        $booking = Booking::with('package.destination')
            ->where('booking_code', $bookingCode)
            ->firstOrFail();

        return view('booking.confirmation', compact('booking'));
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|string',
        ]);

        $booking = Booking::with('package.destination')
            ->where('booking_code', $request->booking_code)
            ->first();

        if (!$booking) {
            return back()->withErrors(['booking_code' => 'Kode booking tidak ditemukan.']);
        }

        return view('booking.status', compact('booking'));
    }

    public function showCheckStatus()
    {
        return view('booking.check-status');
    }
}
