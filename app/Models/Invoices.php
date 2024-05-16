<?php

namespace App\Models;

use App\Models\FeeTrans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoices extends Model
{
    use HasFactory;

    protected $table= "invoices";



    protected $fillable = [
        'billing_cycles_id',
        'students_info_id',
        'levels_id',
        'programs_id',
        'feestypes_id',
        'want',
        'discount',
        'account_statuse',
    ];



    public function fee_trans( )
    {
        return $this->hasMany(FeeTrans::class    );
    }



    public function studentInfo( )
    {
        return $this->belongsTo(Students_info::class,   'students_info_id' , 'id'   );
    }


    public function billing_cycle( )
    {
        return $this->belongsTo(BillingCycle::class   ,'billing_cycles_id' , 'id');
    }




    public function feestypes( )
    {

        return $this->belongsTo(FeesType::class );
    }


    public function programs( )
    {
        return $this->belongsTo(Programs::class );
    }


  

    // public function levels( )
    // {
    //     return $this->belongsTo(Levels::class );
    // }


    // public function groups( )
    // {
    //     return $this->belongsTo(Groups::class );
    // }

    // public function classes( )
    // {

    //     return $this->belongsTo(Classes::class  , 'classes_id' );
    // }
    // public function shifts( )
    // {
    //     return $this->belongsTo(Shifts::class );
    // }

    // public function sections( )
    // {
    //     return $this->belongsTo(Sections::class );
    // }



}
