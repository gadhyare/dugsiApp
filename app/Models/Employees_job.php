<?php

namespace App\Models;

use App\Models\Emsections;
use App\Models\EmplooyesLevels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees_job extends Model
{
    use HasFactory;


    protected $table = "employees_jobs";
    protected $fillable = [
        'employees_info_id'   ,
        'levels_id'   ,
        'classes_id'   ,
        'salary'   ,
        'start_date'   ,
        'end_date'   ,
        'note'   ,
    ];



    public function employee( )
    {
        return $this->belongsTo(EmployeesInfo::class );
    }



    public function EmplooyesLevels( )
    {
        return $this->belongsTo(EmplooyesLevels::class );
    }



    public function Emsections( )
    {
        return $this->belongsTo(Emsections::class );
    }



}
