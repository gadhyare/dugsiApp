<?php

namespace App\Livewire\Admin\Students;

use App\Models\Groups;
use App\Models\Levels;
use App\Models\Programs;
use App\Models\Shifts;
use App\Models\Classes;
use Livewire\Component;
use App\Models\Sections;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\StudentsSchoolInfo;
use Illuminate\Support\Facades\DB;
use App\Exports\StudentsListExport;

class StudentsList extends Component
{

    use WithPagination;

    #[Url()]
    public $programs_id;
    public $per_page = 10;



    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'programs_id' => 'required',
    ];

   
    public function render()
    {
        $programs = Programs::where('id', '=', $this->programs_id)->first();
        $students = StudentsSchoolInfo::where('programs_id', "=" ,$this->programs_id)->get();
        return view('livewire.admin.students.students-list', ['students' => $students , "programs" => $programs]);
    }


    public function add()
    {
        $this->validate();
    }


    public function exportData()
    {
        $this->validate();

        return (new StudentsListExport($this->programs_id ))
            ->download('ss.xlsx');
    }


    public function updateDate()
    {
        $this->validate();

        $data = DB::table('students_school_info')

        ->select('students_info.id','students_info.name'  )

        ->join('students_info','students_info.id','=','students_school_info.students_info_id')

        ->get();
    }
}
