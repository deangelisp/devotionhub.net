<?php

if (!function_exists('woocommerce_template_assistant')) {
    function woocommerce_template_assistant()
    {
        wc_get_template('single-product/assistant.php');
    }
}

if (!function_exists('woocommerce_template_iconboxes')) {
    function woocommerce_template_iconboxes()
    {
        wc_get_template('single-product/icon-boxes.php');
    }
}

if (!function_exists('woocommerce_template_taxonomies')) {
    function woocommerce_template_taxonomies()
    {
        wc_get_template('single-product/taxonomies.php');
    }
}
