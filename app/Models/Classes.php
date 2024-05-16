<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = "classes";
    protected $fillable = [
        'name',
        'levels_id',
        'active'
    ];




    public function student_school_info()
    {
        return $this->hasMany(StudentsSchoolInfo::class);
    }


    public function programs()
    {
        return $this->hasMany(Programs::class);
    }

    public function subjects_distributions()
    {
        return $this->hasMany(subjects_distributions::class);
    }



    public function levels()
    {
        return $this->belongsTo(Levels::class);
    }


    public function feesvalue()
    {
        $this->hasMany(FeesValue::class);
    }


    public function invoice()
    {
        $this->hasMany(Invoices::class);
    }


    public function exams()
    {
        $this->hasMany(Exams::class);
    }



    public function xuduur(): HasMany
    {
        return $this->hasMany(Xuduur::class, 'students_info_id');
    }



    // protected static function deletes()
    // {

    //     static::deleting(function ($classes) {
    //         $relationMethods = ['programs', 'student_school_info'  ];

    //         foreach ($relationMethods as $relationMethod) {
    //             if ($classes->$relationMethod()->count() > 0) {
    //                 return false;
    //             }
    //         }
    //     });
    // }
}
