<?php

namespace App\Livewire\Admin\Finance\Expenses;

use App\Models\BillingCycle;
use App\Models\Expensess as ModelsExpensess;
use App\Models\ExpensesType;
use Livewire\Component;
use Livewire\WithPagination;

class Expensess extends Component
{

    use WithPagination;

    public $expenses_type;
    public $expenses_types_id;
    public $billing_cycles_id;
    public $date;
    public $amount;
    public $note;



    public $updateId;

    public $btnTitle = "اضافة";

    public $deleteId;

    protected $listeners  = [ 'deleteConfirmed' => 'deleteRec'];
    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'expenses_types_id' => 'required',
        'billing_cycles_id' => 'required',
        'date' => 'required',
        'amount' => 'required',
    ];



    public function mount()
    {
        $billing_cycles  = BillingCycle::where('active' , '=' , 1)->first();

        $this->billing_cycles_id  = $billing_cycles->id;
        $this->expenses_type = ExpensesType::where('active', '=', 1)->get();
    }
    public function render()
    {
        $expensess  = ModelsExpensess::paginate($this->per_page);


        return view('livewire.admin.finance.expenses.expensess', ['expensess' => $expensess]);
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
            if(ModelsExpensess::create([
                'expenses_types_id' => $this->expenses_types_id,
                'billing_cycles_id' => $this->billing_cycles_id,
                'date' => $this->date,
                'amount' => $this->amount,
                'note' => $this->note,
            ]))  {
                $this->dispatch('success-opration');
                $this->reset(
                    [
                        'date',
                        'amount',
                    ]
                );
            }
        }


    }


    public function updateRec($id)
    {

        $expenses  = ModelsExpensess::where('id',  '=', $id)->first();

        $this->expenses_types_id = $expenses->expenses_types_id;
        $this->billing_cycles_id = $expenses->billing_cycles_id;
        $this->date = $expenses->date;
        $this->amount = $expenses->amount;
        $this->note = $expenses->note;

        $this->updateId = $expenses->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {

        $expenses = ModelsExpensess::where('id', '=', $id)->first();

        $expenses->expenses_types_id = $this->expenses_types_id;
        $expenses->billing_cycles_id = $this->billing_cycles_id;
        $expenses->date = $this->date;
        $expenses->amount = $this->amount;
        $expenses->note = $this->note;


        if($expenses->update())  {
            $this->dispatch('success-opration');
                $this->reset(
                    [
                        'date',
                        'amount',
                    ]
                );
        }

    }

    public function deleteRec($id)
    {

        if(ModelsExpensess::where('id', '=', $id)->first()->delete()){
            $this->dispatch('success-opration');
                $this->reset(
                    [
                        'date',
                        'amount',
                    ]
                );
        }
    }




    public function deleteConfirmation($rec_id){
        $this->deleteId = $rec_id;
        $this->dispatch( 'show-delete-confirmation' );
    }


    public function cancel(){
        $this->reset([
            'deleteId' ,
            'updateId',
            'expenses_types_id' ,
            'billing_cycles_id' ,
            'date' ,
            'amount' ,
            'btnTitle'
        ]);
    }
}
