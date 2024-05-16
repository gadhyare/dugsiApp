<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteConfirm extends Component
{
    public string $btnTitle = "";
    public   $recId ;
    /**
     * Create a new component instance.
     */
    public function __construct(string $btnTitle,$recId)
    {
        $this->btnTitle = $btnTitle;
        $this->recId = $recId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-confirm');
    }
}
