<?php

namespace App\Imports;

use App\Livewire\Admin\StudentsInfo;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\CopyOfStudentSchoolInfo;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportCopyOfStudentSchoolInfo  implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        //$row[1], $row[2], $row[3], $new_family_number->id, $row[5], $row[6], $row[7],    $row[9]
        $data = new  CopyOfStudentSchoolInfo();


        $data->first_name =   $row[1]; //first_name;
        $data->middle_name =   $row[2]; //middle_name;
        $data->last_name =   $row[3]; //last_name;
        $data->sex =   $row[5]; //sex;
        $data->phone =   $row[6]; //phone;
        $data->blood_group =   $row[7]; //blood_group;


        $data->save();
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }




}
