<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\GameSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameSessionController extends Controller
{
    /**
     * Generate a new game session parameter for demo / standalone testing.
     * Can be disabled in production via GAME_DEMO_ENABLED=false.
     */
    public function createDemoSession(Request $request): JsonResponse
    {
        if (!config('game.demo_enabled', true)) {
            return response()->json([
                'success' => false,
                'message' => 'Demo session generation is disabled.',
            ], 403);
        }

        $session = GameSession::createSession(
            isDemo: true,
            ip: $request->ip(),
            userAgent: $request->userAgent()
        );

        return response()->json([
            'success' => true,
            'param' => $session->token,
            'token' => $session->token,
            'token_type' => 'Bearer',
            'expires_at' => $session->expires_at->toIso8601String(),
            'lifetime_minutes' => config('game.session_lifetime_minutes', 120),
        ], 201);
    }
}
