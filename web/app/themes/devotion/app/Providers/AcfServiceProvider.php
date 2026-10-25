<?php

namespace App\Providers;

use Roots\Acorn\ServiceProvider;

class AcfServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        if (function_exists('acf_add_options_page')) {

            // $theme_uri = get_template_directory_uri();

            // $icon_svg = $theme_uri . '/resources/images/svg/legend-icon.svg';
            $icon_svg = get_template_directory() . '/resources/images/svg/legend-icon.svg';

            acf_add_options_page(array(
                'page_title' => 'Website Options Settings',
                'menu_title' => 'Website Options',
                'menu_slug' => 'website-options',
                'capability' => 'edit_posts',
                'redirect' => false,
                'icon_url' => 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($icon_svg)),
                'position' => '70',
            ));

            // Add sub page.
            // $child = acf_add_options_sub_page(array(
            //     'page_title' => 'Static Blocks',
            //     'menu_title' => 'Static Blocks',
            //     'parent_slug' => 'website-options',
            // ));

            // Add sub page.
            if (function_exists('is_woocommerce') && is_woocommerce()) {
                $child = acf_add_options_sub_page(array(
                    'page_title' => 'Woocommerce',
                    'menu_title' => 'Woocommerce',
                    'parent_slug' => 'website-options',
                ));
            }

            $child = acf_add_options_sub_page(array(
                'page_title' => 'Blocks Management',
                'menu_title' => 'Blocks Management',
                'parent_slug' => 'website-options',
            ));
        }
    }
}
