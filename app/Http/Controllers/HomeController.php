<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\RouteVideo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPackages = Package::with('destination')
            ->active()
            ->featured()
            ->orderBy('name', 'asc')
            ->get();

        $destinations = Destination::where('is_active', true)
            ->whereNotIn('name', ['Yogyakarta', 'Labuan Bajo', 'Raja Ampat'])
            ->withCount(['packages' => function ($query) {
                $query->where('is_active', true);
            }])
            ->take(3)
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

        $routeVideos = RouteVideo::active()->get();

        return view('home', compact('featuredPackages', 'destinations', 'testimonials', 'stats', 'routeVideos'));
    }

    public function about()
    {
        $teams = Team::all()->toArray();
        
        $stats = [
            'destinations' => Destination::where('is_active', true)->count(),
            'packages' => Package::active()->count(),
            'customers' => \App\Models\Booking::where('status', 'completed')->count(),
        ];

        return view('about', compact('teams', 'stats'));
    }

    public function popularRoutes()
    {
        $popularPackages = Package::with('destination')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('name', 'asc')
            ->get();

        $stats = [
            'destinations' => Destination::where('is_active', true)->count(),
            'packages' => Package::active()->count(),
            'customers' => \App\Models\Booking::where('status', 'completed')->count(),
        ];

        return view('featured-packages', compact('popularPackages', 'stats'));
    }

    public function armada()
    {
        return view('armada');
    }

    public function agen()
    {
        return view('agen');
    }

    public function galeri()
    {
        return view('galeri');
    }

    public function rute()
    {
        $routeVideos = RouteVideo::active()->get();
        return view('rute', compact('routeVideos'));
    }

    public function caraPesan()
    {
        return view('cara-pesan');
    }
}
