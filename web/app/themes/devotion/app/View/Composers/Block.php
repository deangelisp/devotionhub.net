<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Block extends Composer
{
    protected static $views = [
        'partials.blocks.init',
    ];

    public function with()
    {
        return [
            'blocks' => $this->blocks(),
        ];
    }

    private function blocks()
    {

        $post_id = get_true_post_id();

        return get_field('page_builder_blocks', $post_id) ?: [];
    }
}
