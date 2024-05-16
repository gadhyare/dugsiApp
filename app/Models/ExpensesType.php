<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesType extends Model
{
    use HasFactory;

    protected $table = "expenses_types";


    protected $fillable = [
        'name',
        'active',
    ];


    public function expenses_info()
    {
        return $this->hasMany( Expensess::class  , 'expenses_types_id' , 'id');

    }
}
