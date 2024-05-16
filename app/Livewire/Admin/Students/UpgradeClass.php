<?php

namespace App\Livewire\Admin\Students;

use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use Livewire\Component;
use App\Models\Programs;
use App\Models\Sections;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use App\Models\StudentsSchoolInfo;




#[Layout('admin.layouts.for-livewire')]
class UpgradeClass extends Component
{
    use WithPagination;
    public $levels;
    public $shifts;
    public $sections;
    public $classes;
    public $groups;





    #[Rule('required')]
    public $levels_id;
    #[Rule('required')]
    public $classes_id;
    #[Rule('required')]
    public $groups_id;
    #[Rule('required')]
    public $shifts_id;
    #[Rule('required')]
    public $sections_id;
    #[Rule('required')]
    public $status = 1;


    public $levels_message;
    public $classes_message;
    public $groups_message;
    public $shifts_message;
    public $sections_message;





    #[Url()]
    public $programs_id;
    public $per_page = 10;
    protected $rules = [
        'levels_id' => 'required',
        'classes_id' => 'required',
        'groups_id' => 'required',
        'shifts_id' => 'required',
        'sections_id' => 'required',
    ];

    #[Layout('admin.layouts.loged-master')]
    public function render()
    {

        $this->levels = Levels::where('active', '=', '1')->get();
        $this->shifts = Shifts::where('active', '=', '1')->get();
        $this->sections = Sections::where('active', '=', '1')->get();
        $this->groups = Groups::where('active', '=', '1')->get();
        $this->classes = Classes::where('active', '=', '1')->get();


        $students = StudentsSchoolInfo::where('programs_id', '=', $this->programs_id)
            ->paginate($this->per_page);


        return view('livewire.admin.students.upgrade-class', compact('students'));
    }


    public function upgrade()
    {
        $this->validate();
        $old_programs = Programs::where('id', '=', $this->programs_id)->first();


        $programs = Programs::where('levels_id', '=', $this->levels_id)
            ->where('classes_id', '=', $this->classes_id)
            ->where('groups_id', '=', $this->groups_id)
            ->where('shifts_id', '=', $this->shifts_id)
            ->where('sections_id', '=', $this->sections_id)
            ->first();

        $students = StudentsSchoolInfo::where('programs_id', '=', $this->programs_id);

        if (!$programs && $programs->status == 1) {
            $id = Programs::create($this->validate())->id; 
            if ($id) {

                foreach ($students as $student) {

                    StudentsSchoolInfo::create([
                        'students_info_id' => $student->students_info_id,
                        'programs_id' => $id,
                        'registered_date' => $student->registered_date,
                        'discount' => $student->discount,
                        'active' => $student->active,
                    ]); 

                    
                }


                $old_programs->update([
                    'status' => 2
                ]);
            }

            
        }
    }
}
