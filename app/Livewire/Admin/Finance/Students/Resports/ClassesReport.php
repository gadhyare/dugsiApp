<?php

namespace App\Livewire\Admin\Finance\Students\Resports;

use App\Models\BillingCycle;
use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use Livewire\Component;
use App\Models\FeesType;
use App\Models\FeeTrans;
use App\Models\Invoices;
use App\Models\Programs;
use App\Models\Sections;

class ClassesReport extends Component
{
    public $programs; 


    public $programs_id;
  
    public $feestypes;
    public $feestypes_id;
 
    public $billing_cycles ;
    public $billing_cycle_id;
    



    public $totalPaidBetweenTwoDateForStudent = 0;


    public function mount()
    {


        $this->programs = Programs::where('status', '=', '1')->get(); 
        $this->feestypes = FeesType::where('active', '=', '1')->get();
        $this->billing_cycles  = BillingCycle::where('active', '=', '1')->get();
    }
    public function render()
    {

        $feetrans = Invoices::leftJoin('fee_trans', 'fee_trans.invoices_id', '=', 'invoices.id')
            ->where('invoices.programs_id', '=', $this->programs_id) 
            ->where('invoices.feestypes_id', '=', $this->feestypes_id)
            ->where('invoices.billing_cycles_id', '=', $this->billing_cycle_id) 
            ->get(['fee_trans.*', 'invoices.*']);


        $this->totalPaidBetweenTwoDateForStudent = Invoices::leftJoin('fee_trans', 'fee_trans.invoices_id', '=', 'invoices.id')
        ->where('invoices.programs_id', '=', $this->programs_id) 
            ->where('invoices.feestypes_id', '=', $this->feestypes_id)
            ->where('invoices.feestypes_id', '=', $this->feestypes_id)
            ->where('invoices.billing_cycles_id', '=', $this->billing_cycle_id) 
            ->sum('fee_trans.amount' );

        return view('livewire.admin.finance.students.resports.classes-report', ['feetrans' =>  $feetrans]);
    }



    public function selectPrograms_id($id){
        $this->programs_id = $id;
    }
}
