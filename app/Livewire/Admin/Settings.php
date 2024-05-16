<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Settings as SettingsModel;
class Settings extends Component
{
    use WithPagination;
    public $name;
    public $description;
    public $address;
    public $phones;
    public $email;
    public $url;
    public $logo;
    public $close_message;


    public $active = 1;


    public $updateId;

    public $btnTitle = "اضافة";

    public $checkValue;

    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'address' => 'required',
        'phones' => 'required',
        'email' => 'required',
        'url' => 'required',
        'close_message' => 'required',
        'active' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';



    public function mount()
    {
        $this->checkValue = SettingsModel::count();

        if($this->checkValue > 0){
            $set = SettingsModel::first();
            $this->name          =  $set->name;
            $this->description   =  $set->description;
            $this->address       =  $set->address;
            $this->phones        =  $set->phones;
            $this->email         =  $set->email;
            $this->url           =  $set->url;
            $this->active        =  $set->active;
            $this->close_message =  $set->close_message;
            $this->logo = $set->logo;
        }

    }
    public function render()
    {

        return view('livewire.admin.settings' );
    }



    public function updateRec( )
    {

        $this->validate();

        if($this->checkValue > 0){
            $set = SettingsModel::first();
            $set->name          =  $this->name;
            $set->description   =  $this->description;
            $set->address       =  $this->address;
            $set->phones        =  $this->phones;
            $set->email         =  $this->email;
            $set->url           =  $this->url;
            $set->active        =  $this->active;
            $set->close_message =  $this->close_message;

            $set->update();
        }else{
            $set = new SettingsModel();

                $set->name          =  $this->name;
                $set->description   =  $this->description;
                $set->address       =  $this->address;
                $set->phones        =  $this->phones;
                $set->email         =  $this->email;
                $set->url           =  $this->url;
                $set->active        =  $this->active;
                $set->close_message =  $this->close_message;

                $set->save();
        }


    }


}
