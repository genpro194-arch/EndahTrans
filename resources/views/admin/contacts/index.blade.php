@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('page-subtitle', 'Kelola pesan dari pelanggan')

@section('content')
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Pesan</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $contacts->total() }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                    <i class="fas fa-envelope text-white text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Belum Dibaca</p>
                    <p class="text-3xl font-bold text-primary-600">{{ \App\Models\Contact::where('is_read', false)->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                    <i class="fas fa-envelope-open text-white text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Sudah Dibaca</p>
                    <p class="text-3xl font-bold text-secondary-600">{{ \App\Models\Contact::where('is_read', true)->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-secondary-500 to-secondary-700 rounded-2xl flex items-center justify-center shadow-lg shadow-secondary-500/30">
                    <i class="fas fa-check-double text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-gray-100">
        <form action="{{ route('admin.contacts.index') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari nama, email, atau subjek..."
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <select name="status" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition">
                        <option value="">Semua Status</option>
                        <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>📩 Belum Dibaca</option>
                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>✅ Sudah Dibaca</option>
                    </select>
                </div>
                <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-primary-500 to-primary-600 text-white px-6 py-3 rounded-xl hover:from-primary-600 hover:to-primary-700 transition font-semibold shadow-lg shadow-primary-500/30">
                    <i class="fas fa-search mr-2"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
        <div class="divide-y divide-gray-100">
            @forelse($contacts as $contact)
            <div class="p-6 hover:bg-gray-50/50 transition {{ !$contact->is_read ? 'bg-primary-50/50' : '' }}">
                <div class="flex items-start gap-4">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-white shadow
                                    {{ !$contact->is_read ? 'bg-gradient-to-br from-primary-500 to-primary-600' : 'bg-gradient-to-br from-gray-400 to-gray-500' }}">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    @if(!$contact->is_read)
                                        <span class="w-2 h-2 bg-primary-500 rounded-full animate-pulse"></span>
                                    @endif
                                    <h4 class="font-semibold text-gray-900 {{ !$contact->is_read ? 'font-bold' : '' }}">
                                        {{ $contact->name }}
                                    </h4>
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded-full">
                                        {{ $contact->subject }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mb-2">{{ $contact->email }}</p>
                                <p class="text-gray-600 line-clamp-2 {{ !$contact->is_read ? 'font-medium' : '' }}">
                                    {{ Str::limit($contact->message, 150) }}
                                </p>
                            </div>
                            
                            <!-- Meta & Actions -->
                            <div class="flex-shrink-0 text-right">
                                <p class="text-sm text-gray-400 mb-3">
                                    {{ $contact->created_at->diffForHumans() }}
                                </p>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-primary-50 text-primary-600 rounded-xl hover:bg-primary-100 transition text-sm font-semibold">
                                        <i class="fas fa-eye mr-1.5"></i> Baca
                                    </a>
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-10 h-10 flex items-center justify-center text-red-600 hover:text-white bg-red-50 hover:bg-red-500 rounded-xl transition">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @if($contact->phone)
                        <div class="mt-3 flex items-center text-sm text-gray-400">
                            <i class="fas fa-phone mr-2"></i>
                            {{ $contact->phone }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="p-16 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-inbox text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Tidak Ada Pesan</h3>
                <p class="text-gray-500">Pesan dari pelanggan akan muncul di sini</p>
            </div>
            @endforelse
        </div>

        @if($contacts->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $contacts->withQueryString()->links() }}
        </div>
        @endif
    </div>
@endsection

