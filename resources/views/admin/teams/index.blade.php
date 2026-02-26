@extends('layouts.app')

@section('title', 'Kelola Tim Profesional - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Tim Profesional</h1>
                <p class="mt-2 text-gray-600">Kelola anggota tim profesional Endah Travel</p>
            </div>
            <a href="{{ route('admin.teams.create') }}" 
               class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Tim Baru
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Teams Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($teams->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posisi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Media Sosial</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($teams as $team)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $team->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $team->role }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($team->image)
                                            <img src="{{ asset('storage/' . $team->image) }}" 
                                                 alt="{{ $team->name }}" 
                                                 class="h-10 w-10 rounded-full object-cover">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex gap-2">
                                            @if ($team->linkedin_url)
                                                <a href="{{ $team->linkedin_url }}" target="_blank" class="text-brand-600 hover:text-blue-800">
                                                    <i class="fab fa-linkedin"></i>
                                                </a>
                                            @endif
                                            @if ($team->instagram_url)
                                                <a href="{{ $team->instagram_url }}" target="_blank" class="text-pink-600 hover:text-pink-800">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                        <a href="{{ route('admin.teams.edit', $team->id) }}" 
                                           class="text-primary-600 hover:text-primary-900 transition">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.teams.destroy', $team->id) }}" 
                                              method="POST" 
                                              class="inline" 
                                              onsubmit="return confirm('Yakin ingin menghapus tim ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition">
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
                <div class="px-6 py-12 text-center">
                    <i class="fas fa-users text-gray-400 text-5xl mb-4"></i>
                    <p class="text-gray-600 mb-4">Belum ada anggota tim profesional</p>
                    <a href="{{ route('admin.teams.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition">
                        <i class="fas fa-plus mr-2"></i> Tambah Tim Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
