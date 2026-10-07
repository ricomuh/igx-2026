<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\GameSession;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ScoreController extends Controller
{
    /**
     * Get leaderboard scores (public endpoint).
     */
    public function index(Request $request)
    {
        $limit = min(max((int) $request->input('limit', 10), 1), 100);
        $period = (string) $request->input('period', 'weekly');

        $query = Score::query()->orderBy('score', 'desc')->orderBy('created_at', 'asc');

        if ($period !== 'all' && $period !== 'all_time') {
            $weekStart = now()->startOfWeek()->addHours(10);
            if (now()->lt($weekStart)) {
                $weekStart = $weekStart->subWeek();
            }
            $query->where('created_at', '>=', $weekStart);
        }

        $scores = $query->take($limit)->get(['username', 'score', 'created_at']);

        $rank = 1;
        $leaderboard = $scores->map(function ($item) use (&$rank) {
            return [
                'rank' => $rank++,
                'username' => $item->username,
                'score' => (int) $item->score,
                'created_at' => $item->created_at?->toIso8601String(),
            ];
        });

        // Optional: query specific player rank (if username or email passed)
        $playerData = null;
        if ($target = $request->input('username') ?? $request->input('email')) {
            $target = trim((string) $target);
            $targetClean = preg_replace('/[^a-z0-9._]/', '', strtolower($target));

            $playerScore = Score::query()
                ->when($period !== 'all' && $period !== 'all_time', fn($q) => $q->where('created_at', '>=', $weekStart))
                ->where(function ($q) use ($target, $targetClean) {
                    $q->where('username', $targetClean)
                      ->orWhere('email', $target);
                })
                ->orderBy('score', 'desc')
                ->orderBy('created_at', 'asc')
                ->first();

            if ($playerScore) {
                $playerRank = Score::query()
                    ->when($period !== 'all' && $period !== 'all_time', fn($q) => $q->where('created_at', '>=', $weekStart))
                    ->where(function ($q) use ($playerScore) {
                        $q->where('score', '>', $playerScore->score)
                          ->orWhere(function ($sub) use ($playerScore) {
                              $sub->where('score', '=', $playerScore->score)
                                  ->where('created_at', '<', $playerScore->created_at);
                          });
                    })
                    ->count() + 1;

                $playerData = [
                    'rank' => $playerRank,
                    'username' => $playerScore->username,
                    'score' => (int) $playerScore->score,
                    'created_at' => $playerScore->created_at?->toIso8601String(),
                ];
            }
        }

        $response = [
            'success' => true,
            'period' => in_array($period, ['all', 'all_time'], true) ? 'all_time' : 'weekly',
            'count' => $leaderboard->count(),
            'data' => $leaderboard,
        ];

        if ($playerData) {
            $response['player'] = $playerData;
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        try {
            // Check if request is encrypted (standard requirement)
            if ($request->has(['param', 'payload', 'iv'])) {
                $param = (string) $request->input('param');
                $payloadB64 = (string) $request->input('payload');
                $ivB64 = (string) $request->input('iv');

                // 1. Verify and consume the one-time game session parameter
                $session = GameSession::verifyAndConsume($param);
                if (!$session) {
                    return response()->json([
                        'message' => 'Invalid, expired, or already used game session parameter.',
                        'error' => 'invalid_session',
                    ], 403);
                }

                // 2. Derive key: SHA-256(KEY_CONST + ":" + param)
                $secretKey = config('game.secret_key');
                $derivedKey = hash('sha256', $secretKey . ':' . $param, true);

                $cipherRaw = base64_decode($payloadB64, true);
                $ivRaw = base64_decode($ivB64, true);

                if ($cipherRaw === false || $ivRaw === false || strlen($ivRaw) !== 16) {
                    return response()->json([
                        'message' => 'Invalid base64 payload or IV length.',
                        'error' => 'invalid_payload_format',
                    ], 400);
                }

                // 3. Decrypt AES-256-CBC
                $decrypted = openssl_decrypt($cipherRaw, 'AES-256-CBC', $derivedKey, OPENSSL_RAW_DATA, $ivRaw);
                if ($decrypted === false) {
                    return response()->json([
                        'message' => 'Decryption failed. Invalid payload or encryption key.',
                        'error' => 'decryption_failed',
                    ], 400);
                }

                $data = json_decode($decrypted, true);
                if (!is_array($data)) {
                    return response()->json([
                        'message' => 'Decrypted data is not valid JSON.',
                        'error' => 'invalid_json',
                    ], 422);
                }
            } elseif (!app()->isProduction() && $request->has(['username', 'email', 'score'])) {
                // Allow unencrypted payload only in non-production environments for testing
                $data = $request->only(['username', 'email', 'score']);
            } else {
                return response()->json([
                    'message' => 'Encrypted score payload (param, payload, iv) is required.',
                    'error' => 'encrypted_payload_required',
                ], 400);
            }

            // 4. Validate decrypted payload
            $validator = Validator::make($data, [
                'username' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'score' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error on score data',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // 5. Sanitize username: only lowercase a-z, 0-9, dot, underscore
            $username = preg_replace('/[^a-z0-9._]/', '', strtolower(trim($data['username'])));
            if (empty($username)) {
                return response()->json([
                    'message' => 'Invalid username provided after sanitization.',
                ], 400);
            }

            // 6. Record score
            $score = Score::create([
                'username' => $username,
                'email' => $data['email'],
                'score' => (int) $data['score'],
            ]);

            // 7. Optional notification email (fail-safe so mail glitches don't break score saving)
            try {
                Notification::route('mail', $score->email)
                    ->notify(new \App\Notifications\NewScoreNotification($score));
            } catch (\Throwable $e) {
                Log::warning('Score notification email failed: ' . $e->getMessage());
            }

            // 8. Weekly leaderboard scores (starting Monday 10am)
            $weekStart = now()->startOfWeek()->addHours(10);
            $leaderboardScores = Score::orderBy('score', 'desc')
                ->where('created_at', '>=', $weekStart)
                ->take(10)
                ->get(['username', 'score']);

            // 9. User position
            $userPosition = Score::where('created_at', '>=', $weekStart)
                ->where('score', '>', $score->score)
                ->count() + 1;

            return response()->json([
                'message' => 'Score recorded successfully',
                'data' => $score,
                'leaderboard' => $leaderboardScores,
                'position' => $userPosition,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error recording score',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
