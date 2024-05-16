<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Reactive;
use App\Models\Shifts as ShiftsModel;

class Shifts extends Component
{
    use WithPagination;
    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $active = 1;
    public $numberOfPaginatorsRendered ;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;

    public $deleteId;
    public $message =  null;

    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];





    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $shifts = ShiftsModel::where('name', 'like', '%' . $this->search . '%')->paginate($this->per_page);
        return view('livewire.shifts', ['shifts' => $shifts]);
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
            if (ShiftsModel::create([
                'name' => $this->name,
                'active' => $this->active,
            ])) {
                $this->dispatch('success-opration');
                $this->cancel();
            }
        }


    }


    public function updateRec($id)
    {
        $shifts = ShiftsModel::where('id',  '=', $id)->first();
        $this->name = $shifts->name;
        $this->active = $shifts->active;
        $this->updateId = $shifts->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {

        $shifts = ShiftsModel::where('id', '=', $id)->first();
        $shifts->name = $this->name;
        $shifts->active = $this->active;
        if ($shifts->update()) {
            $this->dispatch('success-opration');
            $this->cancel();
        }
    }


    #[On('doDelete')]
    public function deleteRec()
    {
        if (ShiftsModel::where('id', '=', $this->deleteId)->first()->delete()) {
            $this->cancel();
        }
    }



    public function deleteConfirmation($rec_id)
    {
        $this->deleteId = $rec_id;
        $this->dispatch('show-delete-confirmation');
    }


    public function cancel()
    {
        $this->reset(['name', 'active', 'deleteId', 'updateId']);
    }



}
