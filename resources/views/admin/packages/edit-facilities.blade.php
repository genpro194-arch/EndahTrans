@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Fasilitas Paket</h1>
            <p class="text-gray-600">{{ $package->name ?? 'Paket' }}</p>
        </div>
        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-outline">
            Kembali
        </a>
    </div>

    <!-- Package Info Card -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-600">Nama Paket</p>
                <p class="text-lg font-semibold text-gray-900">{{ $package->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Destinasi</p>
                <p class="text-lg font-semibold text-gray-900">{{ $package->destination->name ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Harga Dasar</p>
                <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Facilities Form -->
    <form action="{{ route('admin.packages.update-facilities', $package) }}" method="POST" class="space-y-6" id="facilitiesForm">
        @csrf
        @method('POST')

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Fasilitas & Harga</h2>

            @if ($errors->any())
                <div class="alert alert-error mb-4" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-6">
                @forelse($busFacilities as $index => $facility)
                    <div class="border-2 border-gray-200 rounded-lg p-6 bg-gray-50" data-facility-id="{{ $facility->id }}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $facility->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $facility->description ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                            <input type="checkbox" class="checkbox checkbox-primary facility-toggle"
                                data-index="{{ $index }}"
                                data-facility-id="{{ $facility->id }}"
                                @checked($package->packageFacilities->pluck('bus_facility_id')->contains($facility->id))
                                onchange="toggleFacilityForm(this)">
                        </div>

                        <div class="facility-form" style="display: @if($package->packageFacilities->pluck('bus_facility_id')->contains($facility->id)) block @else none @endif;">
                            <!-- Features Display -->
                            @php
                                $pf = $package->packageFacilities->firstWhere('bus_facility_id', $facility->id);
                                $featuresDisplay = $pf && $pf->features ? $pf->features : $facility->features;
                            @endphp
                            @if($featuresDisplay)
                                <div class="mb-4 p-3 bg-white rounded border-l-4 border-primary-500">
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Fitur Saat Ini:</p>
                                    <ul class="text-sm text-gray-600 space-y-1">
                                        @foreach((array) $featuresDisplay as $feature)
                                            @if($feature)
                                                <li class="flex items-center">
                                                    <span class="text-primary-500 mr-2">✓</span>
                                                    {{ $feature }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Features Edit -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Edit Fitur (Pisahkan dengan koma)
                                </label>
                                <textarea 
                                    name="facilities[{{ $index }}][features]"
                                    class="textarea textarea-bordered w-full"
                                    rows="3"
                                    placeholder="Contoh: AC, Kursi Busa, Toilet">@if($pf && $pf->features){{ implode(', ', $pf->features) }}@else{{ implode(', ', (array) $facility->features) }}@endif</textarea>
                                <p class="text-xs text-gray-500 mt-1">Pisahkan setiap fitur dengan koma. Contoh: AC, WiFi, Kursi Reclining</p>
                            </div>

                            <!-- Price Input -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Harga
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-3 text-gray-600">Rp</span>
                                        <input type="number" 
                                            name="facilities[{{ $index }}][price]"
                                            value="{{ $pf?->price ?? '' }}"
                                            placeholder="0"
                                            step="100"
                                            min="0"
                                            class="input input-bordered w-full pl-10"
                                            required>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Harga Diskon (Opsional)
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-3 text-gray-600">Rp</span>
                                        <input type="number" 
                                            name="facilities[{{ $index }}][discount_price]"
                                            value="{{ $pf?->discount_price ?? '' }}"
                                            placeholder="0"
                                            step="100"
                                            min="0"
                                            class="input input-bordered w-full pl-10">
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden input for bus_facility_id -->
                            <input type="hidden" name="facilities[{{ $index }}][bus_facility_id]" value="{{ $facility->id }}">

                            <!-- Price Preview -->
                            <div class="mt-3 p-3 bg-blue-50 rounded text-sm">
                                @php
                                    $pf = $package->packageFacilities->firstWhere('bus_facility_id', $facility->id);
                                    $finalPrice = $pf ? ($pf->discount_price ?? $pf->price) : 'Belum diatur';
                                    $discount = 0;
                                    if ($pf && $pf->discount_price && $pf->price > 0) {
                                        $discount = round((($pf->price - $pf->discount_price) / $pf->price) * 100);
                                    }
                                @endphp
                                <p class="text-gray-700">
                                    <strong>Harga Final:</strong> 
                                    @if($finalPrice !== 'Belum diatur')
                                        Rp {{ number_format($finalPrice, 0, ',', '.') }}
                                        @if($discount > 0)
                                            <span class="text-red-600">(-{{ $discount }}%)</span>
                                        @endif
                                    @else
                                        {{ $finalPrice }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        Tidak ada fasilitas tersedia.
                    </div>
                @endforelse
            </div>

            <!-- Submit Button -->
            <div class="flex gap-3 mt-8">
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-ghost">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>

<script>
function toggleFacilityForm(checkbox) {
    const form = checkbox.closest('[data-facility-id]').querySelector('.facility-form');
    if (form) {
        form.style.display = checkbox.checked ? 'block' : 'none';
    }
}

// Handle form submission - only include checked facilities
document.getElementById('facilitiesForm').addEventListener('submit', function(e) {
    // Get all facility sections
    const facilitySections = document.querySelectorAll('[data-facility-id]');
    let checkedCount = 0;

    facilitySections.forEach(section => {
        const checkbox = section.querySelector('.facility-toggle');
        const priceInputs = section.querySelectorAll('input[type="number"]');
        
        if (checkbox.checked) {
            checkedCount++;
            // Make inputs required only if checked
            priceInputs.forEach(input => {
                if (input.name.includes('price')) {
                    input.removeAttribute('disabled');
                }
            });
        } else {
            // Disable inputs so they don't submit if unchecked
            priceInputs.forEach(input => {
                if (input.name.includes('price')) {
                    input.setAttribute('disabled', 'disabled');
                }
            });
        }
    });

    if (checkedCount === 0) {
        e.preventDefault();
        alert('Pilih minimal 1 fasilitas');
    }
});
</script>
@endsection
