<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Settings;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class MangeLogo extends Component
{

    use WithFileUploads;

    public $logo ;

    public $message= '';
    public function render()
    {
        $info = Settings::first();
        $contents = Storage::get('public/images/'.$info->logo); 
        return view('livewire.admin.settings.mange-logo' , compact('info', 'contents')  );
    }




    public function uploadlogo(){
        $this->validate([
            'logo' => 'required|image|max:1024'
        ]);

        $fileName = 'logo-'.time() . '.' . $this->logo->extension();
        $this->logo->storeAs('public/images/' , $fileName);
        $data = Settings::first();
        if($data){
            $data->logo = $fileName;
            $data->update();
            $this->reset('message');
        }else{
            $this->message =  "لا بيانات محفوظة للعمل عليها";
        }
    }
}
