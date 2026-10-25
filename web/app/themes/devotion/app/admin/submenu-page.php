<?php
add_action('admin_menu', function () {

    add_submenu_page(
        'edit.php?post_type=extra_data',
        __('Import Extra data', 'textdomain'),
        __('Import Extra data', 'textdomain'),
        'manage_options',
        'import-extra-data',
        'import_extra_data_callback',
        99
    );

    function import_extra_data_callback()
    {
        require 'ExtraData/callback.php';
    }

}, 999);
