<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateModal extends Component
{

    public string $btnTitle = "";
    public string $size = "";
    /**
     * Create a new component instance.
     */

    public   $recId ;
     public $action;
     public $getInfo;
    public function __construct(string  $btnTitle)
    {
        $this->btnTitle = $btnTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.update-modal');
    }
}
