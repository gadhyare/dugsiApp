<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramArchive extends Model
{
    use HasFactory;


    protected $table = "program_archive";

    protected $fillable = [
        'levels_id',
        'classes_id',
        'groups_id',
        'shifts_id',
        'sections_id',
        'status',
    ];



    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }



    public function levels()
    {
        return $this->belongsTo(Levels::class, 'levels_id');
    }


    public function groups()
    {
        return $this->belongsTo(Groups::class);
    }


    public function shifts()
    {
        return $this->belongsTo(Shifts::class);
    }

    public function sections()
    {
        return $this->belongsTo(Sections::class);
    }


    public function invoice()
    {
        $this->hasMany(Invoices::class);
    }

    public function exams()
    {
        $this->hasMany(Exams::class);
    }

    public function subjects_distributions()
    {
        return $this->hasMany(SubjectsDistribution::class);
    }


    public function Students_schoolInfo()
    {
        return $this->hasMany(StudentsSchoolInfo::class);
    }


    public function program_name()
    {
        return $this->levels->name . "-" . $this->classes->name . "-" . $this->groups->name . "-" . $this->shifts->name . "-" . $this->sections->name;
    }


    
}
