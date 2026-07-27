<?php

namespace App\Models;

use App\Services\ImageOptimizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image_url',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = str($post->title)->slug();
            if (static::where('slug', $post->slug)->exists()) {
                $post->slug = $post->slug . '-' . static::where('slug', $post->slug)->count();
            }

            $post->user_id = auth()?->id() ?? 1;
            $post->image_url = asset('storage/' . $post->image_url);
        });

        static::saved(function ($post) {
            if ($post->wasChanged('image_url') && $post->image_url) {
                // Strip asset() prefix to get storage path
                $storagePath = str_replace(asset('storage/'), '', $post->image_url);
                app(ImageOptimizer::class)->optimize('public', $storagePath);
                $post->image_url = asset('storage/' . ImageOptimizer::webpPath($storagePath));
                $post->saveQuietly();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(PostView::class);
    }
}
