<?php

namespace App\Livewire\Admin\Finance\Allowance;

use Livewire\Component;
use App\Models\BillingCycle;
use Livewire\WithPagination;
use App\Models\AllowanceType;
use App\Models\EmployeesInfo;
use App\Models\Allowance as ModelAllowance;

class Allowance extends Component
{


    use WithPagination;

    public $allowance_type = [];
    public $allowance_types_id;
    public $billing_cycles_id;
    public $employees_info_id;
    public $employees_info = [];
    public $date;
    public $amount;
    public $note;



    public $updateId;
    public $deleteId;

    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];




    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'allowance_types_id' => 'required',
        'employees_info_id' => 'required',
        'billing_cycles_id' => 'required',
        'date' => 'required',
        'amount' => 'required',
        'note' => 'required',
    ];



    public function mount()
    {
        $billing_cycles  = BillingCycle::where('active', '=', 1)->first();
        $this->billing_cycles_id  = $billing_cycles->id;
        $this->allowance_type = AllowanceType::where('active', '=', 1)->get();
        $this->employees_info = EmployeesInfo::where('active', '=', 1)->get();


    }
    public function render()
    {
        $allowance  = ModelAllowance::paginate($this->per_page);
        return view('livewire.admin.finance.allowance.allowance', ['allowances' => $allowance]);
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
            if (ModelAllowance::create([
                'allowance_types_id' => $this->allowance_types_id,
                'employees_info_id' => $this->employees_info_id,
                'billing_cycles_id' => $this->billing_cycles_id,
                'date' => $this->date,
                'amount' => $this->amount,
                'note' => $this->note,
            ])) {
                $this->dispatchBrowserEvent('success-opration');
                $this->reset();
            }
        }
    }


    public function updateRec($id)
    {
        $allowance  = ModelAllowance::where('id',  '=', $id)->first();
        $this->allowance_types_id = $allowance->allowance_types_id;
        $this->employees_info_id = $allowance->employees_info_id;
        $this->billing_cycles_id = $allowance->billing_cycles_id;
        $this->date = $allowance->date;
        $this->amount = $allowance->amount;
        $this->note = $allowance->note;
        $this->updateId = $allowance->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $allowance = ModelAllowance::where('id', '=', $id)->first();
        $allowance->allowance_types_id = $this->allowance_types_id;
        $allowance->employees_info_id = $this->employees_info_id;
        $allowance->billing_cycles_id = $this->billing_cycles_id;
        $allowance->date = $this->date;
        $allowance->amount = $this->amount;
        $allowance->note = $this->note;
        if ($allowance->update()) {
            $this->dispatchBrowserEvent('success-opration');
            $this->reset();
        }
    }

    public function deleteRec()
    {
        if (ModelAllowance::where('id', '=', $this->deleteId)->first()->delete()) {
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
