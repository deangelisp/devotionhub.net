<?php

namespace App\View\Components\blocks\Utilities;

use Illuminate\View\Component;

class ReusableBlock extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id = null,
        $block = null,
    ) {

        $post_id = $block['reusable_block'];
        $this->blocks = get_field('page_builder_blocks', $post_id) ?: [];
    }

    public function render()
    {
        return view('components.blocks.utilities.reusable-block', [
            'blocks' => $this->blocks,
        ]);
    }
}
