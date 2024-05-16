<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expensess extends Model
{
    use HasFactory;



    protected $table = "expenses";
    protected $fillable = [
        'expenses_types_id',
        'billing_cycles_id',
        'date',
        'amount',
        'note',
    ];


    public function expensesType()
    {
        return $this->belongsTo( ExpensesType::class  , 'expenses_types_id' , 'id');

    }


    public function billing_cycle( )
    {
        return $this->belongsTo(BillingCycle::class ,'billing_cycles_id' , 'id');
    }
}
