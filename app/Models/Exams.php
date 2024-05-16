<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;



    protected $fillable = [
        'students_info_id' ,
        'programs_id',
        'subjects_distributions_id',
        'qu1',
        'ex1',
        'qu2',
        'ex2',
        'att',
    ];


    public function students_info( )
    {
        return $this->belongsTo(Students_info::class , 'students_info_id');
    }



    public function total(){
        return $this->qu1 + $this->ex1 + $this->qu2 + $this->ex2 + $this->att ;
    }

    public function subjects_distributions(){
        return $this->belongsTo(SubjectsDistribution::class  , 'subjects_distributions_id' );
    }


    public function levels( )
    {
        return $this->belongsTo(Levels::class );
    }


    public function classes( )
    {
        return $this->belongsTo(Classes::class );
    }

    public function program()
    {
        return $this->belongsTo(Programs::class , 'programs_id');
    }

}
