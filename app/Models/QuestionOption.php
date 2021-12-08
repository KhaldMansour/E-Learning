<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'option_question';

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
