<?php

namespace App\Livewire\Admin\Exams;

use App\Models\Exams;
use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use Livewire\Component;
use App\Models\Sections;
use App\Models\Students;
use App\Models\StudentsSchoolInfo;
use App\Exports\StudentsListExport;
use App\Models\Programs;
use App\Models\SubjectsDistribution;

class StudentExamReport extends Component
{

    public $subjects_distributions_id;
    public $students_info_id;
    public $programs;
    public $programs_id;
    public $groups_id;
    public $qu1 = 0;
    public $ex1 = 0;
    public $qu2 = 0;
    public $ex2 = 0;
    public $att = 0; 
    public $subjects_id;

    public $total = 0;

    public $updateId;

    public $btnTitle = "اضافة";

    public $search = '';

    public $name;
    public $msg;
    public $per_page = 10;
    protected $rules = [
        'qu1' => 'required',
        'ex1' => 'required',
        'qu2' => 'required',
        'ex2' => 'required',
        'att' => 'required',
    ];



    public function mount()
    {
        $this->programs = Programs::where('status',     1)->get();
      

    }

    public function render()
    {

        
        $subjects_distributions  = SubjectsDistribution::where('programs_id',    $this->programs_id) ->get();



        $students = StudentsSchoolInfo::where('programs_id', $this->programs_id) ->first();


                $exams = Exams::where('students_info_id', $this->students_info_id )
                                ->where('programs_id' , '=' , $this->programs_id ) ->get();



        return view(
            'livewire.admin.exams.student-exam-report',
            [
               
                'subjects_distributions' => $subjects_distributions, 
                'students' => $students,
                'exams' => $exams,
            ]
        );
    }


    public function get_data_to_update($rec_id)
    {
        $this->updateId = $rec_id;




        $info =  Exams::where('id', '=', $this->updateId)->first();


        $this->qu1 = $info->qu1;
        $this->ex1 = $info->ex1;
        $this->qu2 = $info->qu2;
        $this->ex2 = $info->ex2;
        $this->att = $info->att;

        $this->total = (int) $this->qu1 + (int)  $this->ex1 + (int)  $this->qu2 + (int)  $this->ex2 + (int)  $this->att;
    }

    public function exportToExcel()
    {
        return (new  StudentsListExport($this->levels_id, $this->classes_id, $this->groups_id, $this->shifts_id, $this->sections_id))->download('list.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }




    public function resetData()
    {
        $this->reset(['updateId']);
    }



    public function getTotal()
    {
        $this->total = (int) $this->qu1 + (int)  $this->ex1 + (int)  $this->qu2 + (int)  $this->ex2 + (int)  $this->att;
    }


    public function updateRec($rec_id)
    {

        $this->validate();

        $info =  Exams::where('id', '=', $this->updateId)->first();


        if ($info) {
            $info->qu1 = $this->qu1;
            $info->ex1 = $this->ex1;
            $info->qu2 = $this->qu2;
            $info->ex2 = $this->ex2;
            $info->att = $this->att;

            $info->update();


            $this->reset(['updateId']);
        }
    }
}
