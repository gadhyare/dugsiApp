<?php

namespace App\Livewire;

use App\Models\Levels;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use App\Models\Classes as ClassesModel;


class Classes extends Component
{
    use WithPagination;
    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $levels_id;
    public $active = 1;


    public $updateId;
    public $deleteId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;

    protected $listeners  = [ 'deleteConfirmed' => 'deleteRec'];

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $classes = ClassesModel::where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);

        $levels = Levels::where('active', '=', '1')->get();
        return view('livewire.classes', ['classes' => $classes , 'levels' => $levels]);
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
            if(ClassesModel::create([
                'name' => $this->name,
                'levels_id' => $this->levels_id,
                'active' => $this->active,
            ])) {
                $this->dispatch( 'success-opration' );
                $this->reset();
            }
        }


    }


    public function updateRec($id)
    {

        $classes = ClassesModel::where('id',  '=', $id)->first();

        $this->name = $classes->name;
        $this->levels_id = $classes->levels_id;
        $this->active = $classes->active;
        $this->updateId = $classes->id;
        $this->btnTitle = "تعديل";

    }


    public function DoupdateRec($id)
    {

        $classes = ClassesModel::where('id', '=', $id)->first();

        $classes->name = $this->name;
        $classes->levels_id = $this->levels_id;
        $classes->active = $this->active;


        if($classes->update()) {
        $this->btnTitle = "اضافة";
            $this->dispatch( 'success-opration' );
            $this->reset();
        }
    }



    #[On('doDelete')]
    public function deleteRec( )
    {
        if(ClassesModel::where('id', '=', $this->deleteId)->first()->delete()){
            $this->dispatch('success-opration');
            $this->reset();
        }

    }




    public function deleteConfirmation($rec_id){
        $this->deleteId = $rec_id;
        $this->dispatch('show-delete-confirmation' );
    }


    public function cancel(){
        $this->reset();
    }

}
