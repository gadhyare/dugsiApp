<?php

namespace App\Livewire\Admin\Finance\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmployeesInfo;
use App\Models\Employee_debt;
use App\Models\BillingCycle;
class Debt extends Component
{
    use WithPagination;
    public $employees_info_id;
    public $billing_cycles_id  ; 
    public $billing_cycles;
    public $amount;
    public $note;

    public $employees_info = [];

    public $updateId;
    public $deleteId;
    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];
    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'billing_cycles_id' => 'required',
        'employees_info_id' => 'required',
        'amount' => 'required',
    ];





    public function render()
    {
        $this->employees_info = EmployeesInfo::where('active', '=', 1)->get();
        $employee_debts =  Employee_debt::paginate($this->per_page);
        //$this->billing_cycles_id = BillingCycle::where('active', '=', 1)->first( );
        $this->billing_cycles = BillingCycle::where('active', '=', 1)->get();

        return view('livewire.admin.finance.employee.debt', ['employee_debts' => $employee_debts]);
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
            if (Employee_debt::create([
                'employees_info_id' => $this->employees_info_id,
                'billing_cycles_id' => $this->billing_cycles_id ,
                'amount' => $this->amount,
                'note' => $this->note,
            ])) {
                $this->dispatch('success-opration');
                $this->reset(
                    [
                        'amount',
                        'note',
                    ]
                );
            }
        }
    }


    public function updateRec($id)
    {
        $Employee_debt  = Employee_debt::where('id',  '=', $id)->first();
        $this->employees_info_id = $Employee_debt->employees_info_id;
        $this->billing_cycles_id  = $Employee_debt->billing_cycles_id ;
        $this->amount = $Employee_debt->amount;
        $this->note = $Employee_debt->note;
        $this->updateId = $Employee_debt->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $Employee_debt = Employee_debt::where('id', '=', $id)->first();
        $Employee_debt->employees_info_id = $this->employees_info_id;
        $Employee_debt->billing_cycles_id  = $this->billing_cycles_id->id ;
        $Employee_debt->amount = $this->amount;
        $Employee_debt->note = $this->note;
        if ($Employee_debt->update()) {
            $this->dispatch('success-opration');
            $this->reset(
                [
                    'amount',
                    'note',
                ]
            );
        }
    }

    public function deleteRec()
    {
        if (Employee_debt::where('id', '=', $this->deleteId)->first()->delete()) {
            $this->dispatch('success-opration');
            $this->reset(['deleteId']);
        }
    }


    public function deleteConfirmation($rec_id)
    {
        $this->deleteId = $rec_id;
        $this->dispatch('show-delete-confirmation');
    }

    public function cancel()
    {
        $this->reset(
            [
                'amount',
                'note',
            ]
        );
    }


}
