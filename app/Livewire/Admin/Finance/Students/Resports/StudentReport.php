<?php

namespace App\Livewire\Admin\Finance\Students\Resports;

use Livewire\Component;
use App\Models\FeeTrans;
use App\Models\FamilyNumber;
use App\Models\Students_info;

class StudentReport extends Component
{

    public $from;
    public $to;
    public $students_info_id;


    public $family_number_id;
    public $family_number;
    public $stu_info = [];
    public $feetrans = [];





    public function render()
    {


        $this->family_number = FamilyNumber::all();


        if ($this->family_number_id != null) {
            $this->stu_info = Students_info::where('family_number_id', '=', $this->family_number_id)->get();

            $this->getList();
        }


        return view('livewire.admin.finance.students.resports.student-report');
    }



    public function getList()
    {

        $data = [];

        if (
            count($this->stu_info) > 0
        ) {
            foreach ($this->stu_info as $item) {
                $data[] =   $item->id;
            }


            $this->feetrans = FeeTrans::join('invoices', 'fee_trans.invoices_id', '=', 'invoices.id')
            ->whereIn('invoices.students_info_id',   $data)
            ->wherebetween('paid_date', [$this->from, $this->to])
            ->get(['fee_trans.*', 'invoices.*']);


        }




    }
}
