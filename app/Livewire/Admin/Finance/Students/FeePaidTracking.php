<?php

namespace App\Livewire\Admin\Finance\Students;

use SystemInfo;
use App\Models\Banks;
use App\Models\BillingCycle;
use Livewire\Component;
use App\Models\FeeTrans;
use App\Models\Invoices;

class FeePaidTracking extends Component
{
    public $ids;
    public $stu_id;
    public $invoice_id;
    public $paid_date;
    public $descount = 0;
    public $amount;
    public $transaction_id = 0;
    public $note = '';
    public $banks_id;
    public $update_id;
    public $delete_id;

    public $previous_debt;
    public $invoiceTotal;
    public $PaymentTotal;
    public $btnTitle = 'دفع رسوم';


    public $billingCylces = [];


    public $info;
    protected $listeners  = [ 'deleteConfirmed' => 'deleteRec'];
    protected $rules = [
        'paid_date' => 'required',
        'descount' => 'required',
        'amount' => 'required',
        'banks_id' => 'required',
    ];




    public function mount()
    {
        $this->ids = request('id');
        $this->stu_id = request('stu_id');
        $this->info =  Invoices::where('id' , '=', $this->ids)->first( );

        


        $this->previous_debt = SystemInfo::get_current_student_previous_balance($this->stu_id   , $this->ids );


    }

    public function render()
    {


        $this->invoiceTotal = Invoices::where('students_info_id', '=', $this->stu_id) ->sum('want')  ;

        $this->PaymentTotal = Invoices::join('fee_trans', 'invoices.id', '=', 'fee_trans.invoices_id')
                                ->where('invoices.students_info_id' ,  '=', $this->stu_id)
                                ->where('invoices.id' ,  '>', $this->ids)
                                ->sum('fee_trans.amount');

 

        $banks = Banks::where('active' , '=',1 )->get();


        $feetrans = FeeTrans::where('invoices_id' , '=',$this->ids)->get();
        return view('livewire.admin.finance.students.fee-paid-tracking' , [  'banks' => $banks , 'feetrans' => $feetrans   ]) ;
    }




    public function add()
    {
        $this->validate();



        $newTransition = FeeTrans::create([ 
                'invoices_id' => $this->ids,
                'paid_date' => $this->paid_date,
                'descount' => $this->descount,
                'amount' => $this->amount,
                'transaction_id' => $this->transaction_id,
                'note' => $this->note,
                'banks_id' => $this->banks_id,
            ]);


            if($newTransition){
                $this->dispatch('success-opration');
            }

    }


    public function getData( )
    {
         $this->update_id = $this->ids;
    }

    public function confrimDalete($rec_id){
        $this->delete_id = $rec_id;
        $this->dispatch('show-delete-confirmation');
    }

    public function deleteRec( )
    {
         if(FeeTrans::where('id' , '=' , $this->delete_id)->delete()){
            $this->dispatch('success-opration');
            $this->reset(['delete_id']);
         }
    }






    public function getDataToUpdate($recId){
       $data = FeeTrans::where('id' , '=' , $recId)->first(); 
        $this->paid_date = $data->paid_date;
        $this->descount = $data->descount;
        $this->amount = $data->amount;
        $this->note = $data->note;
        $this->banks_id = $data->banks_id; 
        $this->update_id = $data->id;
        $this->btnTitle =  'تحديث رسوم';
    }



    public function doUpdate(){
        $data = FeeTrans::where('id' , '=' , $this->update_id)->first();

        $data->paid_date = $this->paid_date;
        $data->descount = $this->descount;
        $data->amount = $this->amount;
        $data->note = $this->note;
        $data->banks_id = $this->banks_id;

        if($data->update()){
            $this->dispatch('success-opration');
            $this->reset(['update_id' ,  'btnTitle']);
        }
    }



    public function checkOpration(){

        if( $this->update_id !== null ){
            $this->doUpdate();
        }else{
            $this->add();
        }
    }
}
