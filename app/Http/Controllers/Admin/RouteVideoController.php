<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RouteVideo;
use Illuminate\Http\Request;

class RouteVideoController extends Controller
{
    public function index()
    {
        $videos = RouteVideo::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.route-videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.route-videos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'destination' => 'nullable|string|max:255',
            'youtube_url' => 'required|string|max:500',
            'description' => 'nullable|string|max:500',
            'order'       => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        RouteVideo::create($validated);

        return redirect()->route('admin.route-videos.index')
            ->with('success', 'Video rute berhasil ditambahkan!');
    }

    public function edit(RouteVideo $routeVideo)
    {
        return view('admin.route-videos.edit', compact('routeVideo'));
    }

    public function update(Request $request, RouteVideo $routeVideo)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'destination' => 'nullable|string|max:255',
            'youtube_url' => 'required|string|max:500',
            'description' => 'nullable|string|max:500',
            'order'       => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        $routeVideo->update($validated);

        return redirect()->route('admin.route-videos.index')
            ->with('success', 'Video rute berhasil diperbarui!');
    }

    public function destroy(RouteVideo $routeVideo)
    {
        $routeVideo->delete();
        return redirect()->route('admin.route-videos.index')
            ->with('success', 'Video rute berhasil dihapus!');
    }
}
