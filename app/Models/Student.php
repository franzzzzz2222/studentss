<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name', 'first_name', 'middle_name', 'age', 'sex', 'program',
        'address', 'email', 'contact_no', 'father_name', 'father_contact_no',
        'mother_name', 'mother_contact_no', 'guardian_name', 'guardian_contact_no',
        'guardian_address', 'student_number', 'school_year'
    ];
}
