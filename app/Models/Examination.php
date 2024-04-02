<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
        'referenceCode',
        'academicId',
        'studentId',
        'schedule',
        'hasCompleted'
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academicId', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'studentId', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->generateReferenceCode();
        });
    }

    public function generateReferenceCode()
    {
        $this->referenceCode = 'REF' . uniqid();
    }
}
