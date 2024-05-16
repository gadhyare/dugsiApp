<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Faker\Provider\Image;
use Livewire\WithFileUploads;

class Filesmanager extends Component
{
    use WithFileUploads;
    public $image;
    public $message = [] ;
    public function render()
    {
        return view('livewire.admin.filesmanager');
    }


    public function updatedPhoto( )
    {
        $this->validate([
            'image' => 'required',
        ]);
    }


    public function uploadFile()
    {
        // $this->validate([
        //     'image' => 'required',
        // ]);


       if($this->image->store('/attachments' , 'public')){
        $this->message = ['success' , 'تم الرفع بنجاح'];

       }else{
        $this->message = ['danger' , 'فشل العملية'];

       }
       $this->reset();
    }
}
