<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_finance extends Model
{
    use HasFactory;



    protected $table = "employee_finances";
    protected $fillable = [
        'employees_info_id'   ,
        'allowance_types_id'   ,
        'amount'   ,
        'note'   ,
    ];

    public function employeesInfo()
    {
        return $this->belongsTo(EmployeesInfo::class);
    }


    public function allowance_types()
    {
        return $this->belongsTo(AllowanceType::class);
    }


}
