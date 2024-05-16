<?php

namespace App\Livewire\Admin\Finance\Students;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\BillingCycle as ModelsBillingCycle;

class BillingCycle extends Component
{
    use WithPagination;
    public $name;

    public $active = 1;

    public $per_page = 10;


    public $initial_balance;
    public $updateId;
    public $deleteId;

    public $btnTitle = "اضافة";

    public $billings;
    protected $paginationTheme = 'bootstrap';


    public $color = "success";

    protected $listeners  = [ 'deleteConfirmed' => 'deleteRec'];
    protected $rules = [
        'initial_balance' => 'required',
        'name' => 'required',
    ];


    public function render()
    {
        $this->billings = ModelsBillingCycle::get();
        return view('livewire.admin.finance.students.billing-cycle');
    }


    public function search()
    {
        $this->validate();
        $this->billings = ModelsBillingCycle::where('name', '=', $this->name)
            ->get();
    }


    public function add()
    {

        $this->validate();

        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            ModelsBillingCycle::create([
                'initial_balance' => $this->initial_balance,
                'name' => $this->name,
                'active' => $this->active,
            ]);

            $this->reset(['btnTitle']);
            $this->dispatch('success-opration');
        }
        $this->reset();
    }


    public function updateRec($id)
    {

        $billing = ModelsBillingCycle::where('id',  '=', $id)->first();

        $this->initial_balance = $billing->initial_balance;
        $this->name = $billing->name;
        $this->active = $billing->active;

        $this->updateId = $billing->id;
        $this->btnTitle = "تعديل";
        $this->color= "primary";

    }


    public function DoupdateRec($id)
    {

        $billing = ModelsBillingCycle::where('id', '=', $id)->first();

        $billing->initial_balance = $this->initial_balance;
        $billing->name = $this->name;
        $billing->active = $this->active;


        $billing->update();

        $this->reset(['btnTitle']);
        $this->dispatch('success-opration');
    }


    #[On('doDelete')]
    public function deleteRec( )
    {
        ModelsBillingCycle::where('id', '=', $this->deleteId)->first()->delete();
        $this->dispatch('success-opration');
        $this->reset(['btnDelete']);
    }

    public function deleteConfirmation($rec_id){
        $this->deleteId = $rec_id;
        $this->dispatch( 'show-delete-confirmation' );
    }


    public function cancel(){
        $this->reset();
    }


}
