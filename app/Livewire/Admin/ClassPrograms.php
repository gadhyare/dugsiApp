<?php

namespace App\Livewire\Admin;

use App\Models\Classes;
use App\Models\Groups;
use App\Models\Levels;
use App\Models\Programs as ProgramsModel;
use App\Models\Sections;
use App\Models\Shifts;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('admin.layouts.for-livewire')]
class ClassPrograms extends Component
{

    public $levels = [];

    public $classes = [];

    public $groups = [];


    public $shifts = [];

    public $sections = [];

    #[Rule('required')]
    public $levels_id;

    #[Rule('required')]
    public $classes_id;


    #[Rule('required')]
    public $groups_id;


    #[Rule('required')]
    public $shifts_id;

    #[Rule('required')]
    public $sections_id;

    #[Rule('required')]

    public $status = 1;

    public $programs = [];


    public function render()
    {
        $this->levels = Levels::where('active', 1)->get();
        $this->groups = Groups::where('active', 1)->get();
        $this->shifts = Shifts::where('active', 1)->get();
        $this->sections = Sections::where('active', 1)->get();


        if($this->levels_id   ){
            $this->classes = Classes::where('levels_id' , '=' , $this->levels_id )->where('active', 1)->get();
        }


        $this->programs = ProgramsModel::where('status'  , '=' , $this->status)->get();

        return view('livewire.admin.class-programs');
    }



    public function add(){
        $this->validate() ; 
        if(ProgramsModel::create($this->validate())){
            $this->dispatch('success-opration');
        }  
    }

}
