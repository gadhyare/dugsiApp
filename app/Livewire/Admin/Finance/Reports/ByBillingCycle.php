<?php

namespace App\Livewire\Admin\Finance\Reports;

use App\Models\Allowance;
use Livewire\Component;
use App\Models\Invoices;
use App\Models\BillingCycle;  

class ByBillingCycle extends Component
{

    public $billingCycleId;
    public function render()
    {
        $billingCycles = BillingCycle::get();


        $initial_balance = BillingCycle::where('id' ,  '=', $this->billingCycleId)->first();

        $paid_amount = Invoices::join('fee_trans', 'invoices.id', '=', 'fee_trans.invoices_id')
                                        ->where('invoices.billing_cycles_id' ,  '=', $this->billingCycleId)
                                        ->sum('fee_trans.amount');

        $total_of_want = Invoices::where('billing_cycles_id' ,  '=', $this->billingCycleId)
                                        ->sum('want');

        $total_of_discount = Invoices::join('fee_trans', 'invoices.id', '=', 'fee_trans.invoices_id')
                                        ->where('invoices.billing_cycles_id' ,  '=', $this->billingCycleId)
                                        ->sum('fee_trans.descount');

        

        return view('livewire.admin.finance.reports.by-billing-cycle' , [
                                            'billingCycles' => $billingCycles ,
                                            'total_of_want' => $total_of_want,
                                            'paid_amount' => $paid_amount ,
                                            'total_of_discount' => $total_of_discount, 
                                            'initial_balance' => $initial_balance
                                            ] );
    }
}
