<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonsList extends Component
{

    public $buttons;
    public $className;

    public function __construct(
        $buttons = false,
        $className = false,
    ) {
        $this->buttons = $buttons;
        $this->className = $className;
    }

    public function render()
    {
        return view('components.buttons-list');
    }
}
