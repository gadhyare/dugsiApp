<?php

namespace App\Models;

use App\Models\Students_info;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyNumber extends Model
{
    use HasFactory , SoftDeletes;

    

    protected $table = "family_number";
    protected  $primaryKey = 'id';



    protected $fillable = [
        'fnumber',
        'active',
        'deleted_at'
    ];


 


    public function student_info()   
    {
        return $this->hasMany(Students_info::class );
    }
}
