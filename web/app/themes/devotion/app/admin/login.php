<?php
function my_login_logo_url()
{
    return home_url();
}
add_filter('login_headerurl', 'my_login_logo_url');

function modify_logo()
{
    ?>
<style>
    html .login h1 a {
        width: 249px;
        margin-bottom: 0;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        background-image: url('<?php echo get_template_directory_uri(); ?>/resources/images/admin/logo.png') !important;
    }

    body.login-action-login {
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('<?php echo get_template_directory_uri(); ?>/resources/images/admin/background.jpg') left bottom /cover;
    }

    #login {
        padding: 40px 20px;
        margin: 50px auto;
        border-radius: 20px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        background: #FFF;
    }

    .login form {
        margin-top: 0;
        border: none;
        box-shadow: none;
    }

    .login.wp-core-ui .button-primary {
        background: #4d1254;
        border-color: #4d1254;
        box-shadow: 0 1px 0 #4d1254;
        color: #FFF;
        text-shadow: none;
        float: none;
        clear: both;
        display: block;
        width: 100%;
        padding: 7px;
        height: auto;
        font-size: 15px;
    }
</style>
<?php
}
add_action('login_head', 'modify_logo');