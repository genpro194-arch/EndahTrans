<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    const FLEET_TYPES = [
        'eksklusif' => 'Sleeper Bus',
        'reguler'   => 'Executive',
        'bigtop'    => 'Executive Big Top',
        'superexec' => 'Super Executive',
    ];

    public function index()
    {
        $destinations = Destination::withCount('packages')->with('prices')->latest()->paginate(15);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create', ['fleetTypes' => self::FLEET_TYPES]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'   => 'boolean',
            'prices'      => 'nullable|array',
            'prices.*'    => 'nullable|integer|min:0',
        ]);

        $validated['slug']      = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination = Destination::create($validated);

        // Save prices
        if ($request->filled('prices')) {
            foreach ($request->input('prices', []) as $fleet => $price) {
                if (array_key_exists($fleet, self::FLEET_TYPES) && $price > 0) {
                    DestinationPrice::updateOrCreate(
                        ['destination_id' => $destination->id, 'fleet_type' => $fleet],
                        ['price_per_day'  => $price]
                    );
                }
            }
        }

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function edit(Destination $destination)
    {
        $destination->load('prices');
        $fleetTypes  = self::FLEET_TYPES;
        $priceMap    = $destination->prices->pluck('price_per_day', 'fleet_type')->toArray();
        return view('admin.destinations.edit', compact('destination', 'fleetTypes', 'priceMap'));
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'   => 'boolean',
            'prices'      => 'nullable|array',
            'prices.*'    => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($validated);

        // Save prices
        foreach (array_keys(self::FLEET_TYPES) as $fleet) {
            $price = (int) $request->input("prices.{$fleet}", 0);
            if ($price > 0) {
                DestinationPrice::updateOrCreate(
                    ['destination_id' => $destination->id, 'fleet_type' => $fleet],
                    ['price_per_day'  => $price]
                );
            } else {
                DestinationPrice::where('destination_id', $destination->id)
                    ->where('fleet_type', $fleet)->delete();
            }
        }

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi berhasil diperbarui!');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->packages()->count() > 0) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus destinasi yang memiliki paket.']);
        }

        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi berhasil dihapus!');
    }
}
