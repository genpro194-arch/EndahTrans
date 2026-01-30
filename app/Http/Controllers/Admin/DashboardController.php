<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Contact;
use App\Models\Destination;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
            'total_packages' => Package::count(),
            'active_packages' => Package::active()->count(),
            'total_destinations' => Destination::count(),
            'unread_messages' => Contact::unread()->count(),
        ];

        // Recent bookings
        $recentBookings = Booking::with('package')
            ->latest()
            ->take(10)
            ->get();

        // Revenue chart data (last 7 days)
        $revenueData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $revenueData[] = [
                'date' => $date->format('d M'),
                'revenue' => Booking::whereDate('created_at', $date)
                    ->where('payment_status', 'paid')
                    ->sum('total_price'),
                'bookings' => Booking::whereDate('created_at', $date)->count(),
            ];
        }

        // Booking status distribution
        $bookingStats = [
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'paid' => Booking::where('status', 'paid')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard', compact('stats', 'recentBookings', 'revenueData', 'bookingStats'));
    }
}
