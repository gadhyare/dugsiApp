<?php

namespace App\Models;

use App\Models\Invoices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeTrans extends Model
{
    use HasFactory;

    protected $table = "fee_trans";

    protected $fillable = [
        'students_info_id' ,
        'invoices_id' ,
        'paid_date',
        'descount',
        'amount',
        'transaction_id',
        'note',
        'banks_id',
    ];





    public function banks()
    {
        return $this->belongsTo( Banks::class );

    }

    public function invoices()
    {
        return $this->belongsTo( Invoices::class    ) ;

    }


}
