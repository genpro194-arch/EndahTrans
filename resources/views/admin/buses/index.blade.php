@extends('layouts.admin')

@section('page-title', 'Manajemen Armada')
@section('page-subtitle', 'Kelola data armada bus yang tampil di website')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div class="flex items-center gap-3">
        <span class="bg-pink-100 text-brand-700 text-xs font-bold px-3 py-1.5 rounded-full">
            {{ $buses->total() }} Armada
        </span>
    </div>
    <a href="{{ route('admin.buses.create') }}"
       class="inline-flex items-center gap-2 bg-[#346fff] hover:bg-[#1e4fd8] text-white font-bold px-5 py-2.5 rounded-xl shadow-[0_4px_14px_-2px_rgba(52,111,255,0.4)] hover:shadow-none transition-all text-sm">
        <i class="fas fa-plus"></i> Tambah Armada
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Armada</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-gray-600">Tipe</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-gray-600">Kapasitas</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-gray-600">Harga Dasar</th>
                    <th class="text-left px-4 py-3.5 font-semibold text-gray-600">Status</th>
                    <th class="text-center px-4 py-3.5 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($buses as $bus)
                <tr class="hover:bg-gray-50/60 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-14 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ $bus->getImageUrl() }}" alt="{{ $bus->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">{{ $bus->name }}</div>
                                @if($bus->short_desc)
                                <div class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $bus->short_desc }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        @php
                            $typeColors = ['eksklusif'=>'bg-pink-100 text-brand-700','reguler'=>'bg-green-100 text-green-700','bigtop'=>'bg-purple-100 text-purple-700','superexec'=>'bg-amber-100 text-amber-700'];
                        @endphp
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $typeColors[$bus->type] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $bus->getTypeLabel() }}
                        </span>
                    </td>
                    <td class="px-4 py-4">
                        <span class="font-medium text-gray-700"><i class="fas fa-users text-gray-400 mr-1"></i>{{ $bus->capacity }} Kursi</span>
                    </td>
                    <td class="px-4 py-4">
                        <span class="font-semibold text-gray-800">Rp {{ $bus->base_price > 0 ? number_format($bus->base_price, 0, ',', '.') : '-' }}</span>
                    </td>
                    <td class="px-4 py-4">
                        <form method="POST" action="{{ route('admin.buses.toggle-active', $bus) }}">
                            @csrf
                            <button type="submit" title="Klik untuk toggle status"
                                    class="text-xs font-bold px-3 py-1.5 rounded-full cursor-pointer transition
                                           {{ $bus->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-600 hover:bg-red-200' }}">
                                {{ $bus->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.buses.edit', $bus) }}"
                               class="w-8 h-8 rounded-lg bg-pink-50 text-brand-600 hover:bg-pink-100 flex items-center justify-center transition" title="Edit">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.buses.destroy', $bus) }}"
                                  onsubmit="return confirm('Hapus armada {{ $bus->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center transition" title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-16 text-gray-400">
                        <i class="fas fa-bus text-4xl mb-3 block opacity-30"></i>
                        Belum ada data armada. <a href="{{ route('admin.buses.create') }}" class="text-blue-500 underline">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($buses->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $buses->links() }}
    </div>
    @endif
</div>
@endsection
