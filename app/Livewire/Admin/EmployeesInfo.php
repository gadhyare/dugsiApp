<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Students_info;
use Livewire\WithFileUploads;
use App\Models\EmployeesInfo as EmployeesInfoModel;



class EmployeesInfo extends Component
{


    use WithPagination;
    use WithFileUploads;
    public $name ;
    public $gender = 1 ;
    public $date_of_birth ;
    public $place_of_birth ;
    public $nationality ;
    public $address ;
    public $register_date ;
    public $photo ;
    public $note ;

    public $email = "email@example.com";
    public $phones = "002526";
    public $is_subscribed = 1;
    public $active = 1;

    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'name' => 'required',
        'gender' => 'required',
        'date_of_birth' => 'required',
        'place_of_birth' => 'required',
        'nationality' => 'required',
        'register_date' => 'required',
        'address' => 'required',
        'email' => 'required',
        'phones' => 'required',
        'is_subscribed' => 'required',
        'note' => 'required',
        'active' => 'required',
        'photo' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';
    public function render( )
    {
        $emplooye_info = EmployeesInfoModel::where('name', 'like', '%' . $this->search . '%')->paginate($this->per_page);


        return view('livewire.admin.employees-info', ['emplooye_info' => $emplooye_info   ]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function add()
    {

        $this->validate();

        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            EmployeesInfoModel::create([
                'name' => $this->name,
                'gender' => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                'place_of_birth' => $this->place_of_birth,
                'nationality' => $this->nationality,
                'address' => $this->address,
                'phones' => $this->phones,
                'email' => $this->email,
                'register_date' => $this->register_date,
                'photo' => $this->photo,
                'note' => $this->note,
                'is_subscribed' => $this->is_subscribed,
                'active' => $this->active,
            ]);

            return redirect(route('employees.info' ))->with('status', 'تمت الاضافة بنجاح');
        }

        $this->reset();
    }


    public function updateRec($id)
    {

        $emplooye_info = EmployeesInfoModel::where('id',   $id)->first();

        $this->name = $emplooye_info->name;
        $this->gender = $emplooye_info->gender;
        $this->date_of_birth = $emplooye_info->date_of_birth;
        $this->place_of_birth = $emplooye_info->place_of_birth;
        $this->nationality = $emplooye_info->nationality;
        $this->address = $emplooye_info->address;
        $this->phones = $emplooye_info->phones;
        $this->email = $emplooye_info->email;
        $this->register_date = $emplooye_info->register_date;
        $this->photo = $emplooye_info->photo;
        $this->note = $emplooye_info->note;
        $this->is_subscribed = $emplooye_info->is_subscribed;
        $this->active = $emplooye_info->active;

        $this->updateId = $emplooye_info->id;


        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {

        $emplooye_info = EmployeesInfoModel::where('id', '=', $id)->first();

        $emplooye_info->name = $this->name;
        $emplooye_info->gender = $this->gender;
        $emplooye_info->date_of_birth = $this->date_of_birth;
        $emplooye_info->place_of_birth = $this->place_of_birth;
        $emplooye_info->nationality = $this->nationality;
        $emplooye_info->address = $this->address;
        $emplooye_info->phones = $this->phones;
        $emplooye_info->email = $this->email;
        $emplooye_info->register_date = $this->register_date;
        $emplooye_info->photo = $this->photo;
        $emplooye_info->note = $this->note;
        $emplooye_info->is_subscribed = $this->is_subscribed;
        $emplooye_info->active = $this->active;

        $emplooye_info->update();

        $this->btnTitle = "اضافة";

        $this->reset();
        // $this->dispatchBrowserEvent('hide-modal');
        return redirect(route('employees.info' ))->with('status', 'تمت التعديل بنجاح');
    }

    public function deleteRec($id)
    {
        EmployeesInfoModel::where('id', '=', $id)->first()->delete();
        return redirect(route('employees.info' ))->with('status', 'تمت الحذف بنجاح');
    }









}
