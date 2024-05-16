<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentsAttendance extends Model
{
    use HasFactory;

    protected $table = "students_attendances";
    protected $fillable = [
        'students_info_id',
        'programs_id',
        'status',
        'att_date'
    ];



    // protected $casts = [
    //     'created_at'  => 'date:Y-m-d'
    // ];





    public function studentInfo(): HasMany
    {
        return $this->hasMany(Students_info::class );
    }





    public function Att_status( ){
        if($this->status == 1){
            $info_status = 'ح';
        }else{
            $info_status = 'غ';
        }

        return $info_status;
    }




}
