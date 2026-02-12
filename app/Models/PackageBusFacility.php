<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBusFacility extends Model
{
    use HasFactory;

    protected $table = 'package_bus_facilities';

    protected $fillable = [
        'package_id',
        'bus_facility_id',
        'price',
        'discount_price',
        'features',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'features' => 'array',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function busFacility()
    {
        return $this->belongsTo(BusFacility::class, 'bus_facility_id');
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
}
