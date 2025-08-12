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
        $sevenDaysAgoAt10AM = $currentDate->subDays(7)->setTime(10, 0, 0);

        // Get emails of existing winners
        $existingWinnerEmails = Winner::with('score')
            ->get()
            ->pluck('score.email')
            ->filter() // Remove null values
            ->toArray();

        $newWinners = Score::where('created_at', '>=', $sevenDaysAgoAt10AM)
            ->orderBy('score', 'desc')
            ->whereNotIn('email', $existingWinnerEmails)
            ->take(3)
            ->get();

        $newWinners->each(function ($score) {
            Winner::create([
                'score_id' => $score->id
            ]);
        });

        $this->info('Winner selection process completed.');
    }
}
