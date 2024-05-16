<?php

namespace App\Livewire\Admin\Exams;

use Livewire\Attributes\Url;
use Livewire\Component;

class Exam extends Component
{

    #[Url()]
    public $pro_id;
    public function render()
    {
        return view('livewire.admin.exams.exam');
    }
}
