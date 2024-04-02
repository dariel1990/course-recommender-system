<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\StudentObserver;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;

    public $table = 'students';

    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'suffix',
        'gender',
        'birthDate',
        'address',
        'emailAddress',
        'ethnicity',
        'citizenship',
        'contactNo',
        'lastSchoolAttended',
        'status',
        'course1',
        'course2',
        'academicId'
    ];

    public $appends = [
        'fullname',
    ];

    public function getFullnameAttribute()
    {
        return Str::upper($this->lastName) . ', ' . Str::upper($this->firstName) . ' ' . Str::upper($this->middleName) . ' ' . Str::upper($this->suffix);
    }

    public function examination()
    {
        return $this->hasOne(Examination::class, 'studentId', 'id');
    }
}
