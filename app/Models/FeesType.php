<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesType extends Model
{
    use HasFactory;

    protected $table = "feestypes";


    protected $fillable = [
        'name' ,
        'active'
    ];



    public function feesvalue()
    {
        $this->hasMany(FeesValue::class , 'feestypes_id');
    }


    public function invoice()
    {
        $this->hasMany(Invoices::class  );

    }

    public function fee_trans()
    {
        $this->hasMany(FeeTrans::class  );

    }



}
