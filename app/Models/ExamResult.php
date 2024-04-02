<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'examinationId',
        'questionId',
        'optionId',
        'isCorrect',
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examinationId', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId', 'id');
    }
}
