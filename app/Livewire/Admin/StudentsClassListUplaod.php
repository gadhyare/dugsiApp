<?php

namespace App\Livewire\Admin;

use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use Livewire\Component;
use App\Models\Programs;

use App\Models\Sections;
use Livewire\Attributes\Url;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Imports\StudentsInfoImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CopyOfStudentSchoolInfo;
use App\Imports\ImportCopyOfStudentSchoolInfo;

class StudentsClassListUplaod extends Component
{
    use WithFileUploads;


    #[Rule('required')]
    public $fileUpload;



    #[Url()]
    public $programs_id  ;
    public $items =  [];


    public $content = '';

    public $fileInfo = [];
    public $info = false;
    

    #[Layout('admin.layouts.for-livewire')]
    #[Title('Create Post')]
    public function render()
    {


        $programs = Programs::find($this->programs_id);
        return view('livewire.admin.students-class-list-uplaod', compact('programs'));
    }



    public function updatedfileUpload()
    {
         $this->ceckIfIsDataIn() ;
        $this->fileInfo['name'] = str_replace(".xlsx", "", $this->fileUpload->getClientOriginalName());
        $this->fileInfo['tyep'] = $this->fileUpload->getMimeType();
        $this->fileInfo['size'] = $this->fileUpload->getSize();

        $this->info = true;

        if(Excel::import( new ImportCopyOfStudentSchoolInfo (), $this->fileUpload)){
            $this->items =  CopyOfStudentSchoolInfo::get();
        }

    }



    public function uploadList()
    {


        //dd($this->fileUpload );
        // $import = new StudentsInfoImport($this->programs_id);
        // Excel::import($import, $this->fileUpload);

        // dd('Row count: ' . $import->getRowCount());


        if( Excel::import(new StudentsInfoImport($this->programs_id ), $this->fileUpload)){
            $this->ceckIfIsDataIn();
            $this->dispatch('success-opration');
            $this->info = false;
        }
    }


    protected function ceckIfIsDataIn(){
        $data = CopyOfStudentSchoolInfo::get()->count();

        if($data > 0){
            CopyOfStudentSchoolInfo::whereNotNull('id')->delete();;
        }
    }
}
