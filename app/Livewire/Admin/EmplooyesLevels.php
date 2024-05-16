<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\EmplooyesLevels as EmplooyesLevelsModel;



class EmplooyesLevels extends Component
{
    use WithPagination;
    public $name ;

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
    public function render(Request $request)
    {
        $emplooyesLevels = EmplooyesLevelsModel::where('name', 'like', '%' . $this->search . '%')->paginate($this->per_page);
        return view('livewire.admin.emplooyes-levels', ['emplooyesLevels' => $emplooyesLevels   ]);
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
            if(EmplooyesLevelsModel::create([
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
        $emplooyesLevels = EmplooyesLevelsModel::where('id',   $id)->first();
        $this->name = $emplooyesLevels->name;
        $this->active = $emplooyesLevels->active;
        $this->updateId = $emplooyesLevels->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {

        $emplooyesLevels = EmplooyesLevelsModel::where('id', '=', $id)->first();
        $emplooyesLevels->name = $this->name;
        $emplooyesLevels->active = $this->active;
        if($emplooyesLevels->update())  {
            $this->dispatch('success-opration');
            $this->reset();
        };

    }

    public function deleteRec( )
    {
        if(EmplooyesLevelsModel::where('id', '=',$this->deleteId)->first()->delete()){
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
