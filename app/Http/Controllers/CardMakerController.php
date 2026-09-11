<?php

namespace App\Http\Controllers;

use App\Models\CardMakerSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CardMakerController extends Controller
{
    // Rate limit: 3 submissions per IP per 10 minutes
    private const RATE_LIMIT = 3;
    private const RATE_WINDOW = 600; // seconds

    public function index()
    {
        return view('card-maker.index');
    }

    public function gallery()
    {
        $submissions = CardMakerSubmission::approved()
            ->orderByDesc('approved_at')
            ->paginate(24);

        return view('card-maker.gallery', compact('submissions'));
    }

    public function store(Request $request)
    {
        $ip = $request->ip();

        // Silent rate limit check
        $cacheKey = 'card_maker_rl_' . md5($ip);
        $attempts = Cache::get($cacheKey, 0);

        if ($attempts >= self::RATE_LIMIT) {
            // Return fake success so user doesn't know they're blocked
            return response()->json(['success' => true, 'id' => null]);
        }

        $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:160'],
            'image'       => ['required', 'string'], // base64 PNG data URL
        ]);

        // Decode base64 image
        $imageData = $request->input('image');
        if (!str_starts_with($imageData, 'data:image/png;base64,')) {
            return response()->json(['success' => false], 422);
        }

        $base64 = substr($imageData, strlen('data:image/png;base64,'));
        $decoded = base64_decode($base64);
        if ($decoded === false) {
            return response()->json(['success' => false], 422);
        }

        // Save image to storage
        $filename = 'cards/' . Str::uuid() . '.png';
        Storage::disk('public')->put($filename, $decoded);

        // Save submission
        CardMakerSubmission::create([
            'name'             => $request->input('name'),
            'description'      => $request->input('description'),
            'card_image_path'  => 'public/' . $filename,
            'ip_address'       => $ip,
            'user_agent'       => substr($request->userAgent() ?? '', 0, 500),
            'status'           => 'pending',
        ]);

        // Increment rate limit counter
        if ($attempts === 0) {
            Cache::put($cacheKey, 1, self::RATE_WINDOW);
        } else {
            Cache::increment($cacheKey);
        }

        return response()->json(['success' => true]);
    }
}
