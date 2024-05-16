<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\On;
use Livewire\Component;


use Livewire\WithPagination;

use App\Models\SubjectsDistribution as SubjectsDistributionModel;
use App\Models\Subjects;
use App\Models\Levels;
use App\Models\Classes;
use App\Models\Programs;
use Livewire\Attributes\Layout;

class SubjectsDistribution extends Component
{

        use WithPagination;
        public $subjects_id;
        public $programs_id;
        public $programs ;
        public $selectPrograms = null;
        public $subjects ;

        public $max_mark = 100  ;
        public $min_mark = 50;

        public $rank = 1;
        public $active = 1;

        public $updateId;


        public $btnTitle = "اضافة";


        public $search = '';

        public $per_page = 10;

        public $deleteId;

        protected $paginationTheme = 'bootstrap';

        protected $rules = [
            'subjects_id' => 'required',
            'programs_id' => 'required',
            'max_mark' => 'required',
            'min_mark' => 'required',
            'rank' => 'required',
            'active' => 'required',
        ];



        public function mount(){
            $this->programs = Programs::where('status', '=', '1')->get();
            $this->selectPrograms = $this->programs->first()->id;
            $this->subjects = Subjects::where('active', '=', '1')->get();


        }

        #[Layout('admin.layouts.for-livewire')]
        public function render()
        {
            if($this->programs_id !=  null){
                $SubjectsDistributions = SubjectsDistributionModel::where('programs_id' , '=' , $this->programs_id  )->paginate($this->per_page) ;;
            }else{
                $SubjectsDistributions = [];
            }

            return view('livewire.admin.subjects-distribution' , ['SubjectsDistributions' => $SubjectsDistributions]   );
        }


        public function updatingSearch()
        {
            $this->resetPage();
        }


        public function checkOpration()
        {
            $this->validate();
            if ($this->updateId) {
                $this->DoupdateRec($this->updateId);
            } else {
                if(SubjectsDistributionModel::create([
                    'subjects_id' =>  $this->subjects_id,
                    'programs_id' =>  $this->programs_id,
                    'max_mark' =>  $this->max_mark,
                    'min_mark' =>  $this->min_mark,
                    'rank' =>  $this->rank,
                    'active' =>  $this->active,
                ])){
                    $this->dispatch('success-opration');

                }
            }
        }


        public function updateRec($id)
        {
            $subjects = SubjectsDistributionModel::where('id',  '=', $id)->first();
            $this->subjects_id = $subjects->subjects_id;
            $this->programs_id = $subjects->programs_id;
            $this->max_mark = $subjects->max_mark;
            $this->min_mark = $subjects->min_mark;
            $this->rank = $subjects->rank;
            $this->active = $subjects->active;
            $this->updateId = $subjects->id;
            $this->btnTitle = "تعديل";
        }


        public function DoupdateRec($id)
        {

            $subjects = SubjectsDistributionModel::where('id', '=', $id)->first();
            $subjects->subjects_id = $this->subjects_id;
            $subjects->programs_id = $this->programs_id;
            $subjects->max_mark = $this->max_mark;
            $subjects->min_mark = $this->min_mark;
            $subjects->rank = $this->rank;
            $subjects->active = $this->active;

            if($subjects->update()){
                $this->dispatch('success-opration');
                $this->reset();
            }

        }

        #[On('doDelete')]
        public function deleteRec( )
        {
            SubjectsDistributionModel::where('id', '=', $this->deleteId)->first()->delete();
        }


        public function deleteConfirmation($rec_id){
            $this->deleteId = $rec_id;
            $this->dispatch( 'show-delete-confirmation' );
        }


        public function cancel(){
            $this->reset(
                'subjects_id',
                'max_mark',
                'min_mark',
                'rank',
                'active',
                'deleteId' ,
                'updateId',
                'btnTitle'
            );
        }
}
