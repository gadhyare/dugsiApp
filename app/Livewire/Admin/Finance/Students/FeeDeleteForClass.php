<?php

namespace App\Livewire\Admin\Finance\Students;

use SystemInfo;
use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use Livewire\Component;
use App\Models\FeesType;
use App\Models\Invoices;
use App\Models\Sections;
use Livewire\Attributes\On;
use RealRashid\SweetAlert\Facades\Alert;

class FeeDeleteForClass extends Component
{
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
    public $feestypes;
    public $feestypes_id;


    protected $listeners  = ['deleteConfirmed' => 'deleteRec'];
    protected $rules = [
        'levels_id' => 'required',
        'classes_id' => 'required',
        'groups_id' => 'required',
        'shifts_id' => 'required',
        'sections_id' => 'required',
        'feestypes_id' => 'required',
    ];


    public $invoices_info = [];

    public function getInfo()
    {


        $this->levels = Levels::where('active', '=', '1')->get();
        $this->shifts = Shifts::where('active', '=', '1')->get();
        $this->sections = Sections::where('active', '=', '1')->get();
        $this->groups = Groups::where('active', '=', '1')->get(); 
        $this->feestypes = FeesType::where('active', '=', '1')->get(); 
        $this->classes = Classes::where('active', '=', '1')->where('levels_id', '=', $this->levels_id)->get();
        
    }
    public function render()
    {

        $this->getInfo();
 
        return view('livewire.admin.finance.students.fee-delete-for-class');
    }




    public function getData()
    {

        $this->validate();

        $this->invoices_info = Invoices::where('levels_id', '=', $this->levels_id)
            ->where('classes_id', '=', $this->classes_id)
            ->where('groups_id', '=', $this->groups_id)
            ->where('shifts_id', '=', $this->shifts_id)
            ->where('sections_id', '=', $this->sections_id)
            ->where('feestypes_id', '=', $this->feestypes_id)
            ->get();
    }


     
    public function deleteRec()
    {
        Invoices::where('levels_id', '=', $this->levels_id)
            ->where('classes_id', '=', $this->classes_id)
            ->where('groups_id', '=', $this->groups_id)
            ->where('shifts_id', '=', $this->shifts_id)
            ->where('sections_id', '=', $this->sections_id)
            ->where('feestypes_id', '=', $this->feestypes_id)
            ->delete();
        $this->dispatch('success-opration');
        $this->getData();
    }


    public function deleteConfirmation()
    {
        $this->dispatch('show-delete-confirmation');
    }
}
