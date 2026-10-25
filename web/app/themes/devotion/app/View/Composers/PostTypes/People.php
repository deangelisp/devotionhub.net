<?php

namespace App\View\Composers\PostTypes;

use Roots\Acorn\View\Composer;
use WP_Query;

class People extends Composer
{
    protected static $views = [
        //
    ];

    public function with()
    {
        return [
            //
        ];
    }

    public static function getAllPeople($filter)
    {
        $args = [
            'post_type' => 'people',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num title',
            'meta_key' => 'order',
            'order' => 'ASC',
            'meta_query' => [
                'relation' => 'AND',
            ],
        ];

        if ($filter) {
            foreach ($filter as $f) {

                if (!empty($f['department'])) {
                    $args['meta_query'][] = [
                        'key' => 'department',
                        'value' => $f['department'],
                        'compare' => $f['operator'],
                    ];
                } else {
                    $args['meta_query'][] = [
                        'key' => $f['group'],
                        'value' => $f['role'],
                        'compare' => $f['operator'],
                    ];
                }
            }
        }

        $query = new WP_Query($args);

        $people = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $image = false;

                if (has_post_thumbnail()) {
                    $image = get_post_thumbnail_id(get_the_ID());
                } else {
                    $image = get_field('settings_general_default_thumbnail', 'option');
                }

                $image = wp_get_attachment_image($image, 'medium', false, ['class' => 'thumbnail']);

                $people[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'role' => get_field('role'),
                    'email' => get_field('email'),
                    'phone' => get_field('phone'),
                    'department' => get_field('department'),
                    'content' => get_field('content'),
                    'image' => $image,
                ];
            }
        }

        return $people;
    }
}
