<?php

namespace App\Models;

use App\Services\ImageOptimizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Gallery $gallery) {
            $gallery->slug = str($gallery->title)->slug();

            if (static::where('slug', $gallery->slug)->exists()) {
                $gallery->slug = $gallery->slug . '-' . static::where('slug', $gallery->slug)->count();
            }
        });

        static::saved(function (Gallery $gallery) {
            if ($gallery->wasChanged('image') && $gallery->image) {
                app(ImageOptimizer::class)->optimize('public', $gallery->image);
                $gallery->image = ImageOptimizer::webpPath($gallery->image);
                $gallery->saveQuietly();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
