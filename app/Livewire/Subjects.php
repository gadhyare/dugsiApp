<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subjects as SubjectsModel;


class Subjects extends Component
{
    use WithPagination;
    public $name;
    public $active = 1;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'name' => 'required',
        'active' => 'required',
    ];

    public $deleteId;

    protected $listeners  = [ 'deleteConfirmed' => 'deleteRec'];

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $subjects = SubjectsModel::where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.subjects', ['subjects' => $subjects]);
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
            if(SubjectsModel::create([
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
        $subjects = SubjectsModel::where('id',  '=', $id)->first();
        $this->name = $subjects->name;
        $this->active = $subjects->active;
        $this->updateId = $subjects->id;
        $this->btnTitle = "تعديل";

    }


    public function DoupdateRec($id)
    {
        $subjects = SubjectsModel::where('id', '=', $id)->first();
        $subjects->name = $this->name;
        $subjects->active = $this->active;
        if($subjects->update()){
            $this->dispatch('success-opration');
            $this->reset();
        }


    }


    #[On('doDelete')]
    public function deleteRec( )
    {

        if(SubjectsModel::where('id', '=', $this->deleteId)->first()->delete()){
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
