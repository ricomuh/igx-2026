<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Game Secret Key (Pre-shared Key CONST)
    |--------------------------------------------------------------------------
    |
    | Shared constant key between the backend and the Construct 3 game client.
    | Used together with dynamic session parameters to encrypt/decrypt score data.
    |
    */
    'secret_key' => env('GAME_SECRET_KEY', 'igx_game_secret_2026_x7k9p2m4'),

    /*
    |--------------------------------------------------------------------------
    | Game Demo Session Endpoint Enabled
    |--------------------------------------------------------------------------
    |
    | When true, the standalone / demo endpoint (/api/v1/game/session) can be
    | called by developers during local testing or demo builds without iframe.
    | Can be disabled in production (GAME_DEMO_ENABLED=false).
    |
    */
    'demo_enabled' => env('GAME_DEMO_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime in Minutes
    |--------------------------------------------------------------------------
    |
    | How long a generated session parameter is valid before expiration.
    |
    */
    'session_lifetime_minutes' => (int) env('GAME_SESSION_LIFETIME', 120),

    /*
    |--------------------------------------------------------------------------
    | Experience Game Iframe Base URL
    |--------------------------------------------------------------------------
    |
    | Base URL for the embedded game iframe in /experience.
    |
    */
    'experience_iframe_url' => env('GAME_EXPERIENCE_URL', 'https://experience.igx.co.id'),
];
