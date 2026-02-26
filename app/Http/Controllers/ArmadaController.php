<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArmadaController extends Controller
{
    public function index(Request $request): View
    {
        $kelasFilter = $request->query('kelas');

        $query = Bus::where('is_active', true);

        if ($kelasFilter) {
            $query->where('class', $kelasFilter);
        }

        $buses = $query->get();

        // Group by class
        $busesByClass = $buses->groupBy('class');

        // Semua kelas yang tersedia (untuk tombol filter)
        $allClasses = Bus::where('is_active', true)->distinct()->pluck('class');

        return view('armada', [
            'buses' => $buses,
            'busesByClass' => $busesByClass,
            'kelasFilter' => $kelasFilter,
            'allClasses' => $allClasses,
        ]);
    }
}
