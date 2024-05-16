<?php

namespace App\Livewire\Admin\Users;

use App\Models\Tables;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class TableLive extends Component
{

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $name_ar;
    

    public $updateId;

    public $deleteId  ;
    public function render()
    {
        $tables = Tables::all();
        return view('livewire.admin.users.table-live' , compact('tables'));
    }


    public function store(){
        $this->validate();

        if(Tables::create($this->validate())){
            $this->dispatch('success-opration');

            $this->reset();
        }
    }


    public function updateRec($id)
    {

        $this->updateId = $id;
        $table = Tables::where('id', '=', $this->updateId)->first();
        $this->name = $table->name;
        $this->name_ar = $table->name_ar;  
    }



    public function ConfirmpUdateRec($id)
    {
        $this->validate(); 
        $this->updateId = $id;

        if ( Tables::find($this->updateId)->update(  $this->validate()  ) ) { 
            $this->dispatch('success-opration');
            $this->reset();
        }
    }


    #[On('doDelete')]
    public function deleteRec()
    {
        if (Tables::where('id', '=', $this->deleteId)->first()->delete()) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }




    public function deleteConfirmation($rec_id)
    {
        $this->deleteId = $rec_id;
        $this->dispatch('show-delete-confirmation');
    }



    public function cancel()
    {
        $this->reset();
    }

}
