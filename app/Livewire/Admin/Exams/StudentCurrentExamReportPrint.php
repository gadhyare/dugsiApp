<?php

namespace App\Livewire\Admin\Exams;

use App\Models\Exams;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Students_info;
use Livewire\Attributes\Layout;

class StudentCurrentExamReportPrint extends Component
{


    #[Url()]
    public $students_info_id;
    #[Url()]
    public $programs_id;
    #[Layout('admin.layouts.loged-master-no-header-for-livewire')]
    public function render()
    {

        $student = Students_info::where('id' , '=' , $this->students_info_id)->first();


        $exams = Exams::where('programs_id', '=', $this->programs_id  )->where('students_info_id', '=', $this->students_info_id  )
            ->get();

        return view('livewire.admin.exams.student-current-exam-report-print' , compact('student' , 'exams'));
    }
}
