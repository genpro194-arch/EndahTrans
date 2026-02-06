@extends('layouts.admin')

@section('title', 'Detail Pemesanan')
@section('page-title', 'Detail Pemesanan')

@section('content')
    <div class="max-w-4xl">
        <div class="mb-4">
            <a href="{{ route('admin.bookings.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Booking Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Kode Booking</p>
                            <p class="text-2xl font-bold text-primary-600 font-mono">{{ $booking->booking_code }}</p>
                        </div>
                        <div class="text-right">
                            {!! $booking->status_badge !!}
                            <div class="mt-1">{!! $booking->payment_status_badge !!}</div>
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Informasi Paket</h3>
                        <div class="flex items-start">
                            <img src="{{ $booking->package->image_url }}" alt="{{ $booking->package->name }}" 
                                 class="w-20 h-20 rounded-lg object-cover"
                                 onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=200'">
                            <div class="ml-4">
                                <h4 class="font-medium text-gray-900">{{ $booking->package->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $booking->package->destination->name }}</p>
                                <p class="text-sm text-gray-500">Durasi: {{ $booking->package->duration_days }} hari</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-6 mt-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Detail Perjalanan</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500">Tanggal Keberangkatan</p>
                                <p class="font-medium">{{ $booking->booking_date->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Jumlah Bus</p>
                                <p class="font-medium">{{ $booking->number_of_buses }} bus</p>
                            </div>
                        </div>
                    </div>

                    @if($booking->special_requests)
                    <div class="border-t pt-6 mt-6">
                        <h3 class="font-semibold text-gray-900 mb-2">Permintaan Khusus</h3>
                        <p class="text-gray-600 text-sm">{{ $booking->special_requests }}</p>
                    </div>
                    @endif
                </div>

                <!-- Customer Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Data Pelanggan</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Nama</p>
                            <p class="font-medium">{{ $booking->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Email</p>
                            <p class="font-medium">{{ $booking->customer_email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">No. HP</p>
                            <p class="font-medium">{{ $booking->customer_phone }}</p>
                        </div>
                        @if($booking->customer_address)
                        <div>
                            <p class="text-gray-500">Alamat</p>
                            <p class="font-medium">{{ $booking->customer_address }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-4 flex gap-2">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->customer_phone) }}" 
                           target="_blank"
                           class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-lg text-sm hover:bg-green-200">
                            <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                        </a>
                        <a href="mailto:{{ $booking->customer_email }}" 
                           class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200">
                            <i class="fas fa-envelope mr-1"></i> Email
                        </a>
                    </div>
                </div>

                <!-- Admin Notes -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Catatan Admin</h3>
                    @if($booking->admin_notes)
                        <p class="text-gray-600 text-sm mb-4">{{ $booking->admin_notes }}</p>
                    @endif
                    <form action="{{ route('admin.bookings.add-note', $booking) }}" method="POST">
                        @csrf
                        <textarea name="admin_notes" rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                  placeholder="Tambah catatan internal...">{{ $booking->admin_notes }}</textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-gray-800 text-white rounded-lg text-sm hover:bg-gray-900">
                            Simpan Catatan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Payment Summary -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Ringkasan Pembayaran</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jumlah Bus</span>
                            <span>{{ $booking->number_of_buses }} bus</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span class="text-primary-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    @if($booking->paid_at)
                    <div class="mt-4 p-3 bg-green-50 rounded-lg text-sm">
                        <p class="text-green-700"><i class="fas fa-check-circle mr-1"></i> Dibayar pada:</p>
                        <p class="font-medium text-green-800">{{ $booking->paid_at->format('d M Y H:i') }}</p>
                    </div>
                    @endif
                </div>

                <!-- Update Status -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Update Status</h3>
                    
                    <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST" class="mb-4">
                        @csrf
                        <label class="block text-sm text-gray-600 mb-2">Status Booking</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 mb-2">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                            Update Status
                        </button>
                    </form>

                    <form action="{{ route('admin.bookings.update-payment', $booking) }}" method="POST">
                        @csrf
                        <label class="block text-sm text-gray-600 mb-2">Status Pembayaran</label>
                        <select name="payment_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 mb-2">
                            <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="partial" {{ $booking->payment_status == 'partial' ? 'selected' : '' }}>Sebagian</option>
                            <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="refunded" {{ $booking->payment_status == 'refunded' ? 'selected' : '' }}>Refund</option>
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">
                            Update Pembayaran
                        </button>
                    </form>
                </div>

                <!-- Danger Zone -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-red-200">
                    <h3 class="font-semibold text-red-600 mb-4">Zona Berbahaya</h3>
                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus pemesanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">
                            <i class="fas fa-trash mr-1"></i> Hapus Pemesanan
                        </button>
                    </form>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Timeline</h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-start">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-1.5 mr-3"></div>
                            <div>
                                <p class="font-medium text-gray-900">Booking dibuat</p>
                                <p class="text-gray-500">{{ $booking->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @if($booking->paid_at)
                        <div class="flex items-start">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-1.5 mr-3"></div>
                            <div>
                                <p class="font-medium text-gray-900">Pembayaran diterima</p>
                                <p class="text-gray-500">{{ $booking->paid_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

