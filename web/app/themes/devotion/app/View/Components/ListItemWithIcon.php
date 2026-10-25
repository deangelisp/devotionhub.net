<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListItemWithIcon extends Component
{

    public $icon;
    public $title;

    public function __construct(
        $icon = 'box',
        $title = false
    ) {
        $this->icon = $icon;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.list-item-with-icon');
    }
}
