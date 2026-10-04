<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GameSession extends Model
{
    protected $fillable = [
        'token',
        'is_demo',
        'ip_address',
        'user_agent',
        'expires_at',
        'used_at',
    ];

    protected $casts = [
        'is_demo' => 'boolean',
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    /**
     * Create a new game session with a secure random token.
     */
    public static function createSession(bool $isDemo = false, ?string $ip = null, ?string $userAgent = null): self
    {
        $lifetime = config('game.session_lifetime_minutes', 120);

        return self::create([
            'token' => bin2hex(random_bytes(32)),
            'is_demo' => $isDemo,
            'ip_address' => $ip,
            'user_agent' => $userAgent ? Str::limit($userAgent, 500, '') : null,
            'expires_at' => now()->addMinutes($lifetime),
            'used_at' => null,
        ]);
    }

    /**
     * Verify that the token is valid, unconsumed, and not expired,
     * then mark it as used (one-time consume for score submission).
     */
    public static function verifyAndConsume(string $token): ?self
    {
        $session = self::where('token', $token)->first();

        if (!$session) {
            return null;
        }

        if ($session->used_at !== null || $session->expires_at->isPast()) {
            return null;
        }

        $session->update([
            'used_at' => now(),
        ]);

        return $session;
    }

    public function isValid(): bool
    {
        return $this->used_at === null && $this->expires_at->isFuture();
    }
}
