<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AccordionList extends Component
{

    public $items;
    public $className;

    public function __construct(
        $items = false,
        $className = false
    ) {
        $this->items = $items;
        $this->className = $className;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.accordion-list');
    }
}
