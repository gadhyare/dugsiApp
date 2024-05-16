<?php

namespace App\Livewire\Admin\Finance\Employee;

use SystemInfo;
use Livewire\Component;
use App\Models\BillingCycle;
use Livewire\WithPagination;
use App\Models\Employee_debt;
use App\Models\EmployeesInfo;
use App\Models\EmployeeSalary;
use App\Models\Employee_finance;
use App\Models\Employee_deduction;

class Salary extends Component
{

    use WithPagination;
    public $employees_info_id;
    public $billing_cycles_id;
    public $billing_cycles ;
    public $amount;
    public $note;
    public $date;
    public $employees_deductions;



    public $employees_info  ;
    public $info  ;

    public $updateId;
    public $deleteId;
    public $employees_finances = [];

    public $employees_debts = [];
    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];




    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'employees_info_id' => 'required',
        'billing_cycles_id' => 'required',
        'amount' => 'required',
        'date' => 'required',
    ];



    public function mount( )
    {
        // $billing_cycles  = BillingCycle::where('active', '=', 1)->first();
        // $this->billing_cycles_id  = $billing_cycles->id;
        $this->employees_info = EmployeesInfo::where('active', '=', 1)->get();
        $this->billing_cycles = BillingCycle::where('active', '=', 1)->get();
    }


    public function render()
    {
        $number =  $this->employees_info_id;
        $getbilling_cycles_id =  $this->billing_cycles_id;
        $employee_salaries =  EmployeeSalary::paginate($this->per_page);
        $this->employees_debts = Employee_debt::where('employees_info_id' ,'=' , $number)->where('billing_cycles_id' ,'=' , $getbilling_cycles_id)->get();
        $this->employees_finances = Employee_finance::where('employees_info_id' ,'=' , $number)->get();
        $this->employees_deductions = Employee_deduction::where('employees_info_id' ,'=' , $number)->where('billing_cycles_id' ,'=' , $getbilling_cycles_id)->get();

        $this->info = SystemInfo::get_employee_net_sallary($number,$getbilling_cycles_id) ?? 0;
        return view('livewire.admin.finance.employee.salary', ['employee_salaries' => $employee_salaries   ]);
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
            if (EmployeeSalary::create([
                'employees_info_id' => $this->employees_info_id,
                'billing_cycles_id' => $this->billing_cycles_id,
                'amount' => $this->amount,
                'note' => $this->note,
                'date' => $this->date,
            ])) {
                $this->dispatchBrowserEvent('success-opration');
                $this->reset(
                    [
                        'amount',
                        'note',
                        'date',
                        'btnTitle',
                        'updateId',
                    ]
                );
            }
        }
    }


    public function updateRec($id)
    {
        $allowance  = EmployeeSalary::where('id',  '=', $id)->first();
        $this->employees_info_id = $allowance->employees_info_id;
        $this->billing_cycles_id = $allowance->billing_cycles_id;
        $this->amount = $allowance->amount;
        $this->note = $allowance->note;
        $this->date = $allowance->date;
        $this->updateId = $allowance->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $allowance = EmployeeSalary::where('id', '=', $id)->first();
        $allowance->employees_info_id = $this->employees_info_id;
        $allowance->billing_cycles_id = $this->billing_cycles_id;
        $allowance->amount = $this->amount;
        $allowance->note = $this->note;
        $allowance->date = $this->date;
        if ($allowance->update()) {
            $this->dispatchBrowserEvent('success-opration');
            $this->reset(
                [
                    'amount',
                    'note',
                    'date',
                    'btnTitle',
                    'updateId',
                ]
            );
        }
    }

    public function deleteRec()
    {
        if (EmployeeSalary::where('id', '=', $this->deleteId)->first()->delete()) {
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
                'date',
                'btnTitle',
                'updateId',
            ]
        );
    }
}
