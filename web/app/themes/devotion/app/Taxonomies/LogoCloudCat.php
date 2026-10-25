<?php

namespace App\Taxonomies;

class LogoCloudCat
{
    public $taxonomy = 'logo_cloud_cat';
    public $postType = [];

    public $args = [
        'public' => true,
        'label' => 'Category',
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => false,
        'publicly_queryable' => false,
    ];
}

return new LogoCloudCat;
