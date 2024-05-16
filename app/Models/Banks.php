<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'bank_number',
        'open_date',
        'op_acc',
        'active'
    ];




    public function fee_trans()
    {
        return $this->hasMany(FeeTrans::class);
    }
}
