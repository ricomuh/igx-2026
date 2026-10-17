<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Reorder the IGX 2026 special guests. The guests page lists newest first,
 * so the order is set through descending created_at values; only rows that
 * exist are touched and nothing else about them changes.
 */
return new class extends Migration
{
    private const ORDER = [
        'takayuki-nakayama',
        'takamasa-suga',
        'satoshi-matsuda',
        'takaya-aoyagi',
        'simone-legno',
        'chiitan',
        'hitoshi-ariga',
        'kirisaki',
        'akari-akase',
        'sophie-peach-milky',
        'shookoboo',
        'nekonoi-katsu',
    ];

    /** Order set by 2026_10_17_000000_add_igx_2026_special_guests. */
    private const PREVIOUS = [
        'simone-legno',
        'takayuki-nakayama',
        'takamasa-suga',
        'satoshi-matsuda',
        'takaya-aoyagi',
        'hitoshi-ariga',
        'kirisaki',
        'akari-akase',
        'sophie-peach-milky',
        'shookoboo',
        'nekonoi-katsu',
        'chiitan',
    ];

    public function up(): void
    {
        $this->apply(self::ORDER);
    }

    public function down(): void
    {
        $this->apply(self::PREVIOUS);
    }

    private function apply(array $slugs): void
    {
        // Anchor to the newest of these guests so the block keeps its place
        // relative to guests added through the admin before or after it.
        $newest = DB::table('guests')->whereIn('slug', $slugs)->max('created_at');
        if (! $newest) {
            return;
        }

        $anchor = \Illuminate\Support\Carbon::parse($newest);
        foreach ($slugs as $i => $slug) {
            DB::table('guests')->where('slug', $slug)->update(['created_at' => $anchor->copy()->subSeconds($i)]);
        }
    }
};
