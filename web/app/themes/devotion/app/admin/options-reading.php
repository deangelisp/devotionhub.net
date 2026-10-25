<?php
/**
 * Add a custom option on the WordPress "Reading" settings page
 *
 * Allows users to select a page as the archive for a custom post type
 */

//  New Setting Field
add_action('admin_init', function () {
    add_settings_section(
        'custom_post_type_options',
        'Custom Post Type Settings',
        'custom_post_type_settings_description',
        'reading'
    );

    // Service
    add_settings_field(
        'page_for_service',
        'Services Page',
        'service_page_field_callback',
        'reading',
        'custom_post_type_options'
    );

    register_setting(
        'reading',
        'page_for_service'
    );

    // Case Study
    add_settings_field(
        'page_for_case_study',
        'Case Studies Page',
        'case_study_page_field_callback',
        'reading',
        'custom_post_type_options'
    );

    register_setting(
        'reading',
        'page_for_case_study'
    );

    // Jobs
    add_settings_field(
        'page_for_jobs',
        'Jobs Page',
        'jobs_page_field_callback',
        'reading',
        'custom_post_type_options'
    );

    register_setting(
        'reading',
        'page_for_jobs'
    );
});

function custom_post_type_settings_description()
{
    echo '<p>Select the page that should be used as the archive page for your Custom Post Type.</p>';
}

function service_page_field_callback()
{
    $page_id = get_option('page_for_service');
    wp_dropdown_pages(array(
        'name' => 'page_for_service',
        'echo' => 1,
        'show_option_none' => '&mdash; Select &mdash;',
        'option_none_value' => '0',
        'selected' => $page_id,
    ));
}

function case_study_page_field_callback()
{
    $page_id = get_option('page_for_case_study');
    wp_dropdown_pages(array(
        'name' => 'page_for_case_study',
        'echo' => 1,
        'show_option_none' => '&mdash; Select &mdash;',
        'option_none_value' => '0',
        'selected' => $page_id,
    ));
}

function jobs_page_field_callback()
{
    $page_id = get_option('page_for_jobs');
    wp_dropdown_pages(array(
        'name' => 'page_for_jobs',
        'echo' => 1,
        'show_option_none' => '&mdash; Select &mdash;',
        'option_none_value' => '0',
        'selected' => $page_id,
    ));
}
