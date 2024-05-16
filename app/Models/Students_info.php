<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Strurel;
use App\Models\FamilyNumber;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students_info extends Model
{
    use HasFactory;

    protected $table = "students_info";

    protected $primaryKey = 'id';
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'family_number_id',
        'mother',
        'sex',
        'date_of_birth',
        'place_of_birth',
        'nationality',
        'address',
        'city',
        'phone',
        'photo',
        'blood_group',
        'registration_date' 
    ];


 
                  


    public function name()
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
    

    public function student_number()
    {
        return $this->family_number->fnumber . '-' . $this->id;
    }



    public function studentId()
    {
        return $this->id  ;
    }



    public function age(){
        return Carbon::parse($this->date_of_birth)->age() ;
    }

    public function scopeNameSearch($query ,$value){
        $info =  $query->select(DB::raw("CONCAT('first_name',  'middle_name',  'last_name') AS display_name"), 'id' , 'family_number_id')->get()->pluck('display_name', 'id' , 'family_number_id');
        $info->where('display_name' , 'LIKE', '%' . $value . '%');
    }


    public function scopeSearch($query, $value )
    {

        $query->select(   DB::raw("CONCAT('first_name', ' ', 'middle_name',   ' ', 'last_name') AS display_name") , 'sex', 'id'  , 'phone', 'city', 'photo')
         ->having('display_name', 'LIKE', "%$value%")  ;
    
    }

    public function family_number( )
    {

        return $this->belongsTo(FamilyNumber::class  , 'family_number_id' , 'id');
    }


  
    public function levels()
    {
        return $this->belongsTo(Levels::class);
    }


    public function Strurel()
    {
        $this->hasMany(Strurel::class);

    }

    public function attendance(): BelongsTo
    {
        return  $this->belongsTo(StudentsAttendance::class );
    }

    public function students_helth_record()
    {
        $this->hasMany(StudentHelthRecord::class);
    }

    public function exams()
    {
        $this->hasMany(Exams::class);

    }


    public function getFamilyNumber(){
        return $this->family_number->fnumber;
    }


    public function student_school_info()
    {
        return $this->hasMany(StudentsSchoolInfo::class, 'students_info_id' );
    }

    public function invoices()
    {
        return $this->hasMany(Invoices::class  , 'students_info_id' , 'id'  );
    }


    public function xuduur()
    {
        return $this->hasMany(Xuduur::class, 'students_info_id');
    }






}
