<table style="width: 100%; background-color: <?php echo $backgroundColor; ?>; border-collapse: collapse; ">
    <tbody>
        <tr>
            <td style="padding: 0;">
                <table style="width: 600px; margin: 0 auto;  border-collapse: collapse; ">
                    <tr>
                        <td style="text-align: center; padding-top: 50px; padding-bottom: 40px;">
                            <a href="<?php echo $siteUrl; ?>">
                                <?php if($siteLogo): ?>
                                    <img src="<?php echo $siteLogo; ?>" style="width: 150px; height: auto;">
                                <?php else: ?>
                                    <h1 style="text-center"><?php echo $siteName; ?></h1>
                                <?php endif; ?>
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/partials/email/header.blade.php ENDPATH**/ ?>