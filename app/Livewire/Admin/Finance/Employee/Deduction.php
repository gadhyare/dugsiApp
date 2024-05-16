<?php

namespace App\Livewire\Admin\Finance\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmployeesInfo;
use App\Models\Employee_deduction;
use App\Models\BillingCycle;

class Deduction extends Component
{
    use WithPagination;
    public $employees_info_id;
    public $billing_cycles_id  ;

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
        'employees_info_id' => 'required',
        'amount' => 'required',
    ];



    public function render()
    {
        $this->employees_info = EmployeesInfo::where('active', '=', 1)->get();
        $employee_deductions =  Employee_deduction::paginate($this->per_page);
        $this->billing_cycles_id = BillingCycle::where('active', '=', 1)->first( );


        return view('livewire.admin.finance.employee.deduction', ['employee_deductions' => $employee_deductions]);
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
            if (Employee_deduction::create([
                'employees_info_id' => $this->employees_info_id,
                'billing_cycles_id' => $this->billing_cycles_id->id ,
                'amount' => $this->amount,
                'note' => $this->note,
            ])) {
                $this->dispatchBrowserEvent('success-opration');
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
        $Employee_deduction  = Employee_deduction::where('id',  '=', $id)->first();
        $this->employees_info_id = $Employee_deduction->employees_info_id;
        $this->billing_cycles_id  = $Employee_deduction->billing_cycles_id ;
        $this->amount = $Employee_deduction->amount;
        $this->note = $Employee_deduction->note;
        $this->updateId = $Employee_deduction->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $Employee_deduction = Employee_deduction::where('id', '=', $id)->first();
        $Employee_deduction->employees_info_id = $this->employees_info_id;
        $Employee_deduction->billing_cycles_id  = $this->billing_cycles_id->id ;
        $Employee_deduction->amount = $this->amount;
        $Employee_deduction->note = $this->note;
        if ($Employee_deduction->update()) {
            $this->dispatchBrowserEvent('success-opration');
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
        if (Employee_deduction::where('id', '=', $this->deleteId)->first()->delete()) {
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
        $this->reset(
            [
                'amount',
                'note',
            ]
        );
    }

}
