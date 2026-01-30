<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::with('destination')->active();

        // Filter by destination
        if ($request->filled('destination')) {
            $query->where('destination_id', $request->destination);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by duration
        if ($request->filled('duration')) {
            $query->where('duration_days', $request->duration);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('destination', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Sort
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderByRaw('COALESCE(discount_price, price) ASC');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(discount_price, price) DESC');
                break;
            case 'popular':
                $query->withCount('bookings')->orderBy('bookings_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $packages = $query->paginate(12);
        $destinations = Destination::where('is_active', true)->get();

        return view('packages.index', compact('packages', 'destinations'));
    }

    public function show($slug)
    {
        $package = Package::with('destination')
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        $relatedPackages = Package::with('destination')
            ->active()
            ->where('id', '!=', $package->id)
            ->where('destination_id', $package->destination_id)
            ->take(4)
            ->get();

        return view('packages.show', compact('package', 'relatedPackages'));
    }
}
