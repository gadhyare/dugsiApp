<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Levels extends Model
{
    use HasFactory , SoftDeletes;



    protected $fillable = [
        'name',
        'active'
    ];



    public function student_school_info()
    {
        return $this->hasMany(StudentsSchoolInfo::class , 'levels_id');
    }



    public function subjects_distributions()
    {
        return $this->hasMany(subjects_distributions::class);
    }

    public function programs()
    {
        return $this->hasMany(Programs::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }


    public function feesvalue()
    {
        $this->hasMany(FeesValue::class);

    }

    public function invoice()
    {
        $this->hasMany(Invoices::class  );

    }


    public function exams()
    {
        $this->hasMany(Exams::class  );

    }



    public function xuduur(): HasMany
    {
        return $this->hasMany(Xuduur::class, 'students_info_id');
    }

}
