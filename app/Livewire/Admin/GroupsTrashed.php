<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Groups as GroupsModel;
use Livewire\WithPagination;

class GroupsTrashed extends Component
{

    use WithPagination;
    public $deleteId;
    
    public $per_page = 5;
    public $search = '';
    public function render()
    {
        $groups = GroupsModel::onlyTrashed()->where('name', 'like', '%' . $this->search . '%')->paginate($this->per_page);
        return view('livewire.admin.groups-trashed' , compact('groups'));
    }



    #[On('doDelete')]
    public function deleteRec()
    {
        $info = GroupsModel::withTrashed()->where('id', '=', $this->deleteId)->firstOrFail();

        if ($info->forceDelete()) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }


    public function deleteConfirmation($rec_id)
    {
        $this->deleteId = $rec_id;
        $this->dispatch('show-soft-delete-confirmation');
    }



    public function restore($rec_id)
    {
        $info = GroupsModel::withTrashed()->where('id', $rec_id)->firstOrFail();
        if ($info->restore()) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }
}
