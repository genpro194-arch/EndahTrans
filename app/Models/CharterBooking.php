<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharterBooking extends Model
{
    use HasFactory;

    protected $table = 'charter_bookings';

    protected $fillable = [
        'booking_code',
        'fleet_type',
        'customer_name',
        'customer_email',
        'customer_phone',
        'destination',
        'departure_date',
        'departure_time',
        'duration_days',
        'num_buses',
        'price_per_bus_per_day',
        'total_price',
        'special_requests',
        'status',
        'payment_status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'duration_days' => 'integer',
        'num_buses' => 'integer',
        'price_per_bus_per_day' => 'integer',
        'total_price' => 'integer',
    ];

    /** Generate a unique booking code like CT20260225A1B2 */
    public static function generateCode(): string
    {
        $prefix = 'CT';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        $code = "{$prefix}{$date}{$random}";

        // Ensure uniqueness
        while (self::where('booking_code', $code)->exists()) {
            $random = strtoupper(substr(uniqid(), -4));
            $code = "{$prefix}{$date}{$random}";
        }

        return $code;
    }

    public function getFleetLabelAttribute(): string
    {
        return $this->fleet_type === 'eksklusif' ? 'Eksklusif' : 'Reguler';
    }

    public function getTotalPriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getPricePerBusFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->price_per_bus_per_day, 0, ',', '.');
    }
}
