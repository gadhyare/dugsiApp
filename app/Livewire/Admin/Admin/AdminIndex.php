<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Role;
use App\Models\Admins;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Validator;

class AdminIndex extends Component
{
    
    
    public $name;

    
    public $email;
 
    public $password;
 
    public $password_confirmation;

    
    public $role_id;
 
    public $updateId;
    public $deleteId;
    public function render()
    {
        $admins = Admins::all();
        $roles = Role::all();
        return view('livewire.admin.admin.admin-index' , compact('admins' , 'roles' ) );
    }


    public function store()
    {
        $validate =  $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
            'role_id' => 'required'
        ]);

        if (Admins::create($validate)) {
            $this->dispatch('success-opration'); 
            $this->reset();
        }
    }


    public function updateRec($id)
    { 
        $this->updateId = $id;
        $permission = Admins::where('id', '=', $this->updateId)->first();
        $this->name = $permission->name;
        $this->email = $permission->email;
        $this->role_id = $permission->role_id;
    }



    public function ConfirmpUdateRec($id)
    {
        $this->validate();
        $this->updateId = $id; 
        if (Admins::find($this->updateId)->update($this->validate())) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }


    #[On('doDelete')]
    public function deleteRec()
    {
        if (Admins::where('id', '=', $this->deleteId)->first()->delete()) {
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




    function admin(){
        
    }
}
