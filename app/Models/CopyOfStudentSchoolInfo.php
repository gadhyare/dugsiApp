<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyOfStudentSchoolInfo extends Model
{
    use HasFactory;

    protected $table = "copy_of_student_infos" ;
    protected $fillable = [
        'first_name', 
        'middle_name', 
        'last_name', 
        'family_number_id', 
        'blood_group',
        'sex', 
        'date_of_birth', 
        'place_of_birth', 
        'nationality', 
        'address', 
        'city', 
        'phone', 
        'photo',  
    ];
 
}
