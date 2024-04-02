<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $table = 'departments';

    protected $fillable = [
        'short_name',
        'description',
        'program_head',
    ];

    public function course()
    {
        return $this->hasMany(Course::class, 'departmentId', 'id');
    }
}
