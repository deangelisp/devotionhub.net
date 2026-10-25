<?php

namespace App;

add_action('admin_menu', function () {

    global $submenu;

    // Add Email page
    add_theme_page('Email', 'Email', 'manage_options', 'preview-email', function () {
        $theme_dir = get_template_directory();
        require_once $theme_dir . '/app/pages/preview-email.php';
    });

    // Remove default menu items
    unset($submenu['themes.php'][5]); // Customize link
    unset($submenu['themes.php'][6]); // Customize link
    unset($submenu['themes.php'][8]); // Customize link

    // Main Admin
    // check if is the user number 1
    if (get_current_user_id() != 1) {
        unset($submenu['themes.php'][7]); // Customize link

        // hide tool menu-tools
        remove_menu_page('tools.php');
    }

    global $submenu;

    if (wp_get_current_user()->ID != 1) {
        remove_menu_page('tools.php'); //Tools
        remove_menu_page('plugins.php'); //Plugins
        // remove_menu_page('themes.php'); //Appearance
        remove_menu_page('options-general.php'); //Tools
        remove_menu_page('edit.php?post_type=acf-field-group'); //Custom Fields
        remove_submenu_page('index.php', 'update-core.php'); //Updates
    }
});

// Remove the Customize And commetns link from the admin bar
add_action('admin_bar_menu', function ($wp_admin_bar) {
    $wp_admin_bar->remove_node('customize');
    $wp_admin_bar->remove_node('comments');
}, 999);
