<?php

namespace App\Imports;


use App\Models\FamilyNumber;
use App\Models\Students_info;
use App\Models\StudentsSchoolInfo;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithStartRow;


class StudentsInfoImport implements ToModel , WithStartRow
{
    public $programs_id ;
    private $rows = 0;
    public function  __construct($programs_id  )
    {
        $this->programs_id  = $programs_id ;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        ++$this->rows;

        $new_family_number = new FamilyNumber();
        if ($row[4] != null) {
            $family_number = FamilyNumber::where('fnumber', '=',   $row[4])->first();
            if (!$family_number) {
                $new_family_number->fnumber = $row[4];
                $new_family_number->active  = 1;
                if($new_family_number->save() ){
                    if(! $this->ceckIfIsDataIn($row[1], $row[2], $row[3],$row[6])){
                        $this->registerNewStudents($row[1], $row[2], $row[3], $new_family_number->id, $row[5], $row[6], $row[7],    $row[9]);
                    }
                }
            }else{
                if(! $this->ceckIfIsDataIn($row[1], $row[2], $row[3],$row[6])){
                    $this->registerNewStudents($row[1], $row[2], $row[3], $family_number->id, $row[5], $row[6], $row[7],   $row[9]);
                }
            }
        }
    }


    public function registerNewStudents($first_name, $middle_name, $last_name, $new_family_number, $sex, $phone,$blood_group,  $discount){
        $student = new Students_info();
        $student->first_name = $first_name;
        $student->middle_name = $middle_name;
        $student->last_name = $last_name;
        $student->family_number_id = $new_family_number;
        $student->sex = $sex;
        $student->phone = $phone;
        $student->blood_group = $blood_group;
        if ($student->save()) {
            $this->student_school_info($student->id,    $discount);
        }
    }

    public function student_school_info($id,     $discount)
    {
        $data  = new StudentsSchoolInfo();
        $data->students_info_id = $id;
        $data->programs_id = $this->programs_id;
        $data->discount = $discount;
        $data->active =  1;
        if($data->save()){
            // session('success', 'تم الرقع بنجاح');
            // return redirect()->route('student.upload.list' , 'pro_id=' . $this->programs_id) ;

            return true ;
        }
    }



        /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }


    public function getRowCount(): int
    {
        return $this->rows;
    }

    protected function ceckIfIsDataIn($first_name,$middle_name,$last_name,$phone)
    {
        $data = Students_info::where('first_name', '=', $first_name)
            ->where('middle_name', '=', $middle_name)
            ->where('last_name', '=', $last_name)
            ->where('phone', '=', $phone)->first();

        if ($data) {
            return true; //data is in
        }
    }

}
