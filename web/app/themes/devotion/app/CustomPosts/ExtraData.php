<?php

namespace App\CustomPosts;

class ExtraData
{
    public $postType = 'extra_data';

    public $args = [
        'public' => true,
        'label' => 'Extra Data',
        'menu_icon' => 'dashicons-book-alt',
        'supports' => ['title'],
        'menu_position' => 30,
        'has_archive' => false,
        'publicly_queryable' => false,
    ];
}

return new ExtraData;
