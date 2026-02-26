<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CharterBooking;
use App\Models\Package;
use App\Models\PackageBusFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function create($packageSlug)
    {
        $package = Package::where('slug', $packageSlug)
            ->with('packageFacilities.busFacility')
            ->active()
            ->firstOrFail();

        return view('booking.create', compact('package'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'bus_facility_id' => 'nullable|exists:package_bus_facilities,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string|max:500',
            'number_of_buses' => 'required|integer|min:1|max:10',
            'booking_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        $package = Package::findOrFail($validated['package_id']);

        // Check buses count
        if ($validated['number_of_buses'] < 1) {
            return back()->withErrors(['number_of_buses' => 'Jumlah bus minimal 1.'])->withInput();
        }
        
        if ($validated['number_of_buses'] > 10) {
            return back()->withErrors(['number_of_buses' => 'Jumlah bus maksimal 10.'])->withInput();
        }

        // Calculate total price based on selected facility or package default
        $durationMultiplier = $package->duration_days ?? 1;
        
        if ($validated['bus_facility_id']) {
            // Get price from selected facility
            $facility = PackageBusFacility::findOrFail($validated['bus_facility_id']);
            $pricePerBus = $facility->final_price;
        } else {
            // Fallback to package default price if no facility selected
            $pricePerBus = $package->final_price;
        }
        
        $totalPrice = $pricePerBus * $validated['number_of_buses'] * $durationMultiplier;

        $booking = Booking::create([
            'booking_code' => Booking::generateBookingCode(),
            'package_id' => $validated['package_id'],
            'bus_facility_id' => $validated['bus_facility_id'] ?? null,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'number_of_buses' => $validated['number_of_buses'],
            'booking_date' => $validated['booking_date'],
            'departure_time' => $validated['departure_time'],
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

        $code = strtoupper(trim($request->booking_code));

        // Charter booking (code starts with CT)
        if (str_starts_with($code, 'CT')) {
            $charter = CharterBooking::where('booking_code', $code)->first();
            if (!$charter) {
                return back()->withErrors(['booking_code' => 'Kode booking charter tidak ditemukan.']);
            }
            return view('charter.status', ['booking' => $charter]);
        }

        // Package booking
        $booking = Booking::with('package.destination')
            ->where('booking_code', $code)
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
