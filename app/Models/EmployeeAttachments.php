<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttachments extends Model
{
    use HasFactory;

    protected $table = "employee_attachments";
    protected $fillable = [
        'employees_info_id'   ,
        'title'   ,
        'description'   ,
        'file_name'   ,
    ];



    public function employee( )
    {
        return $this->belongsTo(employees_info::class );
    }



}
