<?php

namespace App\Livewire\Admin\Students;

use App\Models\Settings;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use App\Models\StudentsAttendance;
use App\Models\StudentsSchoolInfo;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class AttendancePrintReport extends Component
{
    #[Url()]
    public $programs_id;
    #[Url()]
    public $att_date;

    public $students_info_id = [];


    public $students = [];
    public $attedances = [];



    #[Layout('admin.layouts.loged-master-no-header')]
    public function render()
    {
        $studentsInfos = StudentsSchoolInfo::with('studentInfo')->where('programs_id', '=', $this->programs_id)->get();
        if ($this->programs_id != null && $this->att_date && $this->att_date  != null) :
            $xuduurs = StudentsAttendance::where('programs_id', '=', $this->programs_id)->whereMonth('att_date', '=', date('m', strtotime($this->att_date)))->get();
            $data_range = StudentsAttendance::query()->select(DB::raw('att_date'))->where('programs_id', '=', $this->programs_id)
                ->groupBy('att_date')->whereMonth('att_date', '=', date('m', strtotime($this->att_date)))->get();
        else :
            $xuduurs = [];
            // $data_range = [];
        endif;




        $setting = Settings::first();


 

        // $pdf = Pdf::loadView('livewire.admin.students.attendance-print-report', compact('studentsInfos', 'xuduurs', 'data_range', 'setting', 'hedaer_logo'));
        return  view('livewire.admin.students.attendance-print-report', compact('studentsInfos', 'xuduurs', 'data_range' , 'setting'  ));
        // return $pdf->download('invoice.pdf');
    }
}
