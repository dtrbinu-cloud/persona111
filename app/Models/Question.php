<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'answer',
        'type',
        'difficulty',
        'stage',
    ];

    public function wrongAnswers(): HasMany
    {
        return $this->hasMany(WrongAnswer::class);
    }
}
