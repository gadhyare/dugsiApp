<?php

namespace App\Livewire\Admin\Students;

use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\StudentsAttendance;
use App\Models\Xuduur;
use App\Models\Classes;
use Livewire\Component;
 
use App\Models\Sections;
use Livewire\Attributes\Url;
use App\Models\Students_info;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use App\Models\StudentsSchoolInfo;

class Attendance extends Component
{

    
  
    public $students_info_id= [] ;

    #[Url()]
    #[Rule('required')]
    public $programs_id;

    
    #[Rule('required')]
    public $att_date;
  
  
    public $students = [];
    

    
 


    #[Layout('admin.layouts.for-livewire')]
    public function render()
    {
        

      
            $this->students = StudentsSchoolInfo::where('active', '=', 1)
                                                                ->where('programs_id', "=", $this->programs_id) 
                                                                ->get();

       
        return view('livewire.admin.students.attendance' );
    }


    public function add()
    {
        
        $this->validate();
       
        $selectStudents = $this->students_info_id;


        $select_students = StudentsSchoolInfo::where('active', '=', 1)
                            ->where('programs_id', "=", $this->programs_id) 
                            ->get();

        foreach ($select_students as $item){
            $attendance = new StudentsAttendance;
            $attendance->students_info_id = $item->students_info_id;
            $attendance->programs_id = $this->programs_id;
            $attendance->att_date = $this->att_date;
            $attendance->status =  (in_array($item->students_info_id, $selectStudents)) ? 1 : 0;
            $attendance->save();
        }
    }


    public function getInfo(){
        return  StudentsSchoolInfo::where('programs_id', $this->programs_id) 
        ->get();
    }



    public function itus(){
        dd($this->students_info_id);
    }
}
