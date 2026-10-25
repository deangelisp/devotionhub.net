<?php

namespace App\View\Classes;

class LegendIntelligence
{
    public $custom_posts = [
        'extra_data' => [
            'name' => 'extra_data',
            'shortcodes' => [
                'title' => [
                    'title' => 'Title',
                    'type' => 'post-title',
                    'label' => '',
                ],
                'keywords' => [
                    'title' => 'Keywords',
                    'type' => 'acf-text',
                    'label' => '',
                ],
                'passage' => [
                    'title' => 'passage',
                    'type' => 'acf-text',
                    'label' => '',
                ],
            ],
        ],
    ];

    public function __construct()
    {
    }

    public function names()
    {
        $names = [];

        foreach ($this->custom_posts as $post) {
            $names[] = $post['name'];
        }

        return $names;
    }

    public function shortcodes($post_type)
    {

        foreach ($this->custom_posts as $post) {
            if ($post['name'] === $post_type) {
                return $post['shortcodes'];
            }
        }

        return false;
    }
}
