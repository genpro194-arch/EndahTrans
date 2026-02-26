<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title', 'category', 'image', 'caption', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
        }
        return 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=400&q=80';
    }

    public static function categories(): array
    {
        return [
            'armada'     => 'Armada Bus',
            'perjalanan' => 'Perjalanan',
            'destinasi'  => 'Destinasi',
            'event'      => 'Event',
            'lainnya'    => 'Lainnya',
        ];
    }
}
