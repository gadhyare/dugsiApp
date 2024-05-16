<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FamilyNumber as FamilyNumber;
class Fathers extends Component
{
    use WithPagination;

    public $number;
    public $active = 1;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';
    public $deleteId;

    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];


    public $per_page = 10;
    protected $rules = [
        'number' => 'required',
        'active' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $fathers = FamilyNumber::where('number', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.admin.fathers', ['fathers' => $fathers]);
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
            if (FamilyNumber::create([
                'number' => $this->number,
                'active' => $this->active,
                ])) {
                    $this->dispatchBrowserEvent('success-opration');
                    $this->reset();
                }
            }
        }



    public function updateRec($id)
    {
        $fathers = FamilyNumber::where('id',  '=', $id)->first();
        $this->number = $fathers->number;
        $this->active = $fathers->active;
        $this->updateId = $fathers->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $fathers = FamilyNumber::where('id', '=', $id)->first();
        $fathers->number = $this->number;
        $fathers->active = $this->active;
        if ($fathers->update()) {
            $this->dispatchBrowserEvent('success-opration');
            $this->reset();
        }
    }

    public function deleteRec( )
    {

        if (FamilyNumber::where('id', '=', $this->deleteId)->first()->delete()) {
            $this->dispatchBrowserEvent('success-opration');
            $this->reset(['deleteId']);
        }

    }


    public function deleteConfirmation($rec_id)
    {
        $this->deleteId = $rec_id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function cancel()
    {
        $this->reset();
    }

}
