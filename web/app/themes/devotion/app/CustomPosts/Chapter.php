<?php

namespace App\CustomPosts;

class Chapter
{
    public $postType = 'bible_chapter';

    public $args = [
        'public' => true,
        'label' => 'Bible Chapters',
        'menu_icon' => 'dashicons-book-alt',
        'supports' => ['title', 'revisions', 'excerpt', 'thumbnail'],
        'menu_position' => 26,
        'has_archive' => false,
        'publicly_queryable' => false,
        'rewrite' => false,
        'show_in_rest' => true,
    ];

    public $taxonomies = ['book'];
}

return new Chapter;
