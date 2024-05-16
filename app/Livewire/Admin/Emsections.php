<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Students_info;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Emsections as EmsectionsModel;
class Emsections extends Component
{
    // public function render()
    // {
    //     return view('livewire.admin.emsections');
    // }


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
        $emplooyesSections = EmsectionsModel::where('name', 'like', '%' . $this->search . '%')->paginate($this->per_page);


        return view('livewire.admin.emsections', ['emplooyesSections' => $emplooyesSections   ]);
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
            if(EmsectionsModel::create([
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
        $emplooyesSections = EmsectionsModel::where('id',   $id)->first();
        $this->name = $emplooyesSections->name;
        $this->active = $emplooyesSections->active;
        $this->updateId = $emplooyesSections->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $emplooyesSections = EmsectionsModel::where('id', '=', $id)->first();
        $emplooyesSections->name = $this->name;
        $emplooyesSections->active = $this->active;
        if($emplooyesSections->update())  {
            $this->dispatch('success-opration');
            $this->reset();
        }
    }

    public function deleteRec( )
    {
        if(EmsectionsModel::where('id', '=', $this->deleteId)->first()->delete()){
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
