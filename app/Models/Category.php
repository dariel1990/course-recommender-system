<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public $table = 'categories';

    protected $fillable = [
        'category',
        'orderBy',
    ];

    public function question()
    {
        return $this->hasMany(Question::class, 'categoryId', 'id');
    }
}
