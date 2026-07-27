<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $leaderboard = Score::where('created_at', '>=', now()->startOfWeek()->addHours(10))
            ->orderBy('score', 'desc')
            ->take(10)
            ->get();

        $gameVersion = "3.4";

        return view('experience.index', compact('leaderboard', 'gameVersion'));
    }

    public function leaderboard(Request $request)
    {
        $leaderboard = Score::where('created_at', '>=', now()->startOfWeek()->addHours(10))
            ->orderBy('score', 'desc')
            ->take(20)
            ->get();

        return view('experience.leaderboard', compact('leaderboard'));
    }
}
