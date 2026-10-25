<tr>
    <td style=" padding: 0;  ">
        <table style="width: 600px;  border-collapse: collapse; margin: 0 auto;   color: <?php echo $footerTextColor; ?>; ">

            <td style="padding-top: 40px; "></td>

            
            <?php if($footerLogoUrl): ?>
                <tr>
                    <td style="text-align: center;padding-bottom: 10px;">
                        <a href="<?php echo $siteUrl; ?>">
                            <img src="<?php echo $footerLogoUrl; ?>" alt="Logo Footer" width="160"
                                style="margin: 0 auto" /></a>
                    </td>
                </tr>
            <?php endif; ?>

            
            <?php if(!empty($links)): ?>
                <tr>
                    <td
                        style="color: <?php echo $footerTextColor; ?>; font-size: 12px; font-weight: bold; line-height: 18px; text-align: center; font-family: Roboto,sans-serif;  padding-bottom: 15px;">
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span>
                                <?php if(!$loop->first): ?>
                                    <span> | </span>
                                <?php endif; ?>
                                <a style="color: <?php echo $footerTextColor; ?>; text-decoration: none !important;"
                                    href="<?php echo $item['link']['url']; ?>">
                                    <?php echo $item['link']['title']; ?>

                                </a>
                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                </tr>
            <?php endif; ?>


            
            <?php if(!empty($siteSocialMedias)): ?>
                <tr>
                    <td align="center" style="padding-bottom: 15px;">
                        <table>
                            <tr>

                                <?php $__currentLoopData = $siteSocialMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td style="padding: 0 3px">
                                        <a href="<?php echo $item['url']; ?>" title="<?php echo $item['media']; ?>"
                                            aria-label="<?php echo $item['media']; ?>" target="_blank">
                                            
                                            <?php $asset = \Roots\asset('images/email/' . $item['media'] . '.png'); ?>
                                            <img src="<?php echo $asset->uri(); ?>" style="width: 16px; height: 16px;" />
                                        </a>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endif; ?>


            
            <?php if(!empty($message)): ?>
                <tr>
                    <td
                        style="color: <?php echo $footerTextColor; ?>; font-size: 12px; line-height: 18px; text-align: center; font-family: Roboto,sans-serif;  padding-bottom: 10px;">
                        <span style="display: inline-block; max-width: 380px;">
                            <?php echo $message; ?>

                        </span>
                    </td>
                </tr>
            <?php endif; ?>


            
            <?php if(!empty($sitePhoneNumber)): ?>
                <tr>
                    <td
                        style="color: <?php echo $footerTextColor; ?>; font-size: 12px; line-height: 18px; text-align: center; font-family: Roboto,sans-serif; padding-bottom: 20px;">
                        Call us on <a style="color: <?php echo $footerTextColor; ?>; text-decoration: none !important;"
                            href="<?php echo generate_tel_url($sitePhoneNumber); ?>">
                            <?php echo $sitePhoneNumber; ?>

                        </a>
                    </td>
                </tr>
            <?php endif; ?>

            <!-- Copyright -->
            <?php if(!empty($copyright)): ?>
                <tr>
                    <td
                        style="color: <?php echo $footerTextColor; ?>; font-size: 12px; line-height: 18px; text-align: center; font-family: Roboto,sans-serif; ">
                        <?php echo $copyright; ?>

                    </td>
                </tr>
            <?php endif; ?>
            <td style="padding-bottom: 40px; "></td>
        </table>
    </td>
</tr>
<tbody>
    </table>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/partials/email/footer.blade.php ENDPATH**/ ?>