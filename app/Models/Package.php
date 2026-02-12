<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'bus_type',
        'capacity',
        'slug',
        'description',
        'itinerary',
        'includes',
        'excludes',
        'price',
        'discount_price',
        'duration_days',
        'max_person',
        'min_person',
        'image',
        'gallery',
        'departure_date',
        'departure_time',
        'meeting_point',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'gallery' => 'array',
        'departure_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function packageFacilities()
    {
        return $this->hasMany(PackageBusFacility::class);
    }

    public function busFacilities()
    {
        return $this->belongsToMany(BusFacility::class, 'package_bus_facilities', 'package_id', 'bus_facility_id')
            ->withPivot('price', 'discount_price')
            ->withTimestamps()
            ->orderBy('display_order');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-package.jpg');
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->discount_price && $this->price > 0) {
            return round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        return 0;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
