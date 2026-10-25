<?php

/**
 * Theme filters.
 */

namespace App;

//Add "… Continued" to the excerpt.
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

//Add Content Filter Format to the ACF Editor.
add_filter('acf/format_value/type=wysiwyg', function ($value, $post_id, $field) {
    // $value = apply_filters('the_content', $value);
    $value = shortcode_content_filter($value);

    return $value;
}, 10, 3);

/**
 * Add SVG to allowed mime types.
 * Remove exe mime type.
 */
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['doc'] = 'application/msword';

    unset($mimes['exe']);

    return $mimes;
});

//Hide ACF menu for All Users
add_filter('acf/settings/show_admin', '__return_false');

//
add_filter('shortcode_atts_gallery',
    function ($out, $pairs, $atts) {
        if ($out['link'] == 'post' || empty($out['link'])) {
            $out['link'] = 'none';
        }
        return $out;
    }, 10, 3);

//Add Lightbox to gallery
add_filter('wp_get_attachment_link', function ($link, $id) {
    $attachment_metadata = wp_get_attachment_metadata($id);

    return str_replace('<a href', '<a data-toggle="lightbox" data-height="' . $attachment_metadata['height'] . '" data-width="' . $attachment_metadata['width'] . '" data-gallery="gallery" href', $link);
}, 10, 2);

//Disable Login Language Selector
add_filter('login_display_language_dropdown', '__return_false');

// remove Custom POst from Search
add_filter('wp_link_query_args', function ($query) {
    $exclude_post_types = ['testimonial', 'people', 'call_to_action', 'history', 'reusable_blocks', 'logo_cloud'];
    $query['post_type'] = array_diff($query['post_type'], $exclude_post_types);
    return $query;
});

// add image to the flexible content component name
add_filter('acf/fields/flexible_content/layout_title', function ($title, $field, $layout, $i) {

    $category = get_sub_field('block_category_name');

    $title = strip_tags($title);
    $name = sanitize_title($title);
    $class_cat = sanitize_title($category);

    if ($category) {
        $title_container = '<span class="acf-fc-layout-preview category-' . $class_cat . '">';
        $title_container .= '<img width="64px" src="' . get_template_directory_uri() . '/resources/images/admin/acfBlockThumbs/' . $category . '/' . $name . '.png" class="acf-fc-layout-preview-thumb" />';
        $title_container .= '<span class="acf-fc-layout-preview-title">' . $title . '</span>';
        $title_container .= '</span>';

        $title = $title_container;
    }

    return $title;
}, 11, 4);

// Editor Conntet Filter - Remove P tags from images and iframes
function setup_the_content($content)
{

    $content = preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '<figure class="image-container">\2</figure>', $content);
    $content = preg_replace('/<p>\s*(<iframe.*>*.<\/iframe>)\s*<\/p>/iU', ' <div class="embed-container">\1</div>', $content);
    $content = str_replace('<p>&nbsp;</p>', '<p class="empty">&nbsp;</p>', $content);

    if (function_exists('wp_lazy_loading_enabled')) {
        // $content = preg_replace('/<img(.*?)src=/i', '<img$1src= loading="lazy"', $content);
        $content = preg_replace('/<img(.*?)src=/i', '<img$1 loading="lazy" src=', $content);
    }

    return $content;
}
add_filter('the_content', function ($content) {
    return setup_the_content($content);
});
add_filter('acf_the_content', function ($content) {

    $content = wpautop($content);

    return setup_the_content($content);
});

// Sets the maximum upload size limit for files 2MB
add_filter('wp_handle_upload_prefilter', function ($file) {
    $img_types = array('image/jpeg', 'image/png', 'image/gif');
    $max_size = 4 * 1024 * 1024; // 4MB in bytes

    // Image
    if (in_array($file['type'], $img_types) && $file['size'] > $max_size) {
        $file['error'] = 'Image files must be smaller than 4MB.';
    }

    // Video
    if (in_array($file['type'], array('video/mp4', 'video/ogg', 'video/webm')) && $file['size'] > 10 * 1024 * 1024) {
        $file['error'] = 'Video files must be smaller than 10MB.';
    }

    return $file;
}, 20);

// Add Custom Preload to wp enqueue style
add_filter('style_loader_tag', function ($html, $handle) {

    $handles = ['photoswipe/skin.css'];

    if (in_array($handle, $handles)) {
        $html = str_replace("rel='stylesheet'", "rel='preload' as='style' ", $html);
    }
    return $html;
}, 10, 2);

//Dequeue the Stylesheet wp-block-library-css
add_action('wp_enqueue_scripts',
    function () {
        wp_dequeue_style('wp-block-library-css');
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('global-styles');
    }, 100);

// Custom Post Type Admin Title Sign
add_filter('display_post_states',
    function ($post_states, $post) {
        $service_page_id = get_option('page_for_service');
        $case_study_page_id = get_option('page_for_case_study');

        if ((int) $post->ID === (int) $service_page_id) {
            $post_states['custom_post_type_archive'] = 'Services Page';
        }

        if ((int) $post->ID === (int) $case_study_page_id) {
            $post_states['custom_post_type_archive'] = 'Case Studies Page';
        }

        return $post_states;
    }, 10, 2);

// Change the default page template title
add_filter('default_page_template_title', function ($label, $context) {
    return 'Base - Default Template';
}, 10, 2);

//Automatic updates for plugins
add_filter('auto_update_plugin', '__return_true');

// disable wordpress sitemap
add_filter('wp_sitemaps_enabled', '__return_false');
