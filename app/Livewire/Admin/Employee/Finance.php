<?php

namespace App\Livewire\Admin\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmployeesInfo;
use App\Models\Employee_finance;
use App\Models\AllowanceType;
class Finance extends Component
{
    use WithPagination;
    public $employees_info_id;
    public $allowance_types_id;
    public $allowance_type;

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
        'allowance_types_id' => 'required',
        'amount' => 'required',
    ];

    public function render()
    {
        $this->employees_info = EmployeesInfo::where('active', '=', 1)->get();
        $employee_finances =  Employee_finance::paginate($this->per_page);
        $this->allowance_type = AllowanceType::where('active', '=', 1)->get();
        return view('livewire.admin.employee.finance', ['employee_finances' => $employee_finances]);
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
            if (Employee_finance::create([
                'employees_info_id' => $this->employees_info_id,
                'allowance_types_id' => $this->allowance_types_id,
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
        $employee_finance  = Employee_finance::where('id',  '=', $id)->first();
        $this->employees_info_id = $employee_finance->employees_info_id;
        $this->allowance_types_id = $employee_finance->allowance_types_id;
        $this->amount = $employee_finance->amount;
        $this->note = $employee_finance->note;
        $this->updateId = $employee_finance->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {
        $employee_finance = Employee_finance::where('id', '=', $id)->first();
        $employee_finance->employees_info_id = $this->employees_info_id;
        $employee_finance->allowance_types_id = $this->allowance_types_id;
        $employee_finance->amount = $this->amount;
        $employee_finance->note = $this->note;
        if ($employee_finance->update()) {
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
        if (Employee_finance::where('id', '=', $this->deleteId)->first()->delete()) {
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
