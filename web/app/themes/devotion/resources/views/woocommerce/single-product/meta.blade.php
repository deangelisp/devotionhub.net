<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit();
}
?>
<div class="product_meta flex items-center gap-5 mb-5 ">
    @if ($sku)
        <span class="sku_wrapper text-xs  text-dark-tone ">SKU: <span class="sku">{!! $sku !!}</span></span>
    @endif
    <x-chip color="{!! $isInStock == 'In Stock' ? 'success' : 'danger' !!}">
        @svg('images.svg.icons.box', 'w-3.5 h-3.5 fill-current')
        <span>{!! $isInStock !!}</span>
    </x-chip>
</div>
