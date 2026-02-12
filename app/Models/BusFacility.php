<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusFacility extends Model
{
    use HasFactory;

    protected $table = 'bus_facilities';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'features',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public function packageFacilities()
    {
        return $this->hasMany(PackageBusFacility::class, 'bus_facility_id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_bus_facilities', 'bus_facility_id', 'package_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
