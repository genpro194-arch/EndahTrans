@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-4">
            <a href="{{ route('admin.contacts.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $contact->subject }}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{ $contact->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    @if(!$contact->is_read)
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-pink-100 text-blue-800">Baru</span>
                    @endif
                </div>
            </div>

            <div class="p-6 border-b">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-primary-600 font-bold text-lg">{{ strtoupper(substr($contact->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $contact->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $contact->email }}</p>
                        @if($contact->phone)
                            <p class="text-sm text-gray-500">{{ $contact->phone }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6 border-b">
                <h4 class="font-semibold text-gray-700 mb-3">Pesan:</h4>
                <p class="text-gray-600 whitespace-pre-line">{{ $contact->message }}</p>
            </div>

            <div class="p-6 flex space-x-4">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                    <i class="fas fa-reply mr-2"></i> Balas Email
                </a>
                @if($contact->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
                @endif
            </div>

            @if($contact->admin_reply)
            <div class="p-6 bg-gray-50 border-t">
                <h4 class="font-semibold text-gray-700 mb-3">Balasan Admin:</h4>
                <p class="text-gray-600">{{ $contact->admin_reply }}</p>
            </div>
            @endif

            <div class="p-6 border-t">
                <h4 class="font-semibold text-gray-700 mb-3">Simpan Balasan (Internal):</h4>
                <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                    @csrf
                    <textarea name="admin_reply" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                              placeholder="Catat balasan yang telah diberikan...">{{ $contact->admin_reply }}</textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-gray-800 text-white rounded-lg text-sm hover:bg-gray-900">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

