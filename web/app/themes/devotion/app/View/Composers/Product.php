<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Product extends Composer
{

    public $product;

    protected static $views = [
        'woocommerce.single-product.meta',
        'woocommerce.single-product.title',
        'woocommerce.single-product.price',
        'woocommerce.single-product.short-description',
        'woocommerce.single-product.assistant',
        'woocommerce.single-product.icon-boxes',
        'woocommerce.single-product.taxonomies',
        'woocommerce.single-product.sale-flash',

        'woocommerce\single-product\meta',
        'woocommerce\single-product\title',
        'woocommerce\single-product\price',
        'woocommerce\single-product\short-description',
        'woocommerce\single-product\assistant',
        'woocommerce\single-product\icon-boxes',
        'woocommerce\single-product\taxonomies',
        'woocommerce\single-product\sale-flash',
    ];

    public function with()
    {

        $this->product = wc_get_product(get_the_ID());

        return [
            'sku' => $this->sku(),
            'title' => $this->title(),
            'isInStock' => $this->isInStock(),
            'priceHtml' => $this->priceHtml(),
            'shortDescription' => $this->shortDescription(),
            'assistant' => $this->assistant(),
            'iconBoxes' => $this->iconBoxes(),
            'taxonomies' => $this->taxonomies(),
            'onSale' => $this->onSale(),
        ];
    }

    private function sku()
    {
        return $this->product->get_sku();
    }

    private function title()
    {
        return get_the_title();
    }

    private function isInStock()
    {
        $status = $this->product->is_in_stock();

        switch ($status) {
            case true:
                return 'In Stock';
            case false:
                return 'Out of Stock';
            default:
                return 'Out of Stock';
        }
    }

    private function priceHtml()
    {
        return $this->product->get_price_html();
    }

    private function shortDescription()
    {
        return apply_filters('woocommerce_short_description', $this->product->get_short_description());
    }

    private function assistant()
    {
        $user = get_field('settings_woocommerce_single_product_assistant', 'option');

        if ($user) {

            $display_name = get_the_author_meta('display_name', $user);

            $img = get_avatar_url($user, ['size' => '62']);

            $img = "<img src='{$img}' alt='{$display_name}' class='avatar avatar-62 photo' height='62' width='62' />";

            return [
                'name' => $display_name,
                'avatar' => $img,
            ];
        }

        return false;
    }

    private function iconBoxes()
    {
        $iconboxes = get_field('settings_woocommerce_single_product_iconboxes', 'option');

        if ($iconboxes) {

            $iconboxes = array_map(function ($iconbox) {
                $icon = wp_get_attachment_image($iconbox['icon'], 'thumbnail', false, ['class' => 'thumbnail object-contain']);
                $title = $iconbox['title'];
                $description = $iconbox['description'];

                return [
                    'icon' => $icon,
                    'title' => $title,
                    'description' => $description,
                ];
            }, $iconboxes);

            return $iconboxes;
        }

        return false;

    }

    public function taxonomies()
    {
        $categories = get_the_terms(get_the_ID(), 'product_cat');
        $tags = get_the_terms(get_the_ID(), 'product_tag');

        $taxonomies = [];

        if ($categories) {

            $taxonomies['categories'] = [
                'label' => 'Categories',
                'items' => [],
            ];

            foreach ($categories as $category) {
                $taxonomies['categories']['items'][] = [
                    'title' => $category->name,
                    'url' => get_term_link($category->term_id, 'product_cat'),
                ];
            }
        }

        if ($tags) {

            $taxonomies['tags'] = [
                'label' => 'Tags',
                'items' => [],
            ];

            foreach ($tags as $tag) {
                $taxonomies['tags']['items'][] = [
                    'title' => $tag->name,
                    'url' => get_term_link($tag->term_id, 'product_tag'),
                ];
            }
        }

        return $taxonomies;
    }

    public function onSale()
    {
        if ($this->product->is_on_sale()) {
            $regular_price = $this->product->get_regular_price();
            $sale_price = $this->product->get_sale_price();

            if ($regular_price > 0 && $sale_price < $regular_price) {
                $discount_percentage = (($regular_price - $sale_price) / $regular_price) * 100;
                return round($discount_percentage);
            }
        }

        return false;
    }
}
