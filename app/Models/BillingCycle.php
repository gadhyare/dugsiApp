<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingCycle extends Model
{
    use HasFactory;


    protected $table = 'billing_cycles';

    protected $fillable = [
        'name',
        'initial_balance',
        'active'
    ];


    public function invoice()
    {
        $this->hasMany(Invoices::class   ,'billing_cycles_id' , 'id');

    }



    public function expenses_info()
    {
        return $this->hasMany( Expensess::class ,'billing_cycles_id' , 'id');

    }



    public function allowns()
    {
        $this->hasMany( Allowance::class  ,'billing_cycles_id' , 'id');

    }

    public function employee_sallary()
    {
        $this->hasMany( EmployeeSalary::class  ,'billing_cycles_id' , 'id');

    }



    public function employee_debt()
    {
        $this->hasMany( Employee_debt::class , 'employees_info_id' , 'id' );

    }


}
