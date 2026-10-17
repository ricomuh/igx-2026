<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Special guests for IGX 2026, from the official guest covers (cropped to the 4:5 guest tile).
 *
 * Content rather than schema, but shipping it as a migration puts it on every environment
 * with the normal deploy. Rows are upserted by slug and images copied to the public disk
 * (where Filament uploads go), so admins can still edit or replace them afterwards.
 */
return new class extends Migration
{
    private const INSTAGRAM = 'https://www.instagram.com/indonesiagameexpo/';

    /** Listed first to last; the guests page sorts newest first, so timestamps descend. */
    private const GUESTS = [
        'simone-legno' => 'Simone Legno',
        'takayuki-nakayama' => 'Takayuki Nakayama',
        'takamasa-suga' => 'Takamasa Suga',
        'satoshi-matsuda' => 'Satoshi Matsuda',
        'takaya-aoyagi' => 'Takaya Aoyagi',
        'hitoshi-ariga' => 'Hitoshi Ariga',
        'kirisaki' => 'Kirisaki',
        'akari-akase' => 'Akari Akase',
        'sophie-peach-milky' => 'Sophie (Peach Milky)',
        'shookoboo' => 'Shookoboo',
        'nekonoi-katsu' => 'Nekonoi Katsu',
        'chiitan' => 'Chiitan☆',
    ];

    public function up(): void
    {
        $disk = Storage::disk('public');
        $newest = now();
        $i = 0;

        foreach (self::GUESTS as $slug => $name) {
            $path = "guests/images/igx-2026-{$slug}.webp";
            $source = database_path("data/guests/{$slug}.webp");

            if (! $disk->exists($path) || $disk->size($path) !== filesize($source)) {
                $disk->put($path, file_get_contents($source));
            }

            $stamp = $newest->copy()->subSeconds($i++);
            $exists = DB::table('guests')->where('slug', $slug)->exists();

            // Query builder on purpose: Guest::saved would re-encode the WebP and rename it.
            DB::table('guests')->updateOrInsert(['slug' => $slug], array_merge([
                'name' => $name,
                'image_url' => $path,
                'url' => self::INSTAGRAM,
                'updated_at' => $stamp,
            ], $exists ? [] : ['created_at' => $stamp]));
        }
    }

    public function down(): void
    {
        DB::table('guests')->whereIn('slug', array_keys(self::GUESTS))->delete();

        foreach (array_keys(self::GUESTS) as $slug) {
            Storage::disk('public')->delete("guests/images/igx-2026-{$slug}.webp");
        }
    }
};
