<?php

namespace App\Livewire\Admin\Finance\Expenses;

use Livewire\Component;
use App\Models\ExpensesType as ExpensesTypeModel;
use Livewire\WithPagination;

class ExpensesType extends Component
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


    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $expensesTypes = ExpensesTypeModel::where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.admin.finance.expenses.expenses-type' , ['expensesTypes' => $expensesTypes]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function add()
    {

        $this->validate();

        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            ExpensesTypeModel::create([
                'name' => $this->name,
                'active' => $this->active,
            ]);

            return redirect(route('expenses.type'))->with('status', 'تمت الاضافة بنجاح');
        }

        $this->reset();
    }


    public function updateRec($id)
    {

        $expensesTypes = ExpensesTypeModel::where('id',  '=', $id)->first();

        $this->name = $expensesTypes->name;
        $this->active = $expensesTypes->active;

        $this->updateId = $expensesTypes->id;
        $this->btnTitle = "تعديل";

    }


    public function DoupdateRec($id)
    {

        $expensesTypes = ExpensesTypeModel::where('id', '=', $id)->first();

        $expensesTypes->name = $this->name;
        $expensesTypes->active = $this->active;


        $expensesTypes->update();

        $this->btnTitle = "اضافة";
        $this->reset();
        return redirect(route('expenses.type'))->with('status', 'تمت التعديل بنجاح');
    }

    public function deleteRec($id)
    {

        ExpensesTypeModel::where('id', '=', $id)->first()->delete();


        return redirect(route('expenses.type'))->with('status', 'تمت الحذف بنجاح');
    }

}
