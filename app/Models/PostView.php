<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    /** @use HasFactory<\Database\Factories\PostViewFactory> */
    use HasFactory;

    protected $fillable = [
        'views',
        'date',
        'post_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('date', now());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('date', now()->month);
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('date', now()->year);
    }
}
