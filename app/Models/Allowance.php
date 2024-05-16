<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    use HasFactory;


    protected $fillable = [
        'employees_info_id',
        'allowance_types_id',
        'billing_cycles_id',
        'date',
        'amount',
        'note',
    ];




    public function employeesInfo()
    {
        return $this->belongsTo(EmployeesInfo::class);
    }


    public function allowance_types()
    {
        return $this->belongsTo(AllowanceType::class);
    }





    public function billing_cycle( )
    {
        return $this->belongsTo(BillingCycle::class ,'billing_cycles_id' , 'id');
    }
}
