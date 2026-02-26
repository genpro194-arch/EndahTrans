<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CharterBooking;
use Illuminate\Http\Request;

class CharterBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = CharterBooking::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', '%' . $search . '%')
                    ->orWhere('customer_name', 'like', '%' . $search . '%')
                    ->orWhere('customer_email', 'like', '%' . $search . '%')
                    ->orWhere('customer_phone', 'like', '%' . $search . '%')
                    ->orWhere('destination', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('fleet_type')) {
            $query->where('fleet_type', $request->fleet_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('departure_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('departure_date', '<=', $request->date_to);
        }

        $bookings = $query->latest()->paginate(20);

        $stats = [
            'total'    => CharterBooking::count(),
            'pending'  => CharterBooking::where('status', 'pending')->count(),
            'confirmed'=> CharterBooking::where('status', 'confirmed')->count(),
            'revenue'  => CharterBooking::where('payment_status', 'paid')->sum('total_price'),
        ];

        return view('admin.charter-bookings.index', compact('bookings', 'stats'));
    }

    public function show(CharterBooking $charterBooking)
    {
        return view('admin.charter-bookings.show', compact('charterBooking'));
    }

    public function updateStatus(Request $request, CharterBooking $charterBooking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $charterBooking->update($validated);

        return back()->with('success', 'Status charter berhasil diperbarui!');
    }

    public function updatePaymentStatus(Request $request, CharterBooking $charterBooking)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:unpaid,paid',
        ]);

        $charterBooking->update($validated);

        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }

    public function destroy(CharterBooking $charterBooking)
    {
        $charterBooking->delete();

        return redirect()->route('admin.charter-bookings.index')
            ->with('success', 'Data charter berhasil dihapus!');
    }
}
