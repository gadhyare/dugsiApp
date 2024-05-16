<?php


namespace App\Livewire\Admin\FamilyNumber;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\FamilyNumber as FamilyNumber;

class Info extends Component
{
    use WithPagination;

    public $fnumber;
    public $active = true;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';
    public $deleteId;

    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];


    public $per_page = 5;
    protected $rules = [
        'fnumber' => 'required',
        'active' => 'required',
    ];


    public $numberOfPaginatorsRendered;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $fathers = FamilyNumber::where('fnumber', 'LIKE', '%' . $this->search . '%')->paginate($this->per_page);
        return view('livewire.admin.family-number.info', ['fathers' => $fathers]);
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
                'fnumber' => $this->fnumber,
                'active' => $this->active,
            ])) {
                $this->dispatch('success-opration');
                $this->reset();
            }
        }
    }





    public function updateRec($id)
    {
        $fathers = FamilyNumber::where('id',  '=', $id)->first();
        $this->fnumber = $fathers->fnumber;
        $this->active = $fathers->active;
        $this->updateId = $fathers->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $fathers = FamilyNumber::where('id', '=', $id)->first();
        $fathers->fnumber = $this->fnumber;
        $fathers->active = $this->active;
        if ($fathers->update()) {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }


    #[On('doDelete')]
    public function deleteRec()
    {

        if (FamilyNumber::where('id', '=', $this->deleteId)->first()->delete()) {
            $this->dispatch('success-opration');
            $this->reset(['deleteId']);
        }

        $this->dispatch('success-opration');
    }


    public function deleteConfirmation($rec_id)
    {
        $this->deleteId = $rec_id;
        $this->dispatch('show-delete-confirmation', rec_id: $rec_id);
    }


    public function cancel()
    {
        $this->reset( );
    }


    public function changeActiveStatus($id){
        $fathers = FamilyNumber::where('id', '=', $id)->first(); 
        $fathers->name = $this->name;
        $fathers->active = !$this->active;
        $fathers->update();
    }
}
