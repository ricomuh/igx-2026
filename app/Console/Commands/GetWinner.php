<?php

namespace App\Console\Commands;

use App\Models\Score;
use App\Models\Winner;
use Illuminate\Console\Command;

class GetWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'score:get-winner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the current winner based on the highest score of this week';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = now();
        $sevenDaysAgo = $currentDate->subDays(7);
        // get the highest score from the last 7 days then add to Winner, but if the winner already exists, get the next highest score
        $highestScores = Score::where('created_at', '>=', $sevenDaysAgo)
            ->orderBy('score', 'desc')
            ->take(1)
            ->get();

        if ($highestScores->isEmpty()) {
            $this->info('No scores found for the last 7 days.');
            return;
        }

        while (true) {
            $highestScore = $highestScores->first();
            if (!$highestScore) {
                $this->info('No more scores available.');
                break;
            }

            // Check if a winner already exists for this score
            if (Winner::where('score_id', $highestScore->id)->exists()) {
                // If a winner exists, get the next highest score
                $highestScores = Score::where('created_at', '>=', $sevenDaysAgo)
                    ->where('id', '!=', $highestScore->id)
                    ->orderBy('score', 'desc')
                    ->take(1)
                    ->get();
            } else {
                // Create a new winner
                Winner::create(['score_id' => $highestScore->id]);
                $this->info("Winner created with score: {$highestScore->score}");
                break;
            }
        }

        $this->info('Winner selection process completed.');
    }
}
