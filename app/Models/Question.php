<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $table = 'questions';

    protected $fillable = [
        'categoryId',
        'question',
        'orderBy',
    ];

    public function criteria()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'id');
    }

    public function option()
    {
        return $this->hasMany(QuestionOption::class, 'questionId', 'id');
    }
}
