<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonPagination extends Component
{

    public $url;
    public $title;
    public $subtitle;
    public $side;

    public function __construct(
        $url = null,
        $title = null,
        $subtitle = null,
        $side = 'right'
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->side = $side;
    }

    public function render()
    {
        return view('components.button-pagination');
    }
}
