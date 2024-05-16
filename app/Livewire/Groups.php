<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Groups as GroupsModel;

class Groups extends Component
{
    use WithPagination;
    public $name;
    public $active = 1;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';
    public $deleteId;

    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];




    public $per_page = 10;
    protected $rules = [
        'name' => 'required',
        'active' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $groups = GroupsModel::where('name', 'like', '%' . $this->search . '%')->paginate($this->per_page);
        return view('livewire.groups', ['groups' => $groups]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function checkOpration()
    {

        $this->validate();

        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            if (GroupsModel::create([
                'name' => $this->name,
                'active' => $this->active,
            ])) {
                $this->dispatch('success-opration');
                $this->reset();
            }
        }
    }


    public function updateRec($id)
    {
        $groups = GroupsModel::where('id',  '=', $id)->first();
        $this->name = $groups->name;
        $this->active = $groups->active;
        $this->updateId = $groups->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $groups = GroupsModel::where('id', '=', $id)->first();
        $groups->name = $this->name;
        $groups->active = $this->active;
        if ($groups->update()) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }

    #[On('doDelete')]
    public function deleteRec( )
    {
        if (GroupsModel::where('id', '=', $this->deleteId)->first()->delete()) {
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
