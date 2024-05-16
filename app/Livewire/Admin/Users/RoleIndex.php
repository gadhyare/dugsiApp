<?php

namespace App\Livewire\Admin\Users;

use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class RoleIndex extends Component
{

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $name_ar;


    public $updateId;

    public $deleteId;

    
    public function render()
    {
        $roles = Role::all();
        return view('livewire.admin.users.role-index'  , compact('roles'));
    }


    public function store()
    {
        $this->validate();

        if (Role::create($this->validate())) {
            $this->dispatch('success-opration'); 
            $this->reset();
        }
    }


    public function updateRec($id)
    {

        $this->updateId = $id;
        $role = Role::where('id', '=', $this->updateId)->first();
        $this->name = $role->name;
        $this->name_ar = $role->name_ar;
    }



    public function ConfirmpUdateRec($id)
    {
        $this->validate();
        $this->updateId = $id;

        if (Role::find($this->updateId)->update($this->validate())) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }


    #[On('doDelete')]
    public function deleteRec()
    {
        if (Role::where('id', '=', $this->deleteId)->first()->delete()) {
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

 
