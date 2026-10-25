<?php

add_action('plugins_loaded', function () {
    if (!defined('DEFENDER_VERSION')) {
        return; // Defender is not installed/enabled.
    }

    $model = wd_di()->get(\WP_Defender\Model\Setting\Mask_Login::class);

    if (!$model->is_active() || 0 !== get_current_user_id()) {
        return; // Login mask not enabled (or user already logged in).
    }

    $message = __('This feature is forbidden temporarily for security reason. Try login again.', 'wpdef');

// Uncomment this if you also have problems with /wp-login.php URL:
//if ( 0 === strpos( 'wp-login.php', trim( $_SERVER['REQUEST_URI'] ?? '', '/' ) ) ) {
// wp_die( esc_html( $message ) );
//}

    add_filter('wp_redirect', function ($location, $status) use ($message) {
        $login_url = wp_login_url();

        if (empty($login_url)) {
            return $location;
        }

        if (0 === strpos($location, $login_url)) {
            wp_die(esc_html($message));
        }

        return $location;
    }, 10, 2);
});
