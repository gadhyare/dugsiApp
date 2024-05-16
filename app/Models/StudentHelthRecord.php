<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHelthRecord extends Model
{
    use HasFactory;

    protected $table = "students_helth_record";
    protected $fillable = [
        'students_info_id'   ,
        'disease'   ,
        'date_of_injury'   ,
        'hereditary'   ,
        'case_now'   ,
        'h_comments'   ,
        'register_date'   ,
    ];



    public function Students_info( )
    {
        return $this->belongsTo(Students_info::class );
    }



}

