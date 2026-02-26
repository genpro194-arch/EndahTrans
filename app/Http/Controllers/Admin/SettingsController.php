<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'    => 'required|string|max:255',
            'site_phone'   => 'nullable|string|max:50',
            'site_whatsapp'=> 'nullable|string|max:50',
            'site_email'   => 'nullable|email|max:255',
        ]);

        $fields = [
            'site_name', 'site_tagline', 'site_email', 'site_phone',
            'site_whatsapp', 'site_address',
            'site_instagram', 'site_facebook', 'site_twitter', 'site_youtube',
            'site_maps_embed', 'site_maps_link',
            'jam_senin_jumat', 'jam_sabtu', 'jam_minggu',
            'site_about_short', 'site_founded_year',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field, ''));
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
