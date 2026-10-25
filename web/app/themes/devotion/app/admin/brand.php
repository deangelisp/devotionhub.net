<?php

/**
 * Remove WordPress admin bar menu
 */
function remove_wp_logo($wp_admin_bar)
{
    $wp_admin_bar->remove_node('wp-logo');
}

/**
 * Replace login screen logo link
 */
function login_logo_url($url)
{
    return 'https://www.legendhasit.co.nz';
}

// Replace login logo title
function login_logo_title()
{
    return 'Built by Legend';
}

// Create custom admin bar m enu
function create_menu()
{
    global $wp_admin_bar;

    //get theme dir uri
    $theme_uri = get_template_directory_uri();

    $logo_svg = $theme_uri . '/resources/images/svg/legend-logo.svg';

    $wp_admin_bar->add_node([
        'id' => 'legend-logo',
        'title' => '<div class="wp-admin-bar-lsw-logo">' . file_get_contents($logo_svg) . '</div>',
        'href' => 'https://legendhasit.co.nz',
        'meta' => ['target' => '_blank', 'rel' => 'noopener'],
    ]);
}

/**
 * Replace login screen logo
 */
function menu_custom_logo()
{
    ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/resources/styles/admin/wp-admin-bar.css'; ?>">
<?php
}

/**
 * Add "designed and developed..." to admin footer.
 */
function admin_footer($content)
{
    return 'Website built by <a target="_blank" rel="noopener" href="https://legendhasit.co.nz">Legend</a>';
}

// add_action('login_enqueue_scripts', 'login_logo');
add_filter('admin_footer_text', 'admin_footer', 11);
add_action('admin_bar_menu', 'remove_wp_logo', 999);
add_action('admin_bar_menu', 'create_menu', 1);
add_action('wp_before_admin_bar_render', 'menu_custom_logo');
add_filter('login_headerurl', 'login_logo_url');
add_filter('login_headertext', 'login_logo_title');