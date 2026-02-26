<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::orderBy('sort_order')->orderBy('id')->paginate(15);
        return view('admin.buses.index', compact('buses'));
    }

    public function create()
    {
        return view('admin.buses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:eksklusif,reguler,bigtop,superexec',
            'capacity'    => 'required|integer|min:1',
            'short_desc'  => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'base_price'  => 'nullable|integer|min:0',
            'image'       => 'nullable|image|max:3072',
            'is_active'   => 'boolean',
            'sort_order'  => 'nullable|integer',
            'facilities'  => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(4);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('buses', 'public');
        }

        if ($request->filled('facilities')) {
            $lines = array_filter(array_map('trim', explode("\n", $request->input('facilities'))));
            $facs = [];
            foreach ($lines as $line) {
                [$icon, $label] = array_pad(explode('|', $line, 2), 2, '');
                if ($label) $facs[] = ['icon' => trim($icon), 'label' => trim($label)];
            }
            $data['facilities'] = $facs;
        }

        Bus::create($data);
        return redirect()->route('admin.buses.index')->with('success', 'Armada berhasil ditambahkan!');
    }

    public function edit(Bus $bus)
    {
        $facilitiesText = '';
        if ($bus->facilities) {
            $facilitiesText = collect($bus->facilities)->map(fn($f) => ($f['icon'] ?? '') . '|' . ($f['label'] ?? ''))->implode("\n");
        }
        return view('admin.buses.edit', compact('bus', 'facilitiesText'));
    }

    public function update(Request $request, Bus $bus)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:eksklusif,reguler,bigtop,superexec',
            'capacity'    => 'required|integer|min:1',
            'short_desc'  => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'base_price'  => 'nullable|integer|min:0',
            'image'       => 'nullable|image|max:3072',
            'is_active'   => 'boolean',
            'sort_order'  => 'nullable|integer',
            'facilities'  => 'nullable|string',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($bus->image && !str_starts_with($bus->image, 'http')) {
                Storage::disk('public')->delete($bus->image);
            }
            $data['image'] = $request->file('image')->store('buses', 'public');
        }

        if ($request->filled('facilities')) {
            $lines = array_filter(array_map('trim', explode("\n", $request->input('facilities'))));
            $facs = [];
            foreach ($lines as $line) {
                [$icon, $label] = array_pad(explode('|', $line, 2), 2, '');
                if ($label) $facs[] = ['icon' => trim($icon), 'label' => trim($label)];
            }
            $data['facilities'] = $facs;
        } else {
            $data['facilities'] = [];
        }

        $bus->update($data);
        return redirect()->route('admin.buses.index')->with('success', 'Armada berhasil diperbarui!');
    }

    public function destroy(Bus $bus)
    {
        if ($bus->image && !str_starts_with($bus->image, 'http')) {
            Storage::disk('public')->delete($bus->image);
        }
        $bus->delete();
        return back()->with('success', 'Armada berhasil dihapus!');
    }

    public function toggleActive(Bus $bus)
    {
        $bus->update(['is_active' => !$bus->is_active]);
        return back()->with('success', 'Status armada diperbarui!');
    }
}
