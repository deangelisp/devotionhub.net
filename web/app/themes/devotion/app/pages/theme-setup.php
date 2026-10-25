<?php
// Check if ACF is active
if (!class_exists('acf')) {
    // Display a notice if ACF is not active
    echo '<div class="notice notice-error"><p>Please activate the Advanced Custom Fields plugin.</p></div>';
    return;
}

// Create pages
// $pages = ['About', 'Contact'];
// foreach ($pages as $page_title) {
//     $page = get_page_by_title($page_title);
//     if (!$page) {
//         wp_insert_post([
//             'post_title' => $page_title,
//             'post_status' => 'publish',
//             'post_type' => 'page',
//         ]);
//     }
// }

// echo '<div class="notice notice-success is-dismissible">
//             <p>Theme setup is complete.</p>
//         </div>';
