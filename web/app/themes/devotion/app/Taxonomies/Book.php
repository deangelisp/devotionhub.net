<?php

namespace App\Taxonomies;

class Book
{
    public $taxonomy = 'book';
    public $postType = [];

    public $args = [
        'public' => false,
        'label' => 'Bible Book',
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,

    ];
}

return new Book;
