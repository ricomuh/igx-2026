<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'username' => 'required|string|max:255|unique:scores,username',
                'email' => 'required|email|max:255|unique:scores,email',
                'score' => 'required|integer|min:0',
            ]);

            // validate the username to trim whitespace, and remove any special characters, only allowing a-z (undercase), 0-9, dot, and underscore
            $username = preg_replace('/[^a-z0-9._]/', '', strtolower(trim($request->input('username'))));

            // Check if the username is empty after sanitization
            if (empty($username)) {
                return response()->json([
                    'message' => 'Invalid username provided',
                ], 400);
            }

            // Check if the username already exists
            if (Score::where('username', $username)->exists()) {
                return response()->json([
                    'message' => 'Username already exists',
                ], 400);
            }

            // Create a new score entry
            $score = Score::create([
                'username' => $username,
                'email' => $request->input('email'),
                'score' => $request->input('score'),
            ]);

            // Return a response with the created score
            return response()->json([
                'message' => 'Score created successfully',
                'data' => $score,
            ], 201);
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return response()->json([
                'message' => 'Error creating score',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
