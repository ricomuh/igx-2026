<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function __invoke(Request $request)
    {
        // get the top 10 scores created in this week starting in monday at 10am
        $scores = Score::where('created_at', '>=', now()->startOfWeek()->addHours(10))
            ->orderBy('score', 'desc')
            ->take(10)
            ->get();

        return view('experience.index', compact('scores'));
    }
}
