<?php

namespace App\View\Composers\PostTypes;

use Roots\Acorn\View\Composer;
use WP_Query;

class Post extends Composer
{
    protected static $views = [
        'index',
        'author',
    ];

    public function with()
    {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'post',
            'paged' => $paged,
        ];

        $query = new WP_Query($args);

        $vars = [
            'query' => $query,
            'type' => false,
        ];

        return $vars;
    }
}
