<?php

namespace App\Imports;

use App\Models\Exams;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExamsImport implements ToModel, WithStartRow
{


    public $subjects_distributions_id;
    public $pro_id;

    public function __construct($subjects_distributions_id, $pro_id){
        $this->subjects_distributions_id = $subjects_distributions_id;
        $this->pro_id = $pro_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Exams([
            'students_info_id' => $row[1],
            'programs_id' => $this->pro_id,
            'subjects_distributions_id' => $this->subjects_distributions_id,
            'qu1' => $row[2],
            'ex1' => $row[3],
            'qu2' => $row[4],
            'ex2' => $row[5],
            'att' => $row[6],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
