<?php

function handle_newsletter_subscription()
{
    // Check if the action is set and if it's our form submission action
    if (isset($_POST['action']) && $_POST['action'] === 'subscribe') {

        // Verify the nonce for security
        if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'subscribe')) {
            wp_die(__('Nonce verification failed', 'your-text-domain'));
        }

        // Sanitize the email input
        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

        // Check if the email is valid
        if (! is_email($email)) {
            wp_die(__('Invalid email address', 'your-text-domain'));
        }

        // Check if email user already exists
        $user_id = email_exists($email);

        if (! $user_id) {
            // Create a new user
            $user_id = wp_create_user($email, wp_generate_password(), $email);
        }

        $course_id     = $_POST['course_id'];
        $is_subscribed = check_if_user_is_subscribed($user_id, $course_id);

        if ($is_subscribed) {
            set_session_message('You are already subscribed!', 'You are already subscribed to this course, if you are not receiving emails, please contact support.');
        } else {
            initialize_user_progress($user_id, $course_id);

            set_session_message('You have been subscribed!', 'You have been subscribed to the course, you will receive an email shortly.');
        }

        // reload the page
        wp_redirect($_SERVER['HTTP_REFERER']);
        exit;

    }
}
add_action('init', 'handle_newsletter_subscription');

function check_if_user_is_subscribed($user_id, $course_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_course_progress';

    $result = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE user_id = %d AND course_id = %d",
            $user_id,
            $course_id
        )
    );

    return $result;
}

function initialize_user_progress($user_id, $course_id)
{
    global $wpdb;
    $table_name   = $wpdb->prefix . 'user_course_progress';
    $current_date = date('Y-m-d');

    $timezone = isset($_POST['timezone']) ? sanitize_text_field($_POST['timezone']) : 'UTC';

    $wpdb->insert(
        $table_name,
        [
            'user_id'           => $user_id,
            'course_id'         => $course_id,
            'status'            => 'active',
            'course_start_date' => $current_date,
            'current_day'       => 1,
            'last_email_sent'   => '0000-00-00',
            'next_email_date'   => $current_date,
            'timezone'          => $timezone,
        ],
        [
            '%d',
            '%d',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
        ]
    );

    send_course_email($user_id, $course_id, 0);
}

function send_course_email($user_id, $course_id, $current_day)
{
    // Get the user email
    $user_info         = get_userdata($user_id);
    $user_email        = $user_info->user_email;
    $user_display_name = $user_info->display_name;

    // Get the course details
    $lesson = get_user_lesson($course_id, $current_day);

    if (! $lesson) {
        deactivate_user_subscription($user_id, $course_id);
        return;
    }

    // Get the email content
    $email_content = get_post_field('post_content', $lesson);
    $email_content = format_content_to_email($email_content, $user_display_name);

    $email_subject = get_field('subject', $lesson);

    // Send the email
    wp_mail($user_email, $email_subject, $email_content . '{{unsubscribe}}' . "{{course_id:$course_id}}");

    // Update the user progress
    update_user_progress($user_id, $course_id, $current_day);
}

function update_user_progress($user_id, $course_id, $current_day)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_course_progress';

    $user_progress   = $wpdb->get_row($wpdb->prepare("SELECT timezone FROM $table_name WHERE user_id = %d AND course_id = %d", $user_id, $course_id));
    $timezone        = new DateTimeZone($user_progress->timezone);
    $next_email_date = new DateTime('now', $timezone);
    $next_email_date->modify('+1 day')->setTime(8, 0);

    $wpdb->update(
        $table_name,
        [
            'current_day'     => $current_day + 1,
            'last_email_sent' => date('Y-m-d'),
            'next_email_date' => $next_email_date->format('Y-m-d H:i:s'),
        ],
        [
            'user_id'   => $user_id,
            'course_id' => $course_id,
        ],
        [
            '%d',
            '%s',
            '%s',
        ],
        [
            '%d',
            '%d',
        ]
    );
}

// UNSUBSCRIBE

add_action('template_redirect', 'handle_unsubscribe_request');

function handle_unsubscribe_request()
{
    if (isset($_GET['action']) && $_GET['action'] === 'unsubscribe') {

        $email = isset($_GET['email']) ? sanitize_email($_GET['email']) : '';
        $token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';

        // Ensure email and token are present
        if (empty($email) || empty($token)) {

            set_session_message('Invalid unsubscribe link', 'The unsubscribe link is invalid, please try again.');

            wp_redirect(home_url()); // Redirect to home if parameters are missing
            exit;
        }

        $secret_key     = $_ENV['UNSUBSCRIBE_SECRET_KEY'];
        $date           = date('Y-m-d'); // Use the same date format as in email
        $expected_token = hash('sha256', $email . $secret_key . $date);

        if ($token === $expected_token) {
            // Unsubscribe the user
            $user_id   = email_exists($email);
            $course_id = $_GET['course_id'];

            if ($user_id) {
                $result = unsubscribe_user($user_id, $course_id);

                if ($result) {
                    set_session_message('You have been unsubscribed!', 'You have been unsubscribed from the course, you will no longer receive emails.');
                } else {
                    set_session_message('Unsubscribe failed', 'An error occurred while unsubscribing, please try again.');
                }
            } else {
                set_session_message('Unsubscribe failed', 'The email address is not registered, please contact support.');
            }

        } else {
            set_session_message('Invalid unsubscribe link', 'The unsubscribe link is invalid, please try again.');
        }

        wp_redirect(home_url()); // Redirect to home after processing

        exit;
    }

}

function unsubscribe_user($user_id, $course_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_course_progress';

    $result = $wpdb->delete(
        $table_name,
        [
            'user_id'   => $user_id,
            'course_id' => $course_id,
        ],
        [
            '%d',
            '%d',
        ]
    );

    return $result;
}

// Schedule the Email Delivery
function schedule_daily_emails()
{
    $subscribed_users = get_subscribed_users_of_the_day(); // Get all users who are subscribed and have an upcoming email

    foreach ($subscribed_users as $user) {
        if (should_send_email($user->user_id, $user->course_id, $user->next_email_date, $user->timezone)) {
            send_course_email($user->user_id, $user->course_id, $user->current_day);
        }
    }
}
add_action('hourly_email_check', 'schedule_daily_emails');

// Schedule the cron event if not already scheduled
if (! wp_next_scheduled('hourly_email_check')) {
    wp_schedule_event(time(), 'hourly', 'hourly_email_check');
}
function should_send_email($user_id, $course_id, $next_email_date, $timezone)
{
    try {
        $timezone = new DateTimeZone($timezone);
        $now      = new DateTime('now', $timezone);

        $eightAM = new DateTime('today 08:00', $timezone);

        $nextEmailDate = new DateTime($next_email_date, $timezone);

        return $now >= $eightAM && $now >= $nextEmailDate;

    } catch (Exception $e) {
        dd("Error in should_send_email: " . $e->getMessage() . ' ' . $timezone);
        return false;
    }
}

function get_subscribed_users_of_the_day()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_course_progress';

    $subscribed_users = $wpdb->get_results(
        "SELECT * FROM $table_name WHERE status = 'active'"
    );

    return $subscribed_users;
}

function deactivate_user_subscription($user_id, $course_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_course_progress';

    $result = $wpdb->update(
        $table_name,
        [
            'status' => 'inactive',
        ],
        [
            'user_id'   => $user_id,
            'course_id' => $course_id,
        ],
        [
            '%s',
        ],
        [
            '%d',
            '%d',
        ]
    );

    return $result;
}

// add_action('admin_init', function () {
//     schedule_daily_emails();
// });
