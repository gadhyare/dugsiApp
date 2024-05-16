<?php

namespace App\Livewire\Admin;


use Livewire\Component;
use App\Models\Students_info;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Strurel as StrurelModel;


class Strurel extends Component
{


        use WithPagination;
        public $students_info_id;
        public $name ;

        public $rel_type  = 8;
        public $rel_lev  = 4;
        public $address;
        public $email = "email@example.com";
        public $phones = "002526";
        public $is_subscribe = 2;
        public $active = 1;

        public $updateId;

        public $btnTitle = "اضافة";


        public $search = '';

        public $per_page = 10;
        protected $rules = [
            'students_info_id' => 'required',
            'name' => 'required',
            'rel_type' => 'required',
            'rel_lev' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phones' => 'required',
            'is_subscribe' => 'required',
            'active' => 'required',
        ];


        protected $paginationTheme = 'bootstrap';
        public function render(Request $request)
        {
            $strurels = StrurelModel::where('name', 'like', '%' . $this->search . '%')->paginate($this->per_page);

            $ids = $request->route('id');
            $getStudent =Students_info::where('id' ,    $ids)->first();

            $this->students_info_id = $ids;

            return view('livewire.admin.strurel', ['strurels' => $strurels , 'ids' => $ids , 'getStudent' => $getStudent ]);
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
                StrurelModel::create([
                    'students_info_id' => $this->students_info_id,
                    'name' => $this->name,
                    'rel_type' => $this->rel_type,
                    'rel_lev' => $this->rel_lev,
                    'address' => $this->address,
                    'email' => $this->email,
                    'phones' => $this->phones,
                    'is_subscribe' => $this->is_subscribe,
                    'active' => $this->active,
                ]);

                return redirect(route('strurel.index' , $this->students_info_id))->with('status', 'تمت الاضافة بنجاح');
            }

            $this->reset();
        }


        public function updateRec($id)
        {

            $strurel = StrurelModel::where('id',   $id)->first();

            $this->students_info_id = $strurel->students_info_id;
            $this->name = $strurel->name;
            $this->rel_type = $strurel->rel_type;
            $this->rel_lev = $strurel->rel_lev;
            $this->address = $strurel->address;
            $this->email = $strurel->email;
            $this->phones = $strurel->phones;
            $this->is_subscribe = $strurel->is_subscribe;
            $this->active = $strurel->active;

            $this->updateId = $strurel->id;
            $this->btnTitle = "تعديل";
        }


        public function DoupdateRec($id)
        {

            $strurel = StrurelModel::where('id', '=', $id)->first();

            $strurel->students_info_id = $this->students_info_id;
            $strurel->name = $this->name;
            $strurel->rel_type = $this->rel_type;
            $strurel->rel_lev = $this->rel_lev;
            $strurel->address = $this->address;
            $strurel->email = $this->email;
            $strurel->phones = $this->phones;
            $strurel->is_subscribe = $this->is_subscribe;
            $strurel->active = $this->active;

            $strurel->update();
            $this->btnTitle = "اضافة";
            $this->reset();
            // $this->dispatchBrowserEvent('hide-modal');
            return redirect(route('strurel.index' , $this->students_info_id))->with('status', 'تمت التعديل بنجاح');
        }

        public function deleteRec($id)
        {
            StrurelModel::where('id', '=', $id)->first()->delete();
            // $this->dispatchBrowserEvent('hide-modal');
            return redirect(route('strurel.index' , $this->students_info_id))->with('status', 'تمت الحذف بنجاح');
        }



        public function resetFilter( )
        {
            $this->students_info_id ="";
            $this->name ="";;
            $this->rel_type="";
            $this->rel_lev ="";
            $this->address ="";
            $this->email ="";
            $this->phones ="";
            $this->is_subscribe ="";
            $this->active="";

            $this->reset('students_info_id' , 'name' , 'rel_type' , 'email' ,  'phone' , 'is_subscribe' , 'active');
        }




    }
