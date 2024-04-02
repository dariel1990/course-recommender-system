<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    public $table = 'academic_years';

    protected $fillable = [
        'academic_year',
        'semester',
        'isDefault',
    ];

    public function examination()
    {
        return $this->hasMany(Examination::class, 'academicId', 'id');
    }
}
