<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    public $table = 'question_options';

    protected $fillable = [
        'questionId',
        'option',
        'isCorrect',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId', 'id');
    }
}
