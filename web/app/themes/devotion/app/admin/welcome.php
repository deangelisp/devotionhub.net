<?php
include_once 'welcome/help-service.php';

add_action('wp_dashboard_setup',

    function () {
        wp_add_dashboard_widget('dashboard_widget_help_service', 'Legend Help Service', 'widget_help_service');

    });
