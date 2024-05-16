<?php

namespace App\Livewire\Admin\FamilyNumber;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\FamilyNumber;
use Livewire\WithPagination;

class InfoTrashed extends Component
{
    use WithPagination;

    public $search;

    public $per_page = 10;

    public $deleteId;

    public function render()
    {
        $fathers = FamilyNumber::onlyTrashed()->where('fnumber', 'like', '%' . $this->search . '%')->paginate($this->per_page);
        return view('livewire.admin.family-number.info-trashed' , compact('fathers'));
    }



    #[On('doDelete')]
    public function deleteRec()
    {

        $info = FamilyNumber::withTrashed()->where('id', '=', $this->deleteId)->firstOrFail() ; 
        if ($info->forceDelete()) { 
            $this->dispatch('success-opration');
            $this->reset(['deleteId']);
        }
    }


    public function deleteConfirmation($rec_id)
    {
        $this->deleteId = $rec_id;
        $this->dispatch('show-soft-delete-confirmation', rec_id: $rec_id);
    }


    public function restore($id)
    {
        $info =  FamilyNumber::withTrashed()->where('id'  , $id)->firstOrFail();

        if ($info->restore() ) {
            $this->dispatch('success-opration'); 
        } 
    }
    

}
