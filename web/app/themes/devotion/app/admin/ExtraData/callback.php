
<h1 class="wp-heading-inline" style="margin-bottom: 40px;">Import Extra Data </h1>


<form id="import-model-scores-form" method="post" enctype="multipart/form-data" action="<?php echo admin_url('admin-post.php'); ?>">
<fieldset>
    <legend>Updload Keywords from Semrush</legend>
    <input type="hidden" name="action" value="import_extra_data" />
    <?php wp_nonce_field('import_extra_data_action', 'import_extra_data_nonce');?>
    <input type="file" name="file" id="file" accept=".csv" />
    <input type="submit" name="submit" id="submit" value="Submit" />
</fieldset>
</form>

<form id="import-model-scores-form" method="post" enctype="multipart/form-data" action="<?php echo admin_url('admin-post.php'); ?>" style="margin-top: 40px;">
<fieldset>
    <legend>After adding ttile, upload here to create extra data posts</legend>
    <input type="hidden" name="action" value="import_extra_data_post" />
    <?php wp_nonce_field('import_extra_data_post_action', 'import_extra_data_post_nonce');?>
    <input type="file" name="file" id="file" accept=".csv" />
    <input type="submit" name="submit" id="submit" value="Submit" />
</fieldset>
</form>
