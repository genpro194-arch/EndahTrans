<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bus extends Model
{
    protected $fillable = [
        'name', 'slug', 'type', 'capacity', 'short_desc', 'description',
        'base_price', 'image', 'extra_images', 'facilities', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'extra_images' => 'array',
        'facilities'   => 'array',
        'is_active'    => 'boolean',
        'base_price'   => 'integer',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($bus) {
            if (empty($bus->slug)) {
                $bus->slug = Str::slug($bus->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getTypeLabel(): string
    {
        return match($this->type) {
            'eksklusif' => 'Sleeper Bus',
            'reguler'   => 'Executive',
            'bigtop'    => 'Executive Big Top',
            'superexec' => 'Super Executive',
            default     => $this->type,
        };
    }

    public function getImageUrl(): string
    {
        if ($this->image) {
            return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
        }
        return 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&q=80';
    }
}
