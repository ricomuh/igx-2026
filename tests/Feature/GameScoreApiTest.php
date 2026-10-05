<?php

namespace Tests\Feature;

use App\Models\GameSession;
use App\Models\Score;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameScoreApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['game.secret_key' => 'test_game_secret_key_1234567890']);
        config(['game.demo_enabled' => true]);
    }

    /**
     * Helper to encrypt payload matching Construct 3 WebCrypto logic
     */
    protected function encryptPayload(array $data, string $param, string $secretKey): array
    {
        $derivedKey = hash('sha256', $secretKey . ':' . $param, true);
        $iv = random_bytes(16);
        $json = json_encode($data);
        $ciphertext = openssl_encrypt($json, 'AES-256-CBC', $derivedKey, OPENSSL_RAW_DATA, $iv);

        return [
            'param' => $param,
            'payload' => base64_encode($ciphertext),
            'iv' => base64_encode($iv),
        ];
    }

    public function test_can_obtain_demo_session_parameter(): void
    {
        $response = $this->getJson('/api/v1/game/session');

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'param',
                'token',
                'expires_at',
            ]);

        $this->assertTrue($response->json('success'));
        $this->assertNotEmpty($response->json('param'));

        $this->assertDatabaseHas('game_sessions', [
            'token' => $response->json('param'),
            'is_demo' => true,
        ]);
    }

    public function test_demo_session_returns_403_when_disabled(): void
    {
        config(['game.demo_enabled' => false]);

        $response = $this->getJson('/api/v1/game/session');

        $response->assertStatus(403)
            ->assertJson([
                'success' => false,
                'message' => 'Demo session generation is disabled.',
            ]);
    }

    public function test_can_submit_encrypted_score_successfully(): void
    {
        $session = GameSession::createSession(isDemo: true);

        $payload = $this->encryptPayload([
            'username' => 'SuperGamer',
            'email' => 'gamer@igx.co.id',
            'score' => 5400,
            'timestamp' => now()->timestamp,
        ], $session->token, config('game.secret_key'));

        $response = $this->postJson('/api/v1/scores', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => ['id', 'username', 'email', 'score'],
                'leaderboard',
                'position',
            ]);

        $this->assertEquals(1, $response->json('position'));
        $this->assertEquals('supergamer', $response->json('data.username'));
        $this->assertEquals(5400, $response->json('data.score'));

        // Assert session token is consumed (one-time used)
        $session->refresh();
        $this->assertNotNull($session->used_at);

        $this->assertDatabaseHas('scores', [
            'username' => 'supergamer',
            'email' => 'gamer@igx.co.id',
            'score' => 5400,
        ]);
    }

    public function test_cannot_reuse_session_parameter_replay_attack(): void
    {
        $session = GameSession::createSession(isDemo: true);

        $payload = $this->encryptPayload([
            'username' => 'Player1',
            'email' => 'player1@igx.co.id',
            'score' => 3000,
        ], $session->token, config('game.secret_key'));

        // First submit should succeed
        $response1 = $this->postJson('/api/v1/scores', $payload);
        $response1->assertStatus(201);

        // Replay submission with same param must fail
        $response2 = $this->postJson('/api/v1/scores', $payload);
        $response2->assertStatus(403)
            ->assertJson([
                'error' => 'invalid_session',
            ]);
    }

    public function test_rejects_expired_session(): void
    {
        $session = GameSession::createSession(isDemo: true);
        $session->update(['expires_at' => now()->subMinutes(5)]);

        $payload = $this->encryptPayload([
            'username' => 'ExpiredPlayer',
            'email' => 'expired@igx.co.id',
            'score' => 1000,
        ], $session->token, config('game.secret_key'));

        $response = $this->postJson('/api/v1/scores', $payload);
        $response->assertStatus(403);
    }

    public function test_rejects_tampered_or_wrong_secret_key(): void
    {
        $session = GameSession::createSession(isDemo: true);

        // Encrypted with wrong key
        $payload = $this->encryptPayload([
            'username' => 'Hacker',
            'email' => 'hacker@igx.co.id',
            'score' => 99999,
        ], $session->token, 'WRONG_SECRET_KEY_HERE');

        $response = $this->postJson('/api/v1/scores', $payload);
        $response->assertStatus(400)
            ->assertJson([
                'error' => 'decryption_failed',
            ]);
    }

    public function test_experience_page_renders_with_session_param_in_iframe(): void
    {
        $response = $this->get('/experience');

        $response->assertStatus(200);
        $response->assertSee('experience.igx.co.id');
        $response->assertSee('?param=');
    }

    public function test_experiences_plural_page_also_renders_iframe(): void
    {
        $response = $this->get('/experiences');

        $response->assertStatus(200);
        $response->assertSee('experience.igx.co.id');
        $response->assertSee('?param=');
    }

    public function test_can_fetch_weekly_leaderboard(): void
    {
        // Setup scores
        Score::create(['username' => 'player_top', 'email' => 'top@igx.co.id', 'score' => 9999, 'created_at' => now()]);
        Score::create(['username' => 'player_mid', 'email' => 'mid@igx.co.id', 'score' => 5000, 'created_at' => now()]);
        Score::create(['username' => 'player_low', 'email' => 'low@igx.co.id', 'score' => 1000, 'created_at' => now()]);

        // Old score (last month)
        $old = Score::create(['username' => 'old_player', 'email' => 'old@igx.co.id', 'score' => 99999]);
        $old->created_at = now()->subWeeks(3);
        $old->save();

        $response = $this->getJson('/api/v1/scores?limit=5');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'period',
                'count',
                'data' => [
                    '*' => ['rank', 'username', 'score', 'created_at'],
                ],
            ]);

        $this->assertEquals(3, $response->json('count'));
        $this->assertEquals('player_top', $response->json('data.0.username'));
        $this->assertEquals(9999, $response->json('data.0.score'));
        $this->assertEquals(1, $response->json('data.0.rank'));

        // Also test /api/v1/leaderboard alias
        $aliasResponse = $this->getJson('/api/v1/leaderboard');
        $aliasResponse->assertStatus(200);
        $this->assertEquals('player_top', $aliasResponse->json('data.0.username'));
    }

    public function test_can_fetch_all_time_leaderboard(): void
    {
        Score::create(['username' => 'current_champ', 'email' => 'c@igx.co.id', 'score' => 5000, 'created_at' => now()]);
        Score::create(['username' => 'ancient_legend', 'email' => 'legend@igx.co.id', 'score' => 88888, 'created_at' => now()->subWeeks(4)]);

        $response = $this->getJson('/api/v1/leaderboard?period=all');

        $response->assertStatus(200);
        $this->assertEquals('all_time', $response->json('period'));
        $this->assertEquals(2, $response->json('count'));
        $this->assertEquals('ancient_legend', $response->json('data.0.username'));
        $this->assertEquals(88888, $response->json('data.0.score'));
    }
}
