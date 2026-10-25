<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH')) {
    exit();
}

?>
<form class="plain-form flex items-center justify-end" method="get">
    <label class="text-dark-tone">Sort:</label>
    <select name="orderby" class="orderby plain-input font-semibold w-" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>">
        <option value="popularity">sort by popularity</option>
        <option value="date" selected="selected">sort by latest</option>
        <option value="price">price: low to high</option>
        <option value="price-desc">price: high to low</option>
    </select>
    <input type="hidden" name="paged" value="1" />
    <?php wc_query_string_form_fields(null, ['orderby', 'submit', 'paged', 'product-page']); ?>
</form>
