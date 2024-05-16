<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceType extends Model
{
    use HasFactory;


    protected $table = "allowance_types";


    protected $fillable = [
        'name',
        'active',
    ];


    public function allowns()
    {
        $this->hasMany( Allowance::class);

    }



    public function employee_finance()
    {
        $this->hasMany( Employee_finance::class);
    }


}
