<?php

namespace App\Livewire\Admin\FamilyNumber;

use App\Models\Students_info;
use Livewire\Component;
use Livewire\Attributes\Url;

class FamilyInfo extends Component
{
    #[Url()]
    public $fnumber;


    public function render()
    {
        $students = Students_info::where('family_number_id' , '=', $this->fnumber)->get();
        return view('livewire.admin.family-number.family-info' , compact('students') );
    }
}
