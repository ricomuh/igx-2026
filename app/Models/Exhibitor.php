<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibitor extends Model
{
    /** @use HasFactory<\Database\Factories\ExhibitorFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'url',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = str($model->name)->slug();

            if (static::where('slug', $model->slug)->exists()) {
                $model->slug = $model->slug . '-' . static::where('slug', $model->slug)->count();
            }
            // $model->image_url = asset('storage/' . $model->image_url);
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the image URL for the exhibitor.
     *
     * @return string
     */
    public function getFullImageUrlAttribute(): string
    {
        // check if image_url is already a full URL
        if (filter_var($this->attributes['image_url'], FILTER_VALIDATE_URL)) {
            return $this->attributes['image_url'];
        }

        return asset('storage/' . $this->attributes['image_url']);
    }
}
