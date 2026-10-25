<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    global $wp_styles;

    bundle('app')->enqueue();

    // check if is admin
    if (is_admin()) {
        return;
    }

    if (hasGallery()) {
        bundle('lightbox')->enqueue();
        wp_enqueue_script('photoswipe/skin.js', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.0/photoswipe-ui-default.min.js', false, null, [
            'strategy' => 'defer',
        ]);
        wp_enqueue_style('photoswipe/skin.css', 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.0/default-skin/default-skin.css', false, null);
    }
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Enqueue custom CSS for admin
 */
add_action('admin_enqueue_scripts', function () {
    bundle('admin')->enqueue();
});

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    add_theme_support('editor-styles');
    $relAppCssPath = asset('editor.css')->relativePath(get_theme_file_path());
    add_editor_style($relAppCssPath);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('widgets');
}, 20);

add_action('after_setup_theme', function () {

    // Include Taxonomies
    collect(glob(get_template_directory() . '/app/Taxonomies/*.php'))
        ->map(function ($file) {
            return include_once ($file);
        })
        ->each(function ($taxonomy) {
            if (function_exists('register_taxonomy')) {
                register_taxonomy($taxonomy->taxonomy, $taxonomy->postType, $taxonomy->args);
            }
        });
});

// Register post theme setup
add_action('acf/init', function () {

    if (defined('DOING_AJAX') && DOING_AJAX) {
        $action = $_POST['action'] ?? null;
        if ($action && strpos($action, 'acf/fields') === false) {
            return;
        }
    }
    // Include ACF Builder fields
    // Cheatsheet: https://github.com/Log1x/acf-builder-cheatsheet
    collect(glob(get_template_directory() . '/app/Fields/*.php'))
        ->map(function ($file) {
            return include_once ($file);
        })
        ->each(function ($fieldsBuilder) {
            if ($fieldsBuilder && function_exists('acf_add_local_field_group')) {
                acf_add_local_field_group($fieldsBuilder->build());
            }
        });
}, 1);

add_action('after_setup_theme', function () {

    // // /**
    // //  * Include Custom Post Types
    // //  */

    collect(glob(get_template_directory() . '/app/CustomPosts/*.php'))
        ->map(function ($file) {
            return include_once ($file);
        })
        ->each(function ($customPost) {
            if (function_exists('register_post_type')) {
                register_post_type($customPost->postType, $customPost->args);

                if (isset($customPost->taxonomies)) {
                    foreach ($customPost->taxonomies as $taxonomy) {
                        register_taxonomy_for_object_type($taxonomy, $customPost->postType);
                    }
                }
            }
        });

    // Check is doing ajax
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    // /**
    //  * Include Shortcodes
    //  */
    collect(glob(get_template_directory() . '/app/Shortcodes/*.php'))
        ->map(function ($file) {
            return include_once ($file);
        })
        ->each(function ($shortcode) {
            if (function_exists('add_shortcode')) {
                add_shortcode($shortcode->shortcode, [$shortcode, 'render']);
            }
        });

    // /**
    //  * Include tinyMCE
    //  */
    collect(glob(get_template_directory() . '/app/tinyMCE/*.php'))
        ->map(function ($file) {
            return include_once ($file);
        });

    /*
     * Include admin  setup
     */
    collect(glob(get_template_directory() . '/app/admin/*.php'))
        ->map(function ($file) {
            return include_once ($file);
        });

}, 20);

// Include PostMetas
add_action("add_meta_boxes", function () {
    collect(glob(get_template_directory() . '/app/PostMetas/*.php'))
        ->map(function ($file) {
            return include_once ($file);
        })
        ->each(function ($postMeta) {
            if (function_exists('add_meta_box')) {
                add_meta_box($postMeta->id, $postMeta->title, [$postMeta, 'render'], $postMeta->postType, 'normal', 'high');
            }
        });
});

// Add Classic Editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// Excerpt to Pages
add_post_type_support('page', 'excerpt');

// Remove Boxes in WordPress Dashboard
add_action('wp_dashboard_setup', function () {
    global $wp_meta_boxes;
    $wp_meta_boxes['dashboard']['normal']['core'] = [];
    $wp_meta_boxes['dashboard']['side']['core']   = [];
});

//Automatically Set the WordPress Image Title, Alt-Text & Other Meta
add_action('add_attachment', function ($post_ID) {
    // Check if uploaded file is an image, else do nothing
    if (wp_attachment_is_image($post_ID)) {

        $my_image_title = get_post($post_ID)->post_title;

        // Sanitize the title:  remove hyphens, underscores & extra spaces:
        $my_image_title = preg_replace('%\s*[-_\s]+\s*%', ' ', $my_image_title);

        // Sanitize the title:  capitalize first letter of every word (other letters lower case):
        $my_image_title = ucwords(strtolower($my_image_title));

        update_post_meta($post_ID, '_wp_attachment_image_alt', $my_image_title);

    }
});

//
// SMTP  Mandrill Settings
//
add_action('phpmailer_init', function ($phpmailer) {
    $settings_mandrill = get_field('settings_email_mandrill', 'option');

    if (empty($settings_mandrill['api_key'])) {
        $option_api_key              = get_option('options_settings_email_mandrill_api_key');
        $option_sender_name          = get_option('options_settings_email_mandrill_sender_name');
        $option_sender_email_address = get_option('options_settings_email_mandrill_sender_email_address');

        if (empty($option_api_key)) {
            return;
        }

        $settings_mandrill = [
            'api_key'              => $option_api_key,
            'sender_name'          => $option_sender_name,
            'sender_email_address' => $option_sender_email_address,
        ];
    }

    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.mandrillapp.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587;
    $phpmailer->Username   = 'Legend';
    $phpmailer->Password   = $settings_mandrill['api_key'];
    $phpmailer->SMTPSecure = 'tls';

    if (! empty($settings_mandrill['sender_name'])) {
        $phpmailer->FromName = $settings_mandrill['sender_name'];
    }

    if (! empty($settings_mandrill['sender_email_address'])) {
        $phpmailer->From = $settings_mandrill['sender_email_address'];
    }
});

add_action('wp_head', function () {

    // Prefetch
    echo '<link rel="dns-prefetch" href="//google-analytics.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//www.google-analytics.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//ssl.google-analytics.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//ajax.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//apis.google.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//apis.google.com">' . "\n";
    // Preconnect
    echo '<link rel="preconnect" href="https://cdn.google.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

    // Google Fonts Setup
    $fontUrl = "https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&Playfair+Display:ital,wght@0,400..900;1,400..900&&display=swap";

    echo '<link rel="preload" href="' . $fontUrl . '&display=swap" as="style">' . "\n";
    echo '<link href="' . $fontUrl . '&display=swap" rel="stylesheet" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    echo '<noscript><link href="' . $fontUrl . '&display=swap" rel="stylesheet"></noscript>' . "\n";

    //Clarity and different of admin
    // if (! is_user_logged_in() || ! current_user_can('administrator')) {
    //     echo '<script type="text/javascript">' . "\n";
    //     echo '(function(c,l,a,r,i,t,y){' . "\n";
    //     echo 'c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};' . "\n";
    //     echo 't=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;' . "\n";
    //     echo 'y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);' . "\n";
    //     echo '})(window, document, "clarity", "script", "o8xl6e4mrn");' . "\n";
    //     echo '</script>' . "\n";
    // }

});

// Custom media sizes
add_action('after_setup_theme', function () {
    add_image_size('container', 1280, null, false);
    add_image_size('massive', 1920, null, false);
});

/**
 * Disable from admin menu
 * - Comments
 */
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Disable coments to all post types

add_action('init', function () {
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}, 100);

//
// add_action('init',
//     function () {
//         if (!session_id()) {
//             session_start();
//         }
//     }, 1);

/**
 * Disable
 * - Appearance = Customize
 * - Welcome Panel
 * - block access to the themes.php page on your WordPress site for everyone except administrators
 * - Block comments
 */
add_action('admin_init', function () {
    // if (strpos($_SERVER['REQUEST_URI'], '/customize.php') !== false) {
    //     wp_die('Access to this page is restricted.');
    // }

    if (strpos($_SERVER['REQUEST_URI'], '/themes.php') !== false && ! current_user_can('administrator')) {
        wp_die('Sorry, you are not allowed to access this page.');
    }

    if (strpos($_SERVER['REQUEST_URI'], '/edit-comments.php') !== false) {
        wp_die('Sorry, you are not allowed to access this page.');
    }

    remove_action('welcome_panel', 'wp_welcome_panel');
});

// Modify canonical URLs for paginated pages
add_action('wp_head',
    function ($canonical) {
        global $paged, $wp;

        if (is_paged() && $paged >= 2) {

            $current_url = $wp->request;

            $pattern       = '/\/page\/.*$/';
            $canonical_url = preg_replace($pattern, '', $current_url);

            echo "\n" . '<link rel="canonical" href="' . home_url($canonical_url) . '/" />' . "\n";
        }

        return $canonical;
    });

// Disable Attachment Pages
add_action('template_redirect', function () {
    if (is_attachment()) {
        global $post;
        if ($post && $post->post_parent) {
            wp_redirect(get_permalink($post->post_parent), 301);
        } else {
            wp_redirect(home_url(), 301);
        }
        exit;
    }
});

// Preload Largest Contentful Paint (LCP) First Image Block
add_action('wp_head', function () {
    global $post;

    if (isset($post->ID)) {
        $blocks = get_field('page_builder_blocks', $post->ID);
        if ($blocks) {
            foreach ($blocks as $block) {
                if (isset($block['image'])) {
                    $image = $block['image'];

                    if ($image) {
                        $size = 'container';

                        if (wp_is_mobile()) {
                            $size = 'medium';
                        }

                        $image_src = wp_get_attachment_image_src($image, $size);
                        if ($image_src) {

                            echo '<link rel="preload" href="' . $image_src[0] . '" as="image">' . "\n";
                        }
                    }
                }
            }

        }
    }
});

// On Single Admin Page For custom post remove the view from admin bar
add_action('admin_bar_menu', function ($wp_admin_bar) {
    if (is_admin()) {
        $screen = get_current_screen();
        if ($screen->base == 'post' && ($screen->post_type == 'bible_chapters' || $screen->post_type == 'testimonial' || $screen->post_type == 'call_to_action' || $screen->post_type == 'reusable_blocks' || $screen->post_type == 'people')) {
            $wp_admin_bar->remove_node('view');
        }
    }
}, 999);

// Implementing Content Security Policy (CSP) in WordPress
add_action('send_headers', function () {
    if (! headers_sent() && WP_ENV == 'production') { // Check if headers have not been sent yet
                                                         //

        // header("Content-Security-Policy: script-src 'self' 'unsafe-inline' https://apis.google.com blob: https://www.googletagmanager.com https://static.cloudflareinsights.com; worker-src blob:; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com;");
        // header("Content-Security-Policy: script-src 'self' https://apis.google.com https://www.googletagmanager.com https://static.cloudflareinsights.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com;");

        // header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';");

    }

});

add_action('template_redirect',
    function () {

        if (get_query_var('bible_search')) {

            $books = get_books_schema();

            $search = $_GET['s'];

            $search = superSearch($search);

            $url = $search['url'];

            wp_redirect($url);

            exit;
        }
    });

// Sitelinks search box (WebSite) structured data
add_action('wp_head',

    function () {
        if (is_front_page()) {

            $url = home_url('/');

            echo "\n" . '<script type="application/ld+json">' . "\n";
            echo '{' . "\n";
            echo '"@context": "https://schema.org",' . "\n";
            echo '"@type": "WebSite",' . "\n";
            echo '"url": "' . $url . '",' . "\n";
            echo '"potentialAction": {' . "\n";
            echo '"@type": "SearchAction",' . "\n";
            echo '"target": {' . "\n";
            echo '"@type": "EntryPoint",' . "\n";
            echo '"urlTemplate": "' . $url . 'bible-search/?s={search_term_string}"' . "\n";
            echo '},' . "\n";
            echo '"query-input": "required name=search_term_string"' . "\n";
            echo '}' . "\n";
            echo '}' . "\n";
            echo '</script>' . "\n";
        }

        if (is_singular('course')) {
            $post_id = get_the_ID();
            echo generate_course_structured_data($post_id);
        }
    });

// Custom Canonical Urls
add_action('wp_head',

    function () {
        $url = strtok($_SERVER["REQUEST_URI"], '?');
        echo '<link rel="canonical" href="' . esc_url(home_url($url)) . '" />' . "\n";
    });

remove_action('wp_head', 'rel_canonical');

// Disable author page
add_action('template_redirect',
    function () {
        global $wp_query;
        if (is_author()) {
            wp_safe_redirect(get_option('home'), 301);
            exit;
        }
    });

add_action('pre_get_posts',
    function ($query) {
        if ($query->is_author) {
            $query->set_404();
        }
    });

add_action('template_redirect',
    function () {
        if (is_author()) {
            // Redirect any author page to the homepage
            wp_redirect(home_url());
            exit;
        }
    });

remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
