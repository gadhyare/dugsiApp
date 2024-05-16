<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shifts extends Model
{
    use HasFactory;

    protected $table = "shifts";

    protected $fillable = [
        'name',
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

    public function invoice()
    {
        $this->hasMany(Invoices::class  );

    }



    public function xuduur(): HasMany
    {
        return $this->hasMany(Xuduur::class, 'students_info_id');
    }
}
