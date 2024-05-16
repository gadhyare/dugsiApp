<?php

namespace App\Livewire\Admin\Students;


use Carbon\Carbon;


use Livewire\Component;

use Livewire\Attributes\Url;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use App\Models\StudentsAttendance;
use App\Models\StudentsSchoolInfo;
use Illuminate\Support\Facades\DB;

class AttendanceReport extends Component
{
    #[Url()]
    #[Rule('required')]
    public $programs_id;


    #[Rule('required')]
    public $att_date;

    public $students_info_id = [];


    public $students = [];
    public $attedances = [];









    #[Layout('admin.layouts.for-livewire')]
    public function render()
    {

        $studentsInfos = StudentsSchoolInfo::with('studentInfo')->where('programs_id', '=', $this->programs_id)->get();
        if ($this->programs_id != null && $this->att_date && $this->att_date  != null) :
            $xuduurs = StudentsAttendance::where('programs_id', '=', $this->programs_id)->whereMonth('att_date', '=', date('m', strtotime($this->att_date)))->get();
            $data_range = StudentsAttendance::query()->select(DB::raw('att_date'))->where('programs_id', '=', $this->programs_id)
                ->groupBy('att_date')->whereMonth('att_date', '=', date('m', strtotime($this->att_date)))->get();
        else :
            $xuduurs = [];
            $data_range = [];
        endif;

        return view('livewire.admin.students.attendance-report', compact('studentsInfos', 'xuduurs', 'data_range'));
    }
}
