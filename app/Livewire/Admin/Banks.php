<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Banks as BanksModel;

class Banks extends Component
{

    public $name;
    public $bank_number;
    public $open_date;
    public $op_acc = 0;
    public $active  = "1";

    public $event;
    public $updateId;

    public $deleteId;

    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];



    protected $rules = [
        'name' => 'required',
        'bank_number' => 'required',
        'open_date' => 'required',
        'op_acc' => 'required'
    ];



    public function render()
    {
        $banks = BanksModel::orderby('id', 'DESC')->get();
        return view('livewire.admin.banks', ['banks' => $banks]);
    }


    public function add()
    {


        if ($this->updateId) {
            $this->ConfirmpUdateRec($this->updateId);
        } else {
            $this->validate();
            if (BanksModel::create([
                'name' => $this->name,
                'bank_number' => $this->bank_number,
                'open_date' => $this->open_date,
                'op_acc' => $this->op_acc
            ])) {
                $this->dispatch('success-opration');
            }
        }
    }


    public function updateRec($id)
    {

        $this->updateId = $id;
        $bank = BanksModel::where('id', '=', $this->updateId)->first();
        $this->name = $bank->name;
        $this->bank_number = $bank->bank_number;
        $this->open_date = $bank->open_date;
        $this->op_acc = $bank->op_acc;
        $this->event = "update";
    }






    public function ConfirmpUdateRec($id)
    {
        $this->validate();


        $this->updateId = $id;

        if (
            BanksModel::find($this->updateId)->update(
                [
                    'name' => $this->name,
                    'bank_number' => $this->bank_number,
                    'open_date' => $this->open_date,
                    'op_acc' => $this->op_acc,
                    'active' => $this->active,
                ]
            )
        ) {
            $this->reset(['updateId']);
            $this->dispatch('success-opration');
            $this->reset();
        }
    }


    #[On('doDelete')]
    public function deleteRec()
    {
        if (BanksModel::where('id', '=', $this->deleteId)->first()->delete()) {
            $this->dispatch('success-opration');
            $this->reset( );
        }
    }




    public function deleteConfirmation($rec_id)
    {
        $this->deleteId = $rec_id;
        $this->dispatch('show-delete-confirmation'  );
    }


    public function cancel()
    {
        $this->reset();
    }
}
