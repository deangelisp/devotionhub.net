<?php

/*
 * Disable ACF Fields
 */

function disable_acf_load_field($field)
{
    $field['disabled'] = 1;
    return $field;
}

// add_filter('acf/load_field/name=FIELD_NAME_HERE', 'disable_acf_load_field');

// Add the label value to the Flexible Content field to help identify the layout
add_filter('acf/fields/flexible_content/layout_title', function ($title, $field, $layout, $i) {
    if ($value = get_sub_field('multicolumn_label')) {
        $title = "<span style='color: #919191;'>{$title}:</span> <span style='font-weight: 600;'>$value</span>";
    }
    return $title;
}, 10, 4);

// Anchor Block: Add the label value to the Anchor field to help identify the layout
add_filter('acf/load_field/name=anchor_link_message', function ($field) {
    if (!is_admin()) {
        return $field;
    }

    $permalink = get_permalink();
    $field['label'] = sprintf(
        '<p class="anchor-link-url" data-href="%1$s">%2$s#<span class="anchor-link-url-output"></span></p>',
        $permalink,
        $permalink
    );

    $field['message'] = '<div class="anchor-link-instructions"><p class="anchor-link-instructions-description">Copy the link and use it anywhere on the page to scroll to this position.</p><p style="position: relative"><span class="anchor-link-instructions-feedback">Link copied!</span><button type="button" data-copy-anchor-link class="button button-secondary anchor-link-button" ><span class="dashicons dashicons-admin-page"></span>Copy link</button></p></div>';

    return $field;
});

// Call To Actions Shortcode
add_filter('acf/load_field/name=call_to_action_settings_shortcode_message', function ($field) {
    if (!is_admin()) {
        return $field;
    }

    $shortcode = '[call_to_action id="' . get_the_ID() . '"]';

    $field['message'] = "<p class='acf-copy-container'><span class='acf-copy-from'>{$shortcode}</span><button type='button' class='acf-copy-button button'>Copy</button></p>";

    return $field;
});

// Apply the same category to the post when save the post / Acf Field
add_action('save_post',
    function ($post_id) {
        if (empty($_POST)) {
            return;
        }

        // Jobs CP
        $term_slug = get_field('jobs_type', $post_id);
        if (!empty($term_slug) && !is_wp_error($term_slug)) {

            $term = get_term_by('slug', $term_slug, 'jobs_type');
            if ($term) {
                wp_set_post_terms($post_id, $term->term_id, 'jobs_type');
            }
        }

        // People CP
        $term_slug = get_field('department', $post_id);
        if (!empty($term_slug) && !is_wp_error($term_slug)) {

            $term = get_term_by('slug', $term_slug, 'department');
            if ($term) {
                wp_set_post_terms($post_id, $term->term_id, 'department');
            }
        }

    });
