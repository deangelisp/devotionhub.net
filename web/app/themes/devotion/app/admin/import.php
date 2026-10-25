<?php
// IMport Keywords
add_action('admin_post_import_extra_data', 'handle_import_extra_data');

function handle_import_extra_data()
{

    if (! isset($_POST['import_extra_data_nonce']) || ! wp_verify_nonce($_POST['import_extra_data_nonce'], 'import_extra_data_action')) {
        wp_die('Security check');
    }

    if (! current_user_can('manage_options')) {
        wp_die('Permission check');
    }

    if (! isset($_FILES['file'])) {
        wp_die('No file');
    }

    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        wp_die('Upload error');
    }

    $file_path = $file['tmp_name'];

    $file = fopen($file_path, 'r');

    $header = fgetcsv($file);

    $rows = [];

    while ($row = fgetcsv($file)) {
        $rows[] = array_combine($header, $row);
    }

    fclose($file);

    $data = [];

    $schema = get_books_schema();

    foreach ($rows as $row) {
        if (! isset($row['Keyword'])) {
            continue;
        }

        $data[] = [
            'keyword' => $row['Keyword'],
            'result'  => superSearch($row['Keyword'], $schema),
        ];
    }

    $csv = [];
    foreach ($data as $row) {

        if (! isset($row['result']['book'])) {
            continue;
        }

        $title = $row['result']['book'];

        if (isset($row['result']['chapter']) && ! empty($row['result']['chapter'])) {
            $title .= ' ' . $row['result']['chapter'];
        }
        if (isset($row['result']['verses']) && ! empty($row['result']['verses'])) {
            $title .= ':' . $row['result']['verses'];
        }

        $csv[] = [
            'Keyword' => $row['keyword'],
            'Link'    => $title,
        ];
    }

    $wp_upload_dir = wp_upload_dir();
    $csv_file      = $wp_upload_dir['basedir'] . '/bible-keywords.csv';

    $file = fopen($csv_file, 'w');

    $header = ['Keyword', 'Link'];

    fputcsv($file, $header);

    foreach ($csv as $row) {
        fputcsv($file, $row);
    }

    wp_redirect(admin_url('edit.php?post_type=extra_data'));
    exit;
}

// Import Posts
add_action('admin_post_import_extra_data_post', 'handle_import_extra_data_post');

function handle_import_extra_data_post()
{

    if (! isset($_POST['import_extra_data_post_nonce']) || ! wp_verify_nonce($_POST['import_extra_data_post_nonce'], 'import_extra_data_post_action')) {
        wp_die('Security check');
    }

    if (! current_user_can('manage_options')) {
        wp_die('Permission check');
    }

    if (! isset($_FILES['file'])) {
        wp_die('No file');
    }

    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        wp_die('Upload error');
    }

    $file_path = $file['tmp_name'];

    $file = fopen($file_path, 'r');

    set_time_limit(0);
    $header = ['Link', 'Title'];

    while (($row = fgetcsv($file)) !== false) {
        $row_data = array_combine($header, $row);

        // Check if post exists
        $post = checkIfPassageExtraDataExist($row_data['Link']);
        if ($post) {
            continue;
        }

        $post_id = wp_insert_post([
            'post_title'  => $row_data['Title'],
            'post_status' => 'publish',
            'post_type'   => 'extra_data',
        ]);

        if (! is_wp_error($post_id)) {
            update_field('passage', $row_data['Link'], $post_id);
        }

        sleep(1);
    }

    wp_redirect(admin_url('edit.php?post_type=extra_data'));

    exit;
}

function checkIfPassageExtraDataExist($passage)
{
    global $wpdb;

    $query = "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'passage' AND meta_value = '$passage'";

    $results = $wpdb->get_results($query);

    if (count($results) > 0) {

        $post_id = $results[0]->post_id;

        $post_type = get_post_type($post_id);

        if ($post_type === 'extra_data') {
            return true;
        }

    }

    return false;
}
