<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Livewire\Features\SupportAttributes\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

class Sections extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'active'
    ];


    protected $casts = [
        'name' => AsStringable::class
    ];

    public function student_school_info()
    {
        return $this->hasMany(StudentsSchoolInfo::class);
    }


    public function invoice()
    {
        $this->hasMany(Invoices::class  );

    }


    public function xuduur(): HasMany
    {
        return $this->hasMany(Xuduur::class, 'students_info_id');
    }



    public function programs()
    {
        return $this->hasMany(Programs::class);
    }


    protected function create_at():  Attribute
    {

    }
}
