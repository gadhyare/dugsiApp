<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Xuduur extends Model
{
    use HasFactory;



    protected $table = "xuduurs";
 
    protected $fillable = [
        'students_info_id',
        'levels_id',
        'classes_id',
        'groups_id',
        'shifts_id',
        'sections_id',
        'status',
    ];




    public function studentInfo() 
    {
        return $this->belongsTo(Students_info::class, 'students_info_id');
    }



    
    
}
