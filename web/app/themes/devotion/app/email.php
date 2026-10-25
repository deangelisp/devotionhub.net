<?php
// Change the email content type to HTML
add_filter('wp_mail_content_type', function ($content_type) {
    return 'text/html';
});

// Add a filter to wp_mail to add a custom email template
add_filter('wp_mail', function ($args) {

    $header = \Roots\view('partials.email.header')->render();
    $footer = \Roots\view('partials.email.footer')->render();

    // Check for the unsubscribe keyword in the message
    $unsubscribe = strpos($args['message'], '{{unsubscribe}}') !== false;
    $course_id = strpos($args['message'], '{{course_id:') !== false;

    if ($unsubscribe) {

        if ($course_id) {
            $course_id = get_string_between($args['message'], '{{course_id:', '}}');
        }

        $unsubscribe = create_unsubscribe_link($args['to'], $course_id);
    }

    $content = str_replace('{{unsubscribe}}', '', $args['message']);

    $content = preg_replace('/{{course_id:(.*?)}}/', '', $content);

    $content = \Roots\view('partials.email.content', ['content' => $content, 'unsubscribe' => $unsubscribe])->render();

    if (strpos($args['subject'], 'Your new account') !== false) {
        $content = $args['message'];
    }

    $args['message'] = $header . $content . $footer;

    return $args;
}, 100);

// Notification: New User Registration
add_filter('wp_new_user_notification_email', function ($wp_new_user_notification_email, $user, $blogname) {
    $header = \Roots\view('partials.email.header')->render();
    $footer = \Roots\view('partials.email.footer')->render();
    $content = \Roots\view('partials.email.wp-new-user-notification', ['user' => $user])->render();

    $wp_new_user_notification_email['subject'] = sprintf('[%s] Your new account', $blogname);
    $wp_new_user_notification_email['message'] = $header . $content . $footer;
    $wp_new_user_notification_email['pre_content'] = true;

    return $wp_new_user_notification_email;
}, 10, 3);
