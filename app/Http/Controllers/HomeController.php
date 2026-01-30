<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPackages = Package::with('destination')
            ->active()
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $destinations = Destination::where('is_active', true)
            ->withCount(['packages' => function ($query) {
                $query->where('is_active', true);
            }])
            ->take(8)
            ->get();

        $testimonials = Testimonial::active()
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'destinations' => Destination::where('is_active', true)->count(),
            'packages' => Package::active()->count(),
            'customers' => \App\Models\Booking::where('status', 'completed')->count(),
        ];

        return view('home', compact('featuredPackages', 'destinations', 'testimonials', 'stats'));
    }

    public function about()
    {
        return view('about');
    }
}
