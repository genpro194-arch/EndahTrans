<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationPrice extends Model
{
    protected $fillable = [
        'destination_id',
        'fleet_type',
        'price_per_day',
    ];

    protected $casts = [
        'price_per_day' => 'integer',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
