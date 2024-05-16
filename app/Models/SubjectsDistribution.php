<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectsDistribution extends Model
{
    use HasFactory;

    protected $table = "subjects_distributions";

    protected $fillable = [
        'subjects_id',
        'programs_id', 
        'max_mark',
        'min_mark',
        'rank',
        'active',
    ];



    // public function classes( )
    // {
    //     return $this->belongsTo(Classes::class );
    // }



    // public function levels( )
    // {
    //     return $this->belongsTo(Levels::class );
    // }

    public function program( )
    {
        return $this->belongsTo(Programs::class );
    }


    public function subjects( )
    {
        return $this->belongsTo(Subjects::class );
    }



    public function exam( )
    {
        return $this->hasMany(Exams::class , 'subjects_distributions_id' );
    }



}
