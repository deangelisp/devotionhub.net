<?php

namespace App\CustomPosts;

class Verse
{
    public $postType = 'bible_verse';

    public $args = [
        'public' => true,
        'label' => 'Bible Verse',
        'menu_icon' => 'dashicons-book-alt',
        'supports' => ['title', 'thumbnail'],
        'menu_position' => 27,
        'has_archive' => false,
        'publicly_queryable' => false,
        'rewrite' => false,
        'show_in_rest' => true,
    ];
}

return new Verse;
