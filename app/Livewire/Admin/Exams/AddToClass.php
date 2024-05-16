<?php

namespace App\Livewire\Admin\Exams;

use App\Imports\ExamsImport;
use App\Models\Exams;
use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use Livewire\Component;
use App\Models\Programs;
use App\Models\Sections;
use App\Models\Students;
use Livewire\Attributes\Url;
use App\Models\StudentsSchoolInfo;
use App\Exports\StudentsListExport;
use App\Models\SubjectsDistribution;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;


class AddToClass extends Component
{
    use WithFileUploads;
    public $subjects_distributions ;
    public $subjects_distributions_id;
    public $students_info_id;

    public $programs ;
  

    #[Url()]
    public $programs_id;
    public $qu1 = 0;
    public $ex1 = 0;
    public $qu2 = 0;
    public $ex2 = 0;
    public $att = 0;

    public $subjects_id;

    public $selectPrograms = null;
    public $updateId;

    public $btnTitle = "اضافة";

    public $search = '';
    public $message = '';

    public $per_page = 10;


    public $excelFile;

    public $number ;

    protected $rules = [
        'subjects_distributions_id' => 'required',
        'students_info_id' => 'required',
        'qu1' => 'required',
        'ex1' => 'required',
        'qu2' => 'required',
        'ex2' => 'required',
        'att' => 'required',
    ];





    public function render()
    {

        $this->subjects_distributions  = SubjectsDistribution::where('programs_id', "=" ,   $this->programs_id   )->get();


        $students = StudentsSchoolInfo::where('programs_id',"=", $this->programs_id)  ->get();


        $this->programs = Programs::where('id', "=",   $this->programs_id)->first();
        return view( 'livewire.admin.exams.add-to-class', compact('students'   ) );
    }


    public function exportToExcel(   )
    {
        return (new  StudentsListExport($this->levels_id, $this->classes_id, $this->groups_id, $this->shifts_id, $this->sections_id) )->download('list.xlsx' , \Maatwebsite\Excel\Excel::XLSX );
    }




    function getRec(){

            $path1 = $this->excelFile->store('temp');
            $path = storage_path('app') . '/' . $path1;
        if (!$this->checkIfExamIsInOrNot()) {
            Excel::import(new  ExamsImport($this->subjects_distributions_id, $this->programs_id), $path);
            $this->message = "تمت اضافة الاختبار بنجاح";
            $this->reset(['subjects_distributions_id', 'excelFile']);
        }
    }



    function checkIfExamIsInOrNot(){
        $exam = Exams::where('programs_id' , '=', $this->programs_id)
                            ->where('subjects_distributions_id' , '=' , $this->subjects_distributions_id)
                            ->get();

        if(count($exam) > 0){
            $this->message = "الاختبار موجود مسبقاً";
            $this->reset(['subjects_distributions_id' , 'excelFile' ]);
            return true;
        }else{
            $this->message =  '';
            return false;
        }
    }
}
