<?php

namespace App\CustomPosts;

class Course
{
    public $postType = 'course';

    public $args = [
        'public' => true,
        'label' => 'Courses',
        'menu_icon' => 'dashicons-book-alt',
        'supports' => ['title', 'excerpt', 'thumbnail'],
        'menu_position' => 29,
        'has_archive' => false,
        'rewrite' => ['slug' => 'bible-study'],
    ];
}

return new Course;
