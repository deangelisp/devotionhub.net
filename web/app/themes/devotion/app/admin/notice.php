<?php

// add_action('admin_notices', function () {
//     $screen = get_current_screen();

//     noticeSetupTheme($screen);
// });

// This notice prompts the user to setup the theme.
function noticeSetupTheme($screen)
{

    if (isset($screen->id) && (
        $screen->id === 'appearance_page_theme-setup' ||
        strpos($screen->id, 'acf') !== false
    )) {
        return;
    }

    $message = "Before you dive into theme development, it's a good idea to set up your theme with default settings.<br /> It's a straightforward process – simply click the button below to get started.";

    echo '<div class="lsw-wrap"><div class="notice-box">
    <span class="icon"><span class="dashicons dashicons-admin-appearance"></span></span>
    <p class="title">Setup your theme.</p>
    <p class="mb-4">' . $message . '</p>
    <a href="' . admin_url('themes.php?page=theme-setup') . '" class="btn btn--primary">Setup theme</a></div></div>';
}
