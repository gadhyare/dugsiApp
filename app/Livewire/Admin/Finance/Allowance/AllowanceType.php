<?php

namespace App\Livewire\Admin\Finance\Allowance;


use Livewire\Component;
use App\Models\AllowanceType as AllowanceTypeModel;
use Livewire\WithPagination;
class AllowanceType extends Component
{

    use WithPagination;
    public $name;
    public $active = 1;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;


    public $deleteId;

    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];




    protected $rules = [
        'name' => 'required',
        'active' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $allowanceTypes = AllowanceTypeModel::where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.admin.finance.allowance.allowance-type' , ['allowanceTypes' => $allowanceTypes]);
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
            if(AllowanceTypeModel::create([
                'name' => $this->name,
                'active' => $this->active,
            ])){
                $this->dispatchBrowserEvent('success-opration');
                $this->reset();
            }
        }
    }


    public function updateRec($id)
    {
        $allowanceTypes = AllowanceTypeModel::where('id',  '=', $id)->first();
        $this->name = $allowanceTypes->name;
        $this->active = $allowanceTypes->active;
        $this->updateId = $allowanceTypes->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $allowanceTypes = AllowanceTypeModel::where('id', '=', $id)->first();
        $allowanceTypes->name = $this->name;
        $allowanceTypes->active = $this->active;

        if ($allowanceTypes->update()) {
            $this->dispatchBrowserEvent('success-opration');
            $this->reset();
        }
    }

    public function deleteRec( )
    {
        if (AllowanceTypeModel::where('id', '=', $this->deleteId)->first()->delete()) {
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
