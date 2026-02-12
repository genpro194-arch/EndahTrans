<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Destination;
use App\Models\BusFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::with('destination');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('destination')) {
            $query->where('destination_id', $request->destination);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $packages = $query->latest()->paginate(15);
        $destinations = Destination::all();

        return view('admin.packages.index', compact('packages', 'destinations'));
    }

    public function create()
    {
        $destinations = Destination::where('is_active', true)->get();
        $busFacilities = BusFacility::where('is_active', true)->orderBy('display_order')->get();
        return view('admin.packages.create', compact('destinations', 'busFacilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'itinerary' => 'nullable|string',
            'includes' => 'nullable|string',
            'excludes' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'duration_days' => 'required|integer|min:1',
            'max_person' => 'required|integer|min:1',
            'min_person' => 'required|integer|min:1|lte:max_person',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'departure_date' => 'nullable|date',
            'departure_time' => 'nullable',
            'meeting_point' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'facilities' => 'nullable|array',
            'facilities.*.bus_facility_id' => 'required|exists:bus_facilities,id',
            'facilities.*.price' => 'required|numeric|min:0',
            'facilities.*.discount_price' => 'nullable|numeric|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        $package = Package::create($validated);

        // Save facilities
        $this->syncFacilities($package, $request->facilities ?? []);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit(Package $package)
    {
        $destinations = Destination::where('is_active', true)->get();
        $busFacilities = BusFacility::where('is_active', true)->orderBy('display_order')->get();
        return view('admin.packages.edit', compact('package', 'destinations', 'busFacilities'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'itinerary' => 'nullable|string',
            'includes' => 'nullable|string',
            'excludes' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'duration_days' => 'required|integer|min:1',
            'max_person' => 'required|integer|min:1',
            'min_person' => 'required|integer|min:1|lte:max_person',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'departure_date' => 'nullable|date',
            'departure_time' => 'nullable',
            'meeting_point' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'facilities' => 'nullable|array',
            'facilities.*.bus_facility_id' => 'required|exists:bus_facilities,id',
            'facilities.*.price' => 'required|numeric|min:0',
            'facilities.*.discount_price' => 'nullable|numeric|min:0',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($validated);

        // Update facilities
        $this->syncFacilities($package, $request->facilities ?? []);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil dihapus!');
    }

    public function toggleFeatured(Package $package)
    {
        $package->update(['is_featured' => !$package->is_featured]);

        $status = $package->is_featured ? 'ditambahkan ke' : 'dihapus dari';
        return redirect()->route('admin.packages.index')
            ->with('success', "Paket berhasil $status rute terpopuler!");
    }

    public function editFacilities(Package $package)
    {
        $package->load(['packageFacilities.busFacility', 'destination']);
        $busFacilities = BusFacility::where('is_active', true)->orderBy('display_order')->get();
        
        return view('admin.packages.edit-facilities', compact('package', 'busFacilities'));
    }

    public function updateFacilities(Request $request, Package $package)
    {
        $validated = $request->validate([
            'facilities' => 'required|array|min:1',
            'facilities.*.bus_facility_id' => 'required|exists:bus_facilities,id',
            'facilities.*.price' => 'required|numeric|min:0',
            'facilities.*.discount_price' => 'nullable|numeric|min:0',
            'facilities.*.features' => 'nullable|string',
        ]);

        // Update facilities
        $this->syncFacilities($package, $validated['facilities']);

        return redirect()->route('admin.packages.edit', $package)
            ->with('success', 'Fasilitas paket berhasil diperbarui!');
    }

    private function syncFacilities(Package $package, $facilities)
    {
        // Delete existing facilities
        $package->packageFacilities()->delete();

        // Add new facilities
        if ($facilities) {
            foreach ($facilities as $facility) {
                // Parse features from comma-separated string to array
                $features = null;
                if (!empty($facility['features'])) {
                    $features = array_map('trim', explode(',', $facility['features']));
                    $features = array_filter($features); // Remove empty strings
                    $features = array_values($features); // Re-index array
                }

                $package->packageFacilities()->create([
                    'bus_facility_id' => $facility['bus_facility_id'],
                    'price' => $facility['price'],
                    'discount_price' => $facility['discount_price'] ?? null,
                    'features' => $features ? $features : null,
                ]);
            }
        }
    }
}
