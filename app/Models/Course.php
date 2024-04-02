<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public $table = 'courses';

    protected $fillable = [
        'academicId',
        'courseCode',
        'courseDesc',
        'departmentId',
        'passingRate',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academicId', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId', 'id');
    }
}
