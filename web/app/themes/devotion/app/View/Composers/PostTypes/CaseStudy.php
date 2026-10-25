<?php

namespace App\View\Composers\PostTypes;

use Roots\Acorn\View\Composer;
use WP_Query;

class CaseStudy extends Composer
{
    protected static $views = [
        'template-case-study-archive',
    ];

    public function with()
    {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'case_study',
            'paged' => $paged,
        ];

        $query = new WP_Query($args);

        return [
            'query' => $query,
        ];
    }
}
