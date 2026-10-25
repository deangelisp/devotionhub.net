<?php
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 0;?>
<div class="wrap">
	<h1 class="wp-heading-inline">Preview Email</h1>
    <p>Preview the email template with the current settings.</p>
    <p>To edit the email template, <a href="<?php echo admin_url('admin.php?page=website-options#email'); ?>">Click Here</a>.</p>
    <form method="get" action="">
        <input type="hidden" name="page" value="preview-email">
        <label for="post_id">Post ID:</label>
        <input type="text" name="post_id" id="post_id" value="<?php echo $post_id; ?>">
        <input type="submit" value="Preview Email">
    </form>
    <?php

$content = get_post_field('post_content', $post_id);

// add p
$content = format_content_to_email($content);

$message = $content;

$header = \Roots\view('partials.email.header')->render();
$content = \Roots\view('partials.email.content', ['content' => $message, 'unsubscribe' => true])->render();
$footer = \Roots\view('partials.email.footer')->render();

$message = $header . $content . $footer;

echo $message;
?>
</div>
