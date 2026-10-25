<?php

namespace App\CustomPosts;

class LogoCloudPost
{
    public $postType = 'logo_cloud';

    public $args = [
        'public' => true,
        'label' => 'Logo Cloud',
        'menu_icon' => 'dashicons-cloud',
        'supports' => ['title', 'thumbnail'],
        'menu_position' => 29,
        'has_archive' => false,
        'publicly_queryable' => false,
        'rewrite' => false,
    ];

    public $taxonomies = ['logo_cloud_cat'];
}

return new LogoCloudPost;
