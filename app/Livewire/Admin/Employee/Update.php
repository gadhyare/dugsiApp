<?php

namespace App\Livewire\Admin\Employee;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\EmployeesInfo as EmployeesInfoModel;
class Update extends Component
{

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
        public $ids;

        public $btnTitle = "اضافة";


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



        public function mount()
        {
            $this->ids = request('id');
            $emplooye_info = EmployeesInfoModel::where('id',   $this->ids)->first();
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


        }

        public function render( )
        {


            return view('livewire.admin.employee.update'   );
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


        public function update( )
        {

            $this->validate();

            $emplooye_info = EmployeesInfoModel::where('id',   $this->ids)->first();

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

}
