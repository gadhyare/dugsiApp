<?php

namespace App\Livewire\Admin\Exams;

use App\Models\FamilyNumber;
use App\Models\Students_info;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Url;

class StudentCurrentExamReport extends Component
{


    #[Url()]
    public $programs_id;

    public $familyNumberId;

    public function render()
    {
        $familyNumbers = FamilyNumber::where('active' , 1)->get();

        $students = Students_info::where('family_number_id' , '=' , $this->familyNumberId)->get();

        
        return view('livewire.admin.exams.student-current-exam-report'  , compact('familyNumbers' , 'students') );
    }
}
