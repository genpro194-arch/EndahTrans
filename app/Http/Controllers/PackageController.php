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

        // Filter by bus type
        if ($request->has('bus_type')) {
            $query->where('bus_type', $request->bus_type);
        }

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
        $package = Package::with(['destination', 'packageFacilities.busFacility'])
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

    /**
     * API: Get all packages with optional filters and facilities
     */
    public function apiIndex(Request $request)
    {
        $query = Package::with(['destination', 'packageFacilities.busFacility'])->active();

        if ($request->has('bus_type')) {
            $query->where('bus_type', $request->bus_type);
        }

        $packages = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Packages retrieved successfully',
            'data' => $packages
        ]);
    }

    /**
     * API: Get packages by bus type with facilities
     */
    public function apiByBusType($busType)
    {
        $packages = Package::where('bus_type', $busType)
            ->with(['destination', 'packageFacilities.busFacility'])
            ->active()
            ->get();

        if ($packages->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No packages found for bus type: ' . $busType
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Packages retrieved successfully',
            'bus_type' => $busType,
            'capacity' => $busType === 'big' ? 40 : 35,
            'count' => $packages->count(),
            'data' => $packages
        ]);
    }

    /**
     * API: Get pricing comparison for a destination with facilities
     */
    public function apiComparison($destinationSlug)
    {
        $packages = Package::whereHas('destination', function ($q) use ($destinationSlug) {
            $q->where('slug', $destinationSlug);
        })
            ->with(['destination', 'packageFacilities.busFacility'])
            ->active()
            ->get();

        if ($packages->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No packages found for this destination'
            ], 404);
        }

        $comparison = [];
        foreach ($packages as $package) {
            $facilities = $package->packageFacilities->map(function ($pf) {
                return [
                    'id' => $pf->id,
                    'facility' => $pf->busFacility->name,
                    'features' => $pf->busFacility->features,
                    'price' => (float) $pf->price,
                    'discount_price' => $pf->discount_price ? (float) $pf->discount_price : null,
                ];
            });

            $comparison[$package->bus_type] = [
                'name' => $package->name,
                'capacity' => $package->capacity,
                'price' => (float) $package->price,
                'slug' => $package->slug,
                'id' => $package->id,
                'facilities' => $facilities,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Package comparison retrieved successfully',
            'destination' => $destinationSlug,
            'data' => $comparison
        ]);
    }

    /**
     * API: Get Featured Routes (Rute Populer) with facilities
     */
    public function apiFeaturedRoutes()
    {
        $featuredDestinations = Destination::where('is_featured', true)
            ->with(['packages' => function ($q) {
                $q->where('is_active', true)->with('packageFacilities.busFacility');
            }])
            ->active()
            ->get();

        if ($featuredDestinations->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No featured routes found'
            ], 404);
        }

        $routes = [];
        foreach ($featuredDestinations as $destination) {
            $bigBus = $destination->packages->firstWhere('bus_type', 'big');
            $mediumBus = $destination->packages->firstWhere('bus_type', 'medium');

            $routes[] = [
                'destination' => $destination->name,
                'slug' => $destination->slug,
                'description' => $destination->description,
                'big_bus' => $bigBus ? [
                    'name' => $bigBus->name,
                    'capacity' => $bigBus->capacity,
                    'price' => (float) $bigBus->price,
                    'slug' => $bigBus->slug,
                    'facilities' => $bigBus->packageFacilities->map(fn($pf) => [
                        'name' => $pf->busFacility->name,
                        'price' => (float) $pf->price,
                        'discount_price' => $pf->discount_price ? (float) $pf->discount_price : null,
                    ]),
                ] : null,
                'medium_bus' => $mediumBus ? [
                    'name' => $mediumBus->name,
                    'capacity' => $mediumBus->capacity,
                    'price' => (float) $mediumBus->price,
                    'slug' => $mediumBus->slug,
                    'facilities' => $mediumBus->packageFacilities->map(fn($pf) => [
                        'name' => $pf->busFacility->name,
                        'price' => (float) $pf->price,
                        'discount_price' => $pf->discount_price ? (float) $pf->discount_price : null,
                    ]),
                ] : null,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Featured routes retrieved successfully',
            'count' => count($routes),
            'data' => $routes
        ]);
    }

    /**
     * API: Get Cheapest Routes (Harga Terbaik) with facilities
     */
    public function apiCheapestRoutes()
    {
        // Get packages grouped by destination and bus type, ordered by price
        $destinations = Destination::with(['packages' => function ($q) {
            $q->where('is_active', true)
                ->with('packageFacilities.busFacility')
                ->orderBy('price', 'asc');
        }])
            ->active()
            ->get();

        $routes = [];
        foreach ($destinations as $destination) {
            $bigBus = $destination->packages->firstWhere('bus_type', 'big');
            $mediumBus = $destination->packages->firstWhere('bus_type', 'medium');

            $cheapestPrice = null;
            if ($bigBus && $mediumBus) {
                $cheapestPrice = min($bigBus->price, $mediumBus->price);
            } elseif ($bigBus) {
                $cheapestPrice = $bigBus->price;
            } elseif ($mediumBus) {
                $cheapestPrice = $mediumBus->price;
            }

            if ($cheapestPrice) {
                $routes[] = [
                    'destination' => $destination->name,
                    'slug' => $destination->slug,
                    'cheapest_price' => (float) $cheapestPrice,
                    'big_bus' => $bigBus ? [
                        'price' => (float) $bigBus->price,
                        'capacity' => $bigBus->capacity,
                        'slug' => $bigBus->slug,
                        'facilities' => $bigBus->packageFacilities->map(fn($pf) => [
                            'name' => $pf->busFacility->name,
                            'price' => (float) $pf->price,
                            'discount_price' => $pf->discount_price ? (float) $pf->discount_price : null,
                        ]),
                    ] : null,
                    'medium_bus' => $mediumBus ? [
                        'price' => (float) $mediumBus->price,
                        'capacity' => $mediumBus->capacity,
                        'slug' => $mediumBus->slug,
                        'facilities' => $mediumBus->packageFacilities->map(fn($pf) => [
                            'name' => $pf->busFacility->name,
                            'price' => (float) $pf->price,
                            'discount_price' => $pf->discount_price ? (float) $pf->discount_price : null,
                        ]),
                    ] : null,
                ];
            }
        }

        // Sort by cheapest price
        usort($routes, function ($a, $b) {
            return $a['cheapest_price'] <=> $b['cheapest_price'];
        });

        return response()->json([
            'success' => true,
            'message' => 'Cheapest routes retrieved successfully',
            'count' => count($routes),
            'data' => array_values($routes)
        ]);
    }
}
