<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_debt extends Model
{
    use HasFactory;


    protected $table = "employee_debts";
    protected $fillable = [
        'employees_info_id'   ,
        'billing_cycles_id'   ,
        'amount'   ,
        'note'   ,
    ];




    public function employeesInfo( )
    {
        return $this->belongsTo(EmployeesInfo::class , 'employees_info_id' , 'id' );
    }


    public function billing_cycle( )
    {
        return $this->belongsTo(BillingCycle::class ,'billing_cycles_id' , 'id');
    }



}
