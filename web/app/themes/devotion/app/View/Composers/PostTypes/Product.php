<?php

namespace App\View\Composers\PostTypes;

use Roots\Acorn\View\Composer;
use WP_Query;

class Product extends Composer
{
    protected static $views = [
        'woocommerce.loop.result-count',
        'woocommerce.archive-product',

        'woocommerce\loop\result-count',
        'woocommerce\archive-product',

    ];

    public function with()
    {

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'product',
            // 'posts_per_page' => 4,
            'paged' => $paged,
        ];

        $query = new WP_Query($args);

        return [
            'resultsTotalMessage' => $this->resultsTotalMessage($query),
            'title' => $this->title(),
            'query' => $query,
        ];
    }

    private function title()
    {
        return woocommerce_page_title(false);
    }

    private function resultsTotalMessage($query)
    {
        $total = $query->found_posts;
        $per_page = $query->query_vars['posts_per_page'];
        $current = $query->query_vars['paged'];

        if (1 === intval($total)) {
            return __('Showing the single result', 'woocommerce');
        } elseif ($total <= $per_page || -1 === $per_page) {
            /* translators: %d: total results */
            return sprintf(_n('Showing all %d result', 'Showing all %d results', $total, 'woocommerce'), $total);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last = min($total, $per_page * $current);
            /* translators: 1: first result 2: last result 3: total results */
            return sprintf(_nx('Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'woocommerce'), $first, $last, $total);
        }
    }
}
