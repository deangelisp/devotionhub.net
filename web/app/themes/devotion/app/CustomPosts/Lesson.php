<?php

namespace App\CustomPosts;

class Lesson
{
    public $postType = 'lesson';

    public $args = [
        'public' => true,
        'label' => 'Lessons',
        'menu_icon' => 'dashicons-book-alt',
        'supports' => ['title', 'excerpt', 'editor'],
        'menu_position' => 28,
        'has_archive' => false,
        'publicly_queryable' => false,
        'rewrite' => false,
        'show_in_rest' => true,
    ];
}

return new Lesson;
