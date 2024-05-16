<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Sections as SectionsModel;

class Sections extends Component
{
    use WithPagination;
    public $name;
    public $active = 1;


    public $updateId;

    public $btnTitle = "اضافة";
    public $deleteId;

    protected $listeners  = [ 'deleteConfirmed' => 'deleteRec'];


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'name' => 'required',
        'active' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $sections = SectionsModel::where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.sections', ['sections' => $sections]);
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
            if(SectionsModel::create([
                'name' => $this->name,
                'active' => $this->active,
                ])){
                    $this->dispatch('success-opration');
                    $this->reset();
                    }
        }
    }


    public function updateRec($id)
    {
        $sections = SectionsModel::where('id',  '=', $id)->first();
        $this->name = $sections->name;
        $this->active = $sections->active;
        $this->updateId = $sections->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $sections = SectionsModel::where('id', '=', $id)->first();
        $sections->name = $this->name;
        $sections->active = $this->active;
        if($sections->update())  {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }
    #[On('doDelete')]
    public function deleteRec( )
    {

            if(SectionsModel::where('id', '=',  $this->deleteId)->first()->delete()){
                $this->dispatch('success-opration');
                $this->reset();
            }

    }



    public function deleteConfirmation($rec_id){
        $this->deleteId = $rec_id;
        $this->dispatch( 'show-delete-confirmation' );
    }


    public function cancel(){
        $this->reset();
    }
}
