<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'package_id',
        'bus_facility_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'number_of_buses',
        'booking_date',
        'departure_time',
        'total_price',
        'special_requests',
        'status',
        'payment_status',
        'payment_method',
        'payment_proof',
        'paid_at',
        'admin_notes',
        'doku_order_id',
        'doku_payment_url',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'departure_time' => 'datetime:H:i',
        'total_price' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function busFacility()
    {
        return $this->belongsTo(BusFacility::class);
    }

    public static function generateBookingCode()
    {
        $prefix = 'ET';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return "{$prefix}{$date}{$random}";
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>',
            'confirmed' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Dikonfirmasi</span>',
            'paid' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Dibayar</span>',
            'cancelled' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>',
            'completed' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Selesai</span>',
            default => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Unknown</span>',
        };
    }

    public function getPaymentStatusBadgeAttribute()
    {
        return match($this->payment_status) {
            'unpaid' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Belum Bayar</span>',
            'partial' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Sebagian</span>',
            'paid' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>',
            'refunded' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Refund</span>',
            default => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Unknown</span>',
        };
    }
}
