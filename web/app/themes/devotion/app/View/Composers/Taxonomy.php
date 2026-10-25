<?php

namespace App\View\Composers;

use App\View\Composers\App as AppComposer;
use Roots\Acorn\View\Composer;
use WP_Query;

class Taxonomy extends Composer
{
    protected static $views = [
        'category',
        'tag',
        'taxonomy',
        // Add other taxonomy-related views as needed
    ];

    public function with()
    {
        $queriedObject = get_queried_object();

        return [
            'query' => $this->query($queriedObject),
            'termTitle' => $this->termTitle($queriedObject),
            'termContent' => $this->termContent($queriedObject),
            'type' => $this->postType(),
            'noPostsFoundTitle' => AppComposer::noPostsFoundTitle(),
            'noPostsFoundMessage' => AppComposer::noPostsFoundMessage(),
            'description' => $this->description(),
        ];
    }

    private function query($queriedObject)
    {
        $paged = get_query_var('paged') ?: 1;

        $args = [
            'paged' => $paged,
            'tax_query' => $this->buildTaxQuery($queriedObject),
        ];

        return new WP_Query($args);
    }

    private function buildTaxQuery($queriedObject)
    {
        if (!$queriedObject) {
            return [];
        }

        return [
            [
                'taxonomy' => $queriedObject->taxonomy,
                'field' => 'term_id',
                'terms' => $queriedObject->term_id,
            ],
        ];
    }

    private function termTitle($queriedObject)
    {
        return $queriedObject ? $queriedObject->name : '';
    }

    private function termContent($queriedObject)
    {
        return $queriedObject ? $queriedObject->description : '';
    }

    private function postType()
    {
        return 'post';
    }

    private function description()
    {
        return get_field('taxonomy_description', 'term_' . get_queried_object_id());
    }

}
