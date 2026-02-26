{{-- Shared form partial for create & edit destination --}}

{{-- Name --}}
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Nama Destinasi <span class="text-red-500">*</span>
    </label>
    <input type="text" name="name"
           value="{{ old('name', $destination->name ?? '') }}" required
           placeholder="contoh: Bali, Bromo, Labuan Bajo…"
           class="w-full px-4 py-2.5 border rounded-xl text-sm transition outline-none
                  focus:ring-2 focus:ring-brand-400 focus:border-brand-400
                  @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror">
    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Description --}}
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Singkat</label>
    <textarea name="description" rows="3"
              placeholder="Deskripsi singkat destinasi (opsional)"
              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm transition outline-none
                     focus:ring-2 focus:ring-brand-400 focus:border-brand-400 resize-none">{{ old('description', $destination->description ?? '') }}</textarea>
</div>

{{-- Status --}}
<div>
    <label class="flex items-center gap-2.5 cursor-pointer select-none">
        <input type="checkbox" name="is_active" value="1"
               {{ old('is_active', $destination->is_active ?? true) ? 'checked' : '' }}
               class="w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-400">
        <span class="text-sm font-medium text-gray-700">Aktif (tampil di form pemesanan website)</span>
    </label>
</div>

{{-- Prices --}}
<div class="rounded-2xl border border-pink-100 overflow-hidden"
     style="background:linear-gradient(135deg,rgba(236,72,153,.04),rgba(239,68,68,.02))">
    <div class="px-5 pt-4 pb-3 border-b border-pink-100 flex items-center gap-3">
        <div class="w-8 h-8 rounded-xl flex items-center justify-center flex-shrink-0"
             style="background:linear-gradient(135deg,#ec4899,#ef4444)">
            <i class="fas fa-tag text-white text-xs"></i>
        </div>
        <div>
            <p class="font-bold text-gray-800 text-sm">Harga Charter per Kelas Armada</p>
            <p class="text-xs text-gray-400 mt-0.5">Harga per unit bus per hari · Otomatis muncul di form pemesanan saat destinasi dipilih</p>
        </div>
    </div>
    <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach($fleetTypes as $fleetKey => $fleetLabel)
        @php $val = old('prices.'.$fleetKey, $priceMap[$fleetKey] ?? ''); @endphp
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                {{ $fleetLabel }}
                <span class="font-normal text-gray-400">({{ $fleetKey }})</span>
            </label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-bold pointer-events-none">Rp</span>
                <input type="number" name="prices[{{ $fleetKey }}]"
                       value="{{ $val }}"
                       min="0" step="50000" placeholder="0 = belum diset"
                       class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm bg-white
                              focus:ring-2 focus:ring-brand-400 focus:border-brand-400 outline-none transition">
            </div>
        </div>
        @endforeach
    </div>
    <div class="px-5 pb-4">
        <p class="text-xs text-gray-400 flex items-center gap-1.5">
            <i class="fas fa-lightbulb text-amber-400"></i>
            Isi 0 atau kosongkan jika harga belum ditentukan. Harga yang terisi akan muncul otomatis di website.
        </p>
    </div>
</div>
