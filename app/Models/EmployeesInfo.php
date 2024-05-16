<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesInfo extends Model
{
    use HasFactory;

    protected $table = "employees_info";


    protected $fillable = [
        'name' ,
        'gender' ,
        'date_of_birth' ,
        'place_of_birth' ,
        'nationality' ,
        'address' ,
        'phones' ,
        'email' ,
        'register_date' ,
        'photo' ,
        'note' ,
        'is_subscribed' ,
        'active'
    ];




    public function attachments( )
    {
        return $this->belongsTo(EmployeeAttachments::class);
    }



    public function employees_jobs()
    {
        $this->hasMany(Employees_job::class);

    }



    public function allowns()
    {
        $this->hasMany( Allowance::class);

    }

    public function employee_finance()
    {
        $this->hasMany( Employee_finance::class);
    }
    public function employee_sallary()
    {
        $this->hasMany( EmployeeSalary::class , 'employees_info_id' , 'id' );

    }



    public function employee_debt()
    {
        $this->hasMany( Employee_debt::class , 'employees_info_id' , 'id' );

    }
}
