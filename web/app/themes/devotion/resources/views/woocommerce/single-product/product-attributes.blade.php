<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit();

if (!$product_attributes) {
    return;
}
?>
<div class="border border-light-tone radius w-full">
    @foreach ($product_attributes as $key => $product_attribute)
        <div
            class="flex items-center @if ($loop->even) bg-light-tone @endif  @if (!$loop->last) border-b border-light-tone @endif py-3 px-5">
            <p class="font-bold w-52">{!! wp_kses_post($product_attribute['label']) !!}</p>
            <p>{!! wp_kses_post($product_attribute['value']) !!}</p>
        </div>
    @endforeach
</div>
