@extends('layouts.app')

@section('title', 'Kelola Video Rute - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Video Rute</h1>
                <p class="mt-2 text-gray-600">Kelola video rute perjalanan yang ditampilkan di homepage</p>
            </div>
            <a href="{{ route('admin.route-videos.create') }}"
               class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Video Rute
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($videos->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tujuan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($videos as $video)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}"
                                         class="h-16 w-28 object-cover rounded-lg border border-gray-200">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $video->title }}</div>
                                    <div class="text-xs text-gray-400 mt-1 truncate max-w-xs">{{ $video->youtube_url }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($video->destination)
                                        <span class="px-2 py-1 text-xs font-semibold bg-primary-100 text-primary-700 rounded-full">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $video->destination }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs line-clamp-2">{{ $video->description ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ $video->order }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if ($video->is_active)
                                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-500 rounded-full">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.route-videos.edit', $video) }}"
                                       class="inline-flex items-center px-3 py-1.5 text-sm bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition mr-1">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.route-videos.destroy', $video) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Hapus video ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-sm bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-16">
                    <i class="fas fa-video text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 font-medium">Belum ada video rute.</p>
                    <a href="{{ route('admin.route-videos.create') }}"
                       class="mt-4 inline-flex items-center px-5 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition">
                        <i class="fas fa-plus mr-2"></i> Tambah Video Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
