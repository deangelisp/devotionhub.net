<?php

namespace App\CustomPosts;

class ReusableBlocks
{
    public $postType = 'reusable_blocks';

    public $args = [
        'public' => true,
        'label' => 'Reusable Blocks',
        'menu_icon' => 'dashicons-controls-repeat',
        'supports' => ['title'],
        'publicly_queryable' => false,
        'rewrite' => false,
        'menu_position' => 29,
    ];
}

return new ReusableBlocks;
