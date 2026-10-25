<?php

namespace App\View\Components\blocks\Utilities;

use Illuminate\View\Component;

class Anchor extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->anchor = $block['anchor'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.utilities.anchor', [
            'anchor' => $this->anchor,
        ]);
    }
}
