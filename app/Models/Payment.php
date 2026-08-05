<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'order_id',
        'method',
        'reference_number',
        'amount',
        'proof_path',
        'status',
        'confirmed_at',
        'admin_note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'confirmed_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
