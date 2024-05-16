<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttachments extends Model
{
    use HasFactory;


    protected $table = "student_attachments";
    protected $fillable = [
        'students_info_id'   ,
        'title'   ,
        'description'   ,
        'file_name'   ,
    ];



    public function Students_info( )
    {
        return $this->belongsTo(Students_info::class );
    }

}
