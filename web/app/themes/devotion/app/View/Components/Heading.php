<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Heading extends Component
{

    public $tag;
    public $className;
    public $uppertitle;

    public function __construct(
        $tag = 'h2',
        $className = '',
        $uppertitle = ''
    ) {
        $this->tag = $tag;
        $this->className = $className;
        $this->uppertitle = $uppertitle;
    }

    public function render()
    {
        return view('components.heading');
    }
}
