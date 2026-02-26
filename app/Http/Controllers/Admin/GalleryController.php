<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->orderByDesc('id')->paginate(20);
        $categories = Gallery::categories();
        return view('admin.gallery.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        $categories = Gallery::categories();
        return view('admin.gallery.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'category'   => 'required|string',
            'image'      => 'required|image|max:4096',
            'caption'    => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title'      => $request->title,
            'category'   => $request->category,
            'image'      => $path,
            'caption'    => $request->caption,
            'is_active'  => $request->boolean('is_active', true),
            'sort_order' => $request->integer('sort_order', 0),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        $categories = Gallery::categories();
        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'category'   => 'required|string',
            'image'      => 'nullable|image|max:4096',
            'caption'    => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'title'      => $request->title,
            'category'   => $request->category,
            'caption'    => $request->caption,
            'is_active'  => $request->boolean('is_active'),
            'sort_order' => $request->integer('sort_order', 0),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
    }

    public function toggleActive(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);
        return back()->with('success', 'Status foto diperbarui!');
    }
}
