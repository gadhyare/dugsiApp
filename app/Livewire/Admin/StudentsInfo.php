<?php

namespace App\Livewire\Admin;

use App\Models\Fathers;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Students_info as Students_infoModel;

class StudentsInfo extends Component
{

    use WithPagination;
 
    use WithFileUploads;
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
    public $address;
    public $city;
    public $phone;
    public $photo;
    public $registration_date;


    public $updateId;

    public $btnTitle = "اضافة";



    protected $rules = [
        'first_name' => 'required',
        'middle_name' => 'required',
        'last_name' => 'required',
        'family_name' => 'required',
        'fnumber_id' => 'required',
        'mother' => 'required',
        'gender' => 'required',
        'date_of_birth' => 'required',
        'place_of_birth' => 'required',
        'nationality' => 'required',
        'address' => 'required',
        'city' => 'required',
        'phone' => 'required',
        'registration_date' => 'required',
        'photo' => 'image|max:1024'
    ];


    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public $numberOfPaginatorsRendered;

    public $per_page = 10;

    #[Layout('admin.layouts.loged-master')]
    public function render()
    {
       
        $searchText = $this->search;
        $students = Students_infoModel::whereHas('family_number', function ($query) use ($searchText) {
            $query->where('fnumber', 'LIKE', "%" . $searchText . "%");
        })->orWhere(DB::raw("concat(first_name , ' '  ,middle_name , ' ' , last_name)"), 'LIKE', "%" . $this->search . "%")
            ->paginate($this->per_page);


        return view('livewire.admin.students-info', ['students' => $students]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function add()
    {
        $this->validate();
        $fileName = time() . '.' . $this->photo->extension();
        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            Students_infoModel::create([
                'first_name' => $this->first_name,
                'fnumber_id' => $this->fnumber_id,
                'mother' => $this->mother,
                'gender' => $this->gender,
                'date_of_birth' => $this->date_of_birth ?? null,
                'place_of_birth' => $this->place_of_birth,
                'nationality' => $this->nationality,
                'address' => $this->address,
                'city' => $this->city,
                'phone' => $this->phone,
                'photo' => $fileName,
                'registration_date' => $this->registration_date ?? date('Y-m-d'),
            ]);


            $path = public_path('images/');
            !is_dir($path) &&
                mkdir($path, 0777, true);
            $this->photo->move(public_path('images/students'),  $fileName);
            return redirect(route('students.info'))->with('status', 'تمت الاضافة بنجاح');
        }
        $this->reset();
    }


    public function updateRec($id)
    {

        $students = Students_infoModel::where('id',  '=', $id)->first();
        $this->first_name = $students->first_name;
        $this->fnumber_id = $students->fnumber_id;
        $this->mother = $students->mother;
        $this->gender = $students->gender;
        $this->date_of_birth = $students->date_of_birth;
        $this->place_of_birth = $students->place_of_birth;
        $this->nationality = $students->nationality;
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
        $students->fnumber_id = $this->fnumber_id;
        $students->mother = $this->mother;
        $students->gender = $this->gender;
        $students->date_of_birth = $this->date_of_birth;
        $students->place_of_birth = $this->place_of_birth;
        $students->nationality = $this->nationality;
        $students->address = $this->address;
        $students->city = $this->city;
        $students->phone = $this->phone;
        $students->photo = $this->photo;
        $students->registration_date = $this->registration_date;
        $students->update();
        $this->btnTitle = "اضافة";
        $this->reset();
        return redirect(route('students.info'))->with('status', 'تمت التعديل بنجاح');
    }

    public function deleteRec($id)
    {
        $students = Students_infoModel::where('id',  '=', $id)->first();
        $students->delete();
        $this->reset();
        return redirect(route('students.info'))->with('status', 'تمت الحذف بنجاح');
    }



    public function cancel()
    {
        $this->reset('search');
    }
}
