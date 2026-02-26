<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteVideo extends Model
{
    protected $fillable = [
        'title',
        'destination',
        'youtube_url',
        'thumbnail',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Ambil YouTube embed URL dari URL YouTube biasa.
     */
    public function getEmbedUrlAttribute(): string
    {
        $url = $this->youtube_url;

        // youtu.be/ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // youtube.com/watch?v=ID
        if (preg_match('/[?&]v=([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Sudah embed
        if (str_contains($url, '/embed/')) {
            return $url;
        }

        return $url;
    }

    /**
     * Thumbnail otomatis dari YouTube jika tidak diisi manual.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        // Ambil dari YouTube
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $this->youtube_url, $m) ||
            preg_match('/[?&]v=([a-zA-Z0-9_-]+)/', $this->youtube_url, $m)) {
            return 'https://img.youtube.com/vi/' . $m[1] . '/hqdefault.jpg';
        }

        return 'https://via.placeholder.com/480x270?text=Video';
    }

    public static function active()
    {
        return static::where('is_active', true)->orderBy('order')->orderBy('created_at', 'desc');
    }
}
