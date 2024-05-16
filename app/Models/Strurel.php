<?php

namespace App\Models;

use App\Models\Students_info;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Strurel extends Model
{
    use HasFactory;

    protected $fillable = [
        'students_info_id',
        'name',
        'rel_type',
        'rel_lev',
        'address',
        'email',
        'phones',
        'is_subscribe',
        'active',
    ];





    public function Students_info( )
    {
        return $this->belongsTo(Students_info::class , 'fathers_id');
    }
}
