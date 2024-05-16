<?php

namespace App\Livewire\Admin\Students;

use App\Models\Fathers;
use Livewire\Component;
use App\Models\FamilyNumber;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Students_info as Students_infoModel;

class Register extends Component
{
    use WithPagination;
    use WithFileUploads;


    #[Url()]
    public $family_number;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $family_name;
    public $fnumber_id;
    public $mother;
    public $gender = "ذكر";
    public $date_of_birth;
    public $place_of_birth;
    public $nationality;
    public $blood_group;

    public $address;
    public $city;
    public $phone;
    public $photo;
    public $registration_date;
    public $familyInfo;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'first_name' => 'required',
        'middle_name' => 'required',
        'last_name' => 'required', 
        'mother' => 'required',
        'gender' => 'required',
        'date_of_birth' => 'required',
        'place_of_birth' => 'required',
        'nationality' => 'required',
        'blood_group' => 'required',
        'address' => 'required',
        'city' => 'required',
        'phone' => 'required',
        'registration_date' => 'required',
        'photo' => 'required'
    ];


    public function mount()
    {
        if($this->family_number){
           
            $this->familyInfo  = FamilyNumber::where('id', $this->family_number)->first();
        }else{
            return redirect()->route('fnumber.index');
        }
        
    }


    public function render()
    {
        $students = Students_infoModel::where('family_number_id', $this->fnumber_id)->paginate( $this->per_page );
        return view('livewire.admin.students.register' , ['students' => $students] );
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function add()
    {

        $this->validate();

        $fileName = time() . '.' . $this->photo->extension();

        //$this->photo->getClientOriginalName(); ;


        if ($this->updateId) {

            $this->DoupdateRec($this->updateId);


        } else {
            Students_infoModel::create([
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'family_number_id' => $this->familyInfo->id, 
                'mother' => $this->mother,
                'sex' => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                'place_of_birth' => $this->place_of_birth,
                'nationality' => $this->nationality, 
                'address' => $this->address,
                'city' => $this->city,
                'phone' => $this->phone,
                'photo' => $fileName,
                'blood_group' => $this->blood_group,
                'registration_date' => $this->registration_date,
            ]);


            // $path = public_path('images/');
            // !is_dir($path) &&
            //     mkdir($path, 0777, true);


            
            $this->photo->storeAs(path: 'public/uploads/images/students', name: $fileName);
            return redirect(route('students.register'  , $this->fnumber_id ))->with('status', 'تمت الاضافة بنجاح');
        }

        $this->reset();
    }


    public function updateRec($id)
    {

        $students = Students_infoModel::where('id',  '=', $id)->first();

        $this->first_name = $students->first_name;
        $this->middle_name = $students->middle_name;
        $this->last_name = $students->last_name;
        $this->family_name = $students->family_name;
        $this->fnumber_id = $students->fnumber_id;
        $this->mother = $students->mother;
        $this->gender = $students->gender;
        $this->date_of_birth = $students->date_of_birth;
        $this->place_of_birth = $students->place_of_birth;
        $this->nationality = $students->nationality;
        $this->blood_group = $students->blood_group;
        $this->address = $students->address;
        $this->city = $students->city;
        $this->phone = $students->phone;
        $this->photo = $students->photo;
        $this->registration_date = $students->registration_date;

        $this->updateId = $students->id;
        $this->btnTitle = "تعديل";

    }


    public function DoupdateRec($id)
    {

        $students = Students_infoModel::where('id', '=', $id)->first();

        $students->first_name = $this->first_name;
        $students->middle_name = $this->middle_name;
        $students->last_name = $this->last_name;
        $students->family_name = $this->family_name;
        $students->fnumber_id = $this->fnumber_id;
        $students->mother = $this->mother;
        $students->gender = $this->gender;
        $students->date_of_birth = $this->date_of_birth;
        $students->place_of_birth = $this->place_of_birth;
        $students->nationality = $this->nationality;
        $students->blood_group = $this->blood_group;
        $students->address = $this->address;
        $students->city = $this->city;
        $students->phone = $this->phone;
        $students->photo = $this->photo;
        $students->registration_date = $this->registration_date;


        $students->update();

        $this->btnTitle = "اضافة";
        $this->reset();
        // $this->dispatchBrowserEvent('hide-modal');
        return redirect(route('students.register' ,  request('stu_id') ))->with('status', 'تمت التعديل بنجاح');
    }

    public function deleteRec($id)
    {


        $students = Students_infoModel::where('id',  '=', $id)->first();

        $students->delete();

        // $this->dispatchBrowserEvent('hide-modal');

        $this->reset();
        return redirect(route('students.register' ,  request('stu_id') ))->with('status', 'تمت الحذف بنجاح');
    }

}
