<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_WAITING_CONFIRMATION = 'waiting_confirmation';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_WAITING_CONFIRMATION,
        self::STATUS_CONFIRMED,
        self::STATUS_CANCELLED,
    ];

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_amount',
        'status',
        'payment_method',
        'paid_at',
        'admin_notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopePendingConfirmation($query)
    {
        return $query->where('status', self::STATUS_WAITING_CONFIRMATION);
    }

    public function confirm(): void
    {
        $this->update([
            'status' => self::STATUS_CONFIRMED,
            'paid_at' => now(),
        ]);

        $this->payments()
            ->where('status', Payment::STATUS_PENDING)
            ->latest()
            ->first()
            ?->update([
                'status' => Payment::STATUS_CONFIRMED,
                'confirmed_at' => now(),
            ]);
    }
}
