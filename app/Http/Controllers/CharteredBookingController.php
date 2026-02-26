<?php

namespace App\Http\Controllers;

use App\Models\CharterBooking;
use Illuminate\Http\Request;

class CharteredBookingController extends Controller
{
    /** Fallback rates per bus per day (IDR) — used if no DB price set for the destination */
    private const RATES = [
        'eksklusif' => 4_500_000,
        'reguler'   => 2_500_000,
        'bigtop'    => 3_500_000,
        'superexec' => 5_500_000,
    ];

    /**
     * Store a new charter booking from the armada page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fleet_type'      => 'required|in:eksklusif,reguler,bigtop,superexec',
            'customer_name'   => 'required|string|max:255',
            'customer_email'  => 'required|email|max:255',
            'customer_phone'  => 'required|string|max:20',
            'destination'     => 'required|string|max:255',
            'departure_date'  => 'required|date|after_or_equal:today',
            'departure_time'  => 'required|date_format:H:i',
            'duration_days'   => 'required|integer|min:1|max:30',
            'num_buses'       => 'required|integer|min:1|max:20',
            'payment_method'  => 'required|in:qris,transfer_bca,transfer_mandiri,transfer_bni,transfer_bri',
            'special_requests'=> 'nullable|string|max:1000',
        ]);

        $rate  = self::RATES[$validated['fleet_type']];

        // Override with DB-set destination price if available
        $destRecord = \App\Models\Destination::where('name', $validated['destination'])->first();
        if ($destRecord) {
            $dbPrice = \App\Models\DestinationPrice::where('destination_id', $destRecord->id)
                ->where('fleet_type', $validated['fleet_type'])->value('price_per_day');
            if ($dbPrice > 0) {
                $rate = $dbPrice;
            }
        }

        $total = $rate * $validated['num_buses'] * $validated['duration_days'];

        $booking = CharterBooking::create([
            'booking_code'        => CharterBooking::generateCode(),
            'fleet_type'          => $validated['fleet_type'],
            'customer_name'       => $validated['customer_name'],
            'customer_email'      => $validated['customer_email'],
            'customer_phone'      => $validated['customer_phone'],
            'destination'         => $validated['destination'],
            'departure_date'      => $validated['departure_date'],
            'departure_time'      => $validated['departure_time'],
            'duration_days'       => $validated['duration_days'],
            'num_buses'           => $validated['num_buses'],
            'price_per_bus_per_day' => $rate,
            'total_price'         => $total,
            'special_requests'    => $validated['special_requests'] ?? null,
            'payment_method'      => $validated['payment_method'],
            'status'              => 'pending',
            'payment_status'      => 'unpaid',
        ]);

        return redirect()->route('charter.receipt', $booking->booking_code)
            ->with('success', 'Pemesanan charter berhasil dibuat.');
    }

    /**
     * Show the professional nota / receipt page.
     */
    public function receipt(string $code)
    {
        $booking = CharterBooking::where('booking_code', $code)->firstOrFail();
        return view('charter.receipt', compact('booking'));
    }
}
