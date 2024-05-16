<?php

namespace App\Livewire\Admin\Exams;

use App\Models\Exams;
use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use App\Models\Programs;
use Livewire\Component;
use App\Models\Sections;
use App\Models\Subjects;
use App\Models\Students_info;
use App\Models\StudentsSchoolInfo;
use App\Models\SubjectsDistribution;
use Livewire\Attributes\Url;

class StudentExam extends Component
{


    public $subjects;
    public $programs;
   
    public $subjects_id;

    #[Url()]
    public $programs_id;


    public $subjects_distributions_id;
    public $students_info_id;
    public $qu1 = 0;
    public $ex1 = 0;
    public $qu2 = 0;
    public $ex2 = 0;
    public $att = 0;

    public $total;


    public $updateId;

    public $active  = false;

    public $message_error = '';
    public $message_success = '';

    protected $rules = [
        'subjects_distributions_id' => 'required',
        'students_info_id' => 'required',
        'programs_id' => 'required',
        'qu1' => 'required',
        'ex1' => 'required',
        'qu2' => 'required',
        'ex2' => 'required',
        'att' => 'required',
    ];




    public function render()
    {
        $this->programs = Programs::where('status',  "=" , $this->programs_id)->get();

        $subjects_distributions  = SubjectsDistribution::where('programs_id',"=", $this->programs_id)->get();

        $students = StudentsSchoolInfo::where('programs_id', "=", $this->programs_id)->get();
        return view('livewire.admin.exams.student-exam' , compact('subjects_distributions'  , 'students') );

    }

    public function updated()
    {
        $this->total = (int)  $this->qu1 + (int) $this->ex1 + (int) $this->qu2 + (int) $this->ex2   + (int) $this->att;
    }

    public function add_new_exam_for_student()
    {
        //$this->validate();


        $data = [
            'students_info_id' => $this->students_info_id,
            'programs_id' => $this->programs_id,
            'subjects_distributions_id' => $this->subjects_distributions_id,
            'qu1' => $this->qu1,
            'ex1' => $this->ex1,
            'qu2' => $this->qu2,
            'ex2' => $this->ex2,
            'att' => $this->att,
        ];

        if($this->checkIfExamIsIn()){
            $this->message_error = "عفوا هذه البيانات موجودة مسبقاً";
            $this->message_success = "";
        }else{
            $this->message_error = "";
            Exams::create($data);
            $this->message_success = "تمت الاضافة بنجاح";
        }


    }



    public function checkIfExamIsIn( ){

        $examToCheck = Exams::where('students_info_id', '=' , $this->students_info_id)->where('subjects_distributions_id',   '=' ,  $this->subjects_distributions_id)->first();


        if($examToCheck ){
            return true ;
        }else{
            return false ;
        }
    }




    public function getDate()
    {
        $exam = Exams::where('students_info_id', '=' , $this->students_info_id)->where('subjects_distributions_id',   '=' ,  $this->subjects_distributions_id)->first();


            $this->students_info_id     =  $exam->students_info_id;
            $this->programs_id            =  $exam->programs_id;
            $this->subjects_distributions_id  =  $exam->subjects_distributions_id;
            $this->qu1                  =  $exam->qu1;
            $this->ex1                  =  $exam->ex1;
            $this->qu2                  =  $exam->qu2;
            $this->ex2                  =  $exam->ex2;
            $this->att                  =  $exam->att;


            $this->updateId = $exam->id;
    }

}
