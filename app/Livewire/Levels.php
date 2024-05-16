<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Levels as LevelsModel;
use Livewire\Attributes\On;

class Levels extends Component
{
    use WithPagination;
    public $name;
    public $active = 1;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;

    public $deleteId;

    protected $listeners  = [ 'deleteConfirmed' => 'deleteRec'];



    protected $rules = [
        'name' => 'required',
        'active' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $levels = LevelsModel::where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.levels', ['levels' => $levels]);
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
            if(LevelsModel::create([
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

        $levels = LevelsModel::where('id',  '=', $id)->first();

        $this->name = $levels->name;
        $this->active = $levels->active;

        $this->updateId = $levels->id;
        $this->btnTitle = "تعديل";

    }


    public function DoupdateRec($id)
    {

        $levels = LevelsModel::where('id', '=', $id)->first();

        $levels->name = $this->name;
        $levels->active = $this->active;


        if($levels->update())  {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }

    #[On('doDelete')]
    public function deleteRec( )
    {
        if(LevelsModel::where('id', '=', $this->deleteId)->first()->delete()){
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
