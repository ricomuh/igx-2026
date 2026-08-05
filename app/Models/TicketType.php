<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'capacity',
        'is_active',
        'sort',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'capacity' => 'integer',
        'is_active' => 'boolean',
        'sort' => 'integer',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function soldCount(): int
    {
        return $this->orderItems()
            ->whereHas('order', fn ($q) => $q->whereIn('status', ['pending', 'waiting_confirmation', 'confirmed']))
            ->sum('qty');
    }

    public function isSoldOut(): bool
    {
        return $this->capacity !== null && $this->soldCount() >= $this->capacity;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort');
    }

    protected static function booted(): void
    {
        static::saving(function (TicketType $type) {
            if (empty($type->slug)) {
                $type->slug = Str::slug($type->name);
            }
        });
    }
}
