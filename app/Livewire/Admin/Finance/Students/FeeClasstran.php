<?php

namespace App\Livewire\Admin\Finance\Students;

use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use Livewire\Component;
use App\Models\FeesType;
use App\Models\Sections;
use App\Models\FeesValue;
use App\Models\Invoices;
use App\Models\BillingCycle;
use App\Models\Programs;
use App\Models\StudentsSchoolInfo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class FeeClasstran extends Component
{
    use WithPagination;

    public $levels;
    public $shifts;
    public $sections;
    public $classes;
    public $groups;


    public $levels_id;
    public $classes_id;
    public $groups_id;
    public $shifts_id;
    public $sections_id;
    public $amount;

    public $feestypes;
    public $feestypes_id;

    public $active = 1;
    public $per_page = 10;

    public $name;
     public $billingsId;
    public $students = [];


    public $data;
    public $result;
    public $get_feestypes;

    protected $paginationTheme = 'bootstrap';
    #[Url()]
    public $programs_id;
    public $billings;



    
    

    protected $rules = [
        'programs_id' => 'required',
        'feestypes_id' => 'required',
    ];






    #[Layout('admin.layouts.for-livewire')]
    public function render()
    {

        $this->levels = Programs::where('id', '=', $this->programs_id)->get();
        $this->feestypes = FeesType::where('active', '=', '1')->get();

        $this->billings = BillingCycle::where('active', '=', 1)->get();


            $this->students = StudentsSchoolInfo::where('programs_id', "=", $this->programs_id)
                                                ->get();



        $feeValue = FeesValue::where('programs_id', $this->programs_id)
        ->where('feestypes_id', $this->feestypes_id)
        ->first();


        if($feeValue){
            $this->amount = $feeValue->amount;
        }else{
            $this->amount =0;
        }

        return view('livewire.admin.finance.students.fee-classtran', [  'feeValue' => $feeValue]);


    }


    public function add()
    {

        $this->validate();
        $students = StudentsSchoolInfo::where('programs_id', $this->programs_id)
                            ->get();




            foreach($students as $student):
                if(!$this->get_sel_cls_fee_info($student->students_info_id)){
                    if($this->active == 1){
                        $want = $this->amount - $student->discount;
                    }else {
                        $want = $this->amount ;
                    }
                    Invoices::create([
                        'billing_cycles_id' => $this->billingsId,
                        'students_info_id' => $student->studentInfo->id,
                        'programs_id' => $this->programs_id,
                        'feestypes_id' => $this->feestypes_id,
                        'want' => $want,
                        'discount' => $student->discount,
                        'account_statuse' => 1,
                    ]);
                }
            endforeach;



            $this->dispatch('success-opration');
    }




    public function get_sel_cls_fee_info( $students_info_id )
    {


        $info = Invoices::where('programs_id', $this->programs_id)
                        ->where('students_info_id', $students_info_id)
                        ->first();



        if($info){
            return true ;
        }
    }


}
