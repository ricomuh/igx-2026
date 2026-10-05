/**
 * ============================================================================
 * IGX 2026 — Game Score API SDK (Construct 3 & JavaScript)
 * ============================================================================
 * 
 * Pre-configured SDK to handle game session handshake, AES-256-CBC encryption,
 * and secure score submission for Indonesia Game Expo 2026.
 *
 * Designed for direct use in Construct 3 (Scripts in Project / Run Script actions)
 * and standalone HTML5 web games.
 *
 * @version 1.0.0
 * @author IGX Tech Team
 */

(function (root, factory) {
    const api = factory();
    if (typeof globalThis !== 'undefined') globalThis.IgxGameApi = api;
    if (typeof window !== 'undefined') window.IgxGameApi = api;
    if (typeof self !== 'undefined') self.IgxGameApi = api;
    if (typeof define === 'function' && define.amd) {
        define([], () => api);
    } else if (typeof module === 'object' && module.exports) {
        module.exports = api;
    } else {
        root.IgxGameApi = api;
    }
}(typeof self !== 'undefined' ? self : this, function () {
    'use strict';

    // ========================================================================
    // 1. CONFIGURATION & CONSTANTS
    // ========================================================================

    /**
     * Choose environment: 'prod' | 'stage' | 'local'
     * Change this to 'prod' when building for production!
     */
    let CURRENT_ENV = 'stage';

    const BASE_URLS = {
        prod:  'https://igx.co.id',
        stage: 'https://igx-03.leolitgames.com',
        local: 'http://127.0.0.1:8000',
    };

    /**
     * Pre-shared secret key CONSTANT.
     * MUST match GAME_SECRET_KEY in server .env / config/game.php
     */
    const CONST_KEY = 'igx_game_secret_2026_x7k9p2m4';

    // Stored active session parameter
    let sessionParam = null;

    // ========================================================================
    // 2. CRYPTO UTILITIES (Native Web Crypto API — No External Libraries)
    // ========================================================================

    const encoder = typeof TextEncoder !== 'undefined' ? new TextEncoder() : null;

    /**
     * Convert Uint8Array or ArrayBuffer to Base64 string
     */
    function arrayBufferToBase64(buffer) {
        const bytes = new Uint8Array(buffer);
        let binary = '';
        for (let i = 0; i < bytes.byteLength; i++) {
            binary += String.fromCharCode(bytes[i]);
        }
        return btoa(binary);
    }

    /**
     * Derive AES-256 key from (CONST_KEY + ":" + param) using SHA-256
     */
    async function deriveAesKey(secretKey, param) {
        const keyMaterial = encoder.encode(secretKey + ':' + param);
        const hashBuffer = await crypto.subtle.digest('SHA-256', keyMaterial);
        return crypto.subtle.importKey(
            'raw',
            hashBuffer,
            { name: 'AES-CBC' },
            false,
            ['encrypt', 'decrypt']
        );
    }

    /**
     * Encrypt plaintext string using AES-256-CBC
     * @returns {Promise<{payload: string, iv: string}>} base64 ciphertext and base64 iv
     */
    async function encryptPayload(plaintext, secretKey, param) {
        if (!crypto || !crypto.subtle) {
            throw new Error('Web Crypto API (crypto.subtle) is not available. Please run in a secure context (HTTPS / localhost).');
        }

        const aesKey = await deriveAesKey(secretKey, param);
        const iv = crypto.getRandomValues(new Uint8Array(16));
        const plaintextBytes = encoder.encode(plaintext);

        const ciphertextBuffer = await crypto.subtle.encrypt(
            { name: 'AES-CBC', iv: iv },
            aesKey,
            plaintextBytes
        );

        return {
            payload: arrayBufferToBase64(ciphertextBuffer),
            iv: arrayBufferToBase64(iv),
        };
    }

    // ========================================================================
    // 3. API METHODS
    // ========================================================================

    const IgxGameApi = {
        /**
         * Get the current active base URL
         */
        getBaseUrl: function () {
            return BASE_URLS[CURRENT_ENV] || BASE_URLS.stage;
        },

        /**
         * Switch environment ('prod', 'stage', or 'local')
         */
        setEnvironment: function (env) {
            if (BASE_URLS[env]) {
                CURRENT_ENV = env;
            } else {
                console.warn('[IgxGameApi] Unknown environment "' + env + '". Defaulting to "stage".');
                CURRENT_ENV = 'stage';
            }
            return this.getBaseUrl();
        },

        /**
         * Get current environment
         */
        getEnvironment: function () {
            return CURRENT_ENV;
        },

        /**
         * Get the pre-shared secret key
         */
        getConstKey: function () {
            return CONST_KEY;
        },

        /**
         * Set or override the current session parameter manually
         */
        setParam: function (param) {
            sessionParam = param ? String(param).trim() : null;
        },

        /**
         * Get the current session parameter
         */
        getParam: function () {
            return sessionParam;
        },

        /**
         * Initialize the game session parameter:
         * 1. Checks URL query string (e.g. ?param=xxxxxxx from iframe embed).
         * 2. If not found in URL (e.g. running in Construct preview / demo mode),
         *    fetches a demo session token from the backend /api/v1/game/session.
         *
         * @returns {Promise<string>} The active session parameter
         */
        init: async function () {
            // Check URL query parameters first (iframe embed mode)
            if (typeof window !== 'undefined' && window.location && window.location.search) {
                const urlParams = new URLSearchParams(window.location.search);
                const urlParam = urlParams.get('param');
                if (urlParam) {
                    sessionParam = urlParam;
                    return sessionParam;
                }
            }

            // If already set manually, return it
            if (sessionParam) {
                return sessionParam;
            }

            // Standalone / Demo fallback: request from demo endpoint
            return await this.fetchDemoSession();
        },

        /**
         * Fetch a fresh session parameter from the server demo endpoint.
         * Note: Can be disabled in production via server configuration.
         */
        fetchDemoSession: async function () {
            const url = this.getBaseUrl() + '/api/v1/game/session';
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            });

            if (!response.ok) {
                const errData = await response.json().catch(() => ({}));
                throw new Error(errData.message || 'Failed to fetch demo session. Status: ' + response.status);
            }

            const data = await response.json();
            if (!data.param) {
                throw new Error('Server response did not contain a valid session parameter.');
            }

            sessionParam = data.param;
            return sessionParam;
        },

        /**
         * Encrypt and send player score to the backend.
         *
         * @param {string} username - Player display name
         * @param {string} email - Player email for winner contact / verification
         * @param {number} score - Final integer score
         * @returns {Promise<object>} Server response with position and weekly leaderboard
         */
        sendScore: async function (username, email, score) {
            // 1. Ensure we have a valid session parameter
            let param = this.getParam();
            if (!param) {
                param = await this.init();
            }

            if (!param) {
                throw new Error('No game session parameter available. Cannot submit score.');
            }

            // 2. Prepare payload
            const rawPayload = JSON.stringify({
                username: String(username || '').trim(),
                email: String(email || '').trim(),
                score: Math.max(0, parseInt(score, 10) || 0),
                timestamp: Date.now(),
            });

            // 3. Encrypt payload with AES-256-CBC
            const encrypted = await encryptPayload(rawPayload, CONST_KEY, param);

            // 4. Send POST request
            const endpoint = this.getBaseUrl() + '/api/v1/scores';
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    param: param,
                    payload: encrypted.payload,
                    iv: encrypted.iv,
                }),
            });

            const result = await response.json().catch(() => ({}));

            if (!response.ok) {
                return {
                    success: false,
                    status: response.status,
                    message: result.message || 'Failed to record score',
                    error: result.error || null,
                };
            }

            // Session param is one-time consumed upon successful score recording
            sessionParam = null;

            return {
                success: true,
                status: response.status,
                message: result.message || 'Score recorded successfully',
                data: result.data || null,
                position: result.position || null,
                leaderboard: result.leaderboard || [],
            };
        },

        /**
         * Fetch leaderboard scores
         * 
         * @param {number} limit Number of top scores (default: 10, max: 100)
         * @param {string} period 'weekly' (default, resets Monday 10:00) or 'all_time'
         * @returns {Promise<object>} { success: true, period: 'weekly', count: 10, data: [{ rank, username, score, created_at }] }
         */
        getLeaderboard: async function (limit = 10, period = 'weekly') {
            const params = new URLSearchParams({
                limit: String(limit),
                period: String(period),
            });
            const endpoint = `${this.getBaseUrl()}/api/v1/leaderboard?${params.toString()}`;

            const response = await fetch(endpoint, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
            });

            const result = await response.json().catch(() => ({}));

            if (!response.ok) {
                return {
                    success: false,
                    status: response.status,
                    message: result.message || 'Failed to fetch leaderboard',
                    data: [],
                };
            }

            return {
                success: true,
                status: response.status,
                period: result.period || period,
                count: result.count || (result.data ? result.data.length : 0),
                data: result.data || [],
            };
        },
    };

    return IgxGameApi;
}));
