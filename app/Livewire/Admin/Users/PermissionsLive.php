<?php

namespace App\Livewire\Admin\Users;

use App\Models\Tables;
use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class PermissionsLive extends Component
{
    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $name_ar;


    #[Rule('required')]
    public $table_id;

    public $updateId;
    public $deleteId;

    
    public function render()
    {

        $tables = Tables::all();
        $permissions = Permission::all();
        return view('livewire.admin.users.permissions-live',  compact('tables' , 'permissions'));
    }



    public function store()
    {
        $this->validate();

        if (Permission::create($this->validate())) {
            $this->dispatch('success-opration');

            $this->reset();
        }
    }


    public function updateRec($id)
    {

        $this->updateId = $id;
        $permission = Permission::where('id', '=', $this->updateId)->first();
        $this->name = $permission->name;
        $this->name_ar = $permission->name_ar;
        $this->table_id = $permission->table_id;
    }



    public function ConfirmpUdateRec($id)
    {
        $this->validate();
        $this->updateId = $id;

        if (Permission::find($this->updateId)->update($this->validate())) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }


    #[On('doDelete')]
    public function deleteRec()
    {
        if (Permission::where('id', '=', $this->deleteId)->first()->delete()) {
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
