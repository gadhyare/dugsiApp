<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Classes as ClassesModel;

class ClassesTrashed extends Component
{
   

    use WithPagination;

    public $search = '';

    public $per_page = 10;

    public $deleteId;



    protected $paginationTheme = 'bootstrap';



    public function render()
    {

        $classes = ClassesModel::onlyTrashed()->where('name', 'like', '%' . $this->search . '%')->paginate($this->per_page);
        return view('livewire.admin.classes-trashed', compact('classes'));
    }




    #[On('doDelete')]
    public function deleteRec()
    {
        $info = ClassesModel::withTrashed()->where('id', '=', $this->deleteId)->firstOrFail();

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
        $info = ClassesModel::withTrashed()->where('id', $rec_id)->firstOrFail();
        if ($info->restore()) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }
}
