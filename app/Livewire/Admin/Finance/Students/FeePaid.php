<?php

namespace App\Livewire\Admin\Finance\Students;

use App\Models\Banks;
use Livewire\Component;
use App\Models\FeeTrans;
use App\Models\Invoices;
use App\Models\BillingCycle;
use App\Models\FamilyNumber;
use App\Models\FeesType;
use Illuminate\Support\Facades\DB;

class FeePaid extends Component
{


    public $billingCyclesId;


    public $studentsInfoId= null;
    public $banksId = null;


    public $feestypesId;

    public $delete_id;
    public $CheckId =  [];
    public $CheckIds =  [];


    public $infos = [];

    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;

    // public function mount()
    // {
    //     $billingCylces = BillingCycle::where('active', '=', 1)->get();
    //     $familyNumbers  = FamilyNumber::where('active', '=', 1)->get();
    //     $feeTypes  = FeesType::where('active', '=', 1)->get();
    // }

    public function render()
    {

        // if ($this->billing_cycles_id !== null && $this->studentsInfoId) {
        //     $this->infos  = $this->Invoices;
        // }

        $billingCylces = BillingCycle::where('active', '=', 1)->get();
        $familyNumbers  = FamilyNumber::where('active', '=', 1)->get();
        $feeTypes  = FeesType::where('active', '=', 1)->get();
        $banks  = Banks::where('active', '=', 1)->get();

        return view('livewire.admin.finance.students.fee-paid' , ['invoices' => $this->Invoices,'billingCylces' => $billingCylces , 'familyNumbers' => $familyNumbers , 'feeTypes' => $feeTypes , 'banks' => $banks]);
    }


    public function confrimDalete($rec_id)
    {
        $this->delete_id = $rec_id;
        $this->dispatch('show-delete-confirmation');
    }



    public function deleteRec()
    {
        if (Invoices::where('id', '=', $this->delete_id)->delete()) {
            $this->dispatch('success-opration');
            $this->reset(['delete_id']);
        }
    }


    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked =  $this->Invoices->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }

    }





    public function updatedChecked()
    {
        $this->selectPage = false;

    }

  public function updatedStudentsInfoId()
    {
        $this->selectPage = false;
        $this->checked = [];
    }

    public function updateBillingCyclesId()
    {
        $this->selectPage = false;
        $this->checked = [];
    }

    public function updatedFeestypesId()
    {
        $this->selectPage = false;
        $this->checked = [];
    }

    public function updatedBanksId()
    {
        $this->selectPage = false;
        $this->checked = [];
    }


    public function isChecked($invoices_id)
    {
        return in_array($invoices_id, $this->checked);
    }

    public function hiho(   )
    {
           dd($this->checked);
    }

    public function getInvoicesProperty()
    {

        return   Invoices::join('billing_cycles', 'invoices.billing_cycles_id', '=', 'billing_cycles.id')
            ->join('students_info', 'invoices.students_info_id', '=', 'students_info.id')
            ->where('invoices.billing_cycles_id', '=',  $this->billingCyclesId)
            ->where('students_info.family_number_id', '=',  $this->studentsInfoId)
            ->where('invoices.feestypes_id', '=',  $this->feestypesId)
            ->get(['invoices.*']);
    }






    public function deleteRecords(){
        Invoices::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        session()->flash('info', 'Selected Records were deleted Successfully');
    }


    public function deleteSingleRecord($invoices_id)
    {
        $invoices = Invoices::findOrFail($invoices_id);
        $invoices->delete();
        $this->checked = array_diff($this->checked, [$invoices_id]);
        session()->flash('info', 'Record deleted Successfully');
    }



    public function multiPaidFee(){





        foreach($this->checked as $item ){
            $fee_trans = new FeeTrans();
            if(!$this->checkInvoiceTrans($item)){
                $fetInvoiceAmount = Invoices::where('id', '=', $item)->first();
                $fee_trans->invoices_id = $item;
                $fee_trans->paid_date = date('Y-m-d H:i:s');
                $fee_trans->descount = 0;
                $fee_trans->amount = $fetInvoiceAmount->want;
                $fee_trans->transaction_id = '';
                $fee_trans->note = '';
                $fee_trans->banks_id =  $this->banksId;
                $fee_trans->save();
            }

        }


        if($fee_trans->id){
            $this->dispatch('success-opration');
        }


    }


    public function checkInvoiceTrans($invoices_id){
         if( FeeTrans::where('invoices_id', '=', $invoices_id)->first()){
            return true;
         }
    }



}
