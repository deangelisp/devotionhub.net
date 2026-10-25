<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CrossReferences extends Component
{

    public $crossReferences;
    public $title;

    public function __construct($crossReferences = null, $title = null)
    {
        $this->crossReferences = $crossReferences;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.cross-references');
    }
}
