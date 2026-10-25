<?php

namespace App\CustomPosts;

class CallToAction
{
    public $postType = 'call_to_action';

    public $args = [
        'public' => true,
        'label' => 'Call to Actions',
        'menu_icon' => 'dashicons-megaphone',
        'supports' => ['title', 'revisions'],
        'publicly_queryable' => false,
        'rewrite' => false,
        'menu_position' => 24,
    ];
}

return new CallToAction;
