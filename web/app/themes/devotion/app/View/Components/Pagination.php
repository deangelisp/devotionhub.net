<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{

    public $maxNumPages;
    public $prev;
    public $next;

    public function __construct(
        $maxpages = null
    ) {
        $this->maxNumPages = $maxpages;
        $this->prev = get_svg('images.svg.icons.arrow-left', ['w-3 h-3 fill-slate-400']);
        $this->next = get_svg('images.svg.icons.arrow-right', ['w-3 h-3 fill-slate-400']);
    }

    public function render()
    {
        return view('components.pagination');
    }
}
