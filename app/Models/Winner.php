<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['score_id'];

    /**
     * Get the score associated with the winner.
     */
    public function score()
    {
        return $this->belongsTo(Score::class);
    }
}
