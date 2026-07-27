<?php

namespace App\Models;

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
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
