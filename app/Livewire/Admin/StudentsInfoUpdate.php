<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Students_info;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class StudentsInfoUpdate extends Component
{

    use WithFileUploads;
    #[Url()]
    public $students; 
    #[Rule('required')]
    public $first_name;
    #[Rule('required')]
    public $middle_name;
    #[Rule('required')]
    public $last_name; 
    public $mother;
    public $sex = "ذكر";
    public $date_of_birth;
    public $place_of_birth;
    public $nationality;
    public $blood_group;

    public $address;
    public $city;
    #[Rule('required')]
    public $phone;
    public $photo;
    public $registration_date;
    public $familyInfo;


    public $updateId;
    public function mount(Students_info $student){
        $student = Students_info::find($this->students);

        $this->first_name = $student->first_name;
        $this->middle_name = $student->middle_name;
        $this->last_name = $student->last_name;
        $this->mother = $student->mother;
        $this->sex = $student->sex;
        $this->date_of_birth = $student->date_of_birth;
        $this->place_of_birth = $student->place_of_birth;
        $this->nationality = $student->nationality;
        $this->address = $student->address;
        $this->blood_group = $student->blood_group;
        $this->city = $student->city;
        $this->phone = $student->phone;
        $this->registration_date = $student->registration_date;
    }

    public function render(   )
    {
        $student = Students_info::find($this->students);
        
        return view('livewire.admin.students-info-update'  , compact('student')  );
    }




    public function update_student_info(){
        $this->validate();
        $student = Students_info::find($this->students);


        
        $fileName =    $this->photo->getClientOriginalName();
       


        $student->first_name = $this->first_name;
        $student->middle_name = $this->middle_name;
        $student->last_name = $this->last_name;
        $student->mother = $this->mother;
        $student->sex = $this->sex;
        $student->date_of_birth = $this->date_of_birth;
        $student->place_of_birth = $this->place_of_birth;
        $student->nationality = $this->nationality;
        $student->address = $this->address;
        $student->blood_group = $this->blood_group;
        $student->city = $this->city;
        $student->phone = $this->phone;
        $student->photo = $fileName;
        
        $student->registration_date = $this->registration_date;
        if ($student->update()) {
            $this->photo->storeAs('public/uploads' , $fileName   );
             $this->dispatch('success-opration'); 
        } 
    }


     

}
