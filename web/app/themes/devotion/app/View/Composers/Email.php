<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Email extends Composer
{
    protected static $views = [
        'partials.email.header',
        'partials.email.footer',
        'partials.email.wp-new-user-notification',
    ];

    public function override()
    {

        $footer_settings = get_acf_option_repeater_field('settings_email_template_footer', ['logo', 'message_phone_number', 'message_social_medias', 'message'], true);
        $colors_settings = get_acf_option_repeater_field('settings_email_template_colors', ['features', 'background', 'footer_background', 'footer_text'], true);

        return [
            'logoUrl' => false,
            'footerLogoUrl' => $this->logo($footer_settings['logo'] ?? null),
            'siteUrl' => $this->siteUrl(),
            'featureColor' => $this->featureColor($colors_settings['features'] ?? null),
            'backgroundColor' => $this->backgroundColor($colors_settings['background'] ?? null),
            'footerBackgroundColor' => $this->backgroundColor($colors_settings['footer_background'] ?? null),
            'footerTextColor' => $this->backgroundColor($colors_settings['footer_text'] ?? null),
            'links' => $this->links($footer_settings['links'] ?? null),
            'message' => $this->message($footer_settings['message'] ?? null),
            'siteSocialMedias' => $this->siteSocialMedias($colors_settings['footer_text']),
            'siteLogo' => $this->siteLogo(),
            'siteName' => $this->siteName(),
        ];
    }

    private function siteLogo()
    {
        $logo = get_field('settings_general_logo', 'option');

        if (!$logo) {
            return false;
        }

        // return url
        return wp_get_attachment_image_url($logo, 'medium');
    }

    private function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    private function logo($image_id)
    {
        if ($image_id) {
            return wp_get_attachment_image_url($image_id, 'medium');
        }

        return '';
    }

    private function siteUrl()
    {
        return get_site_url();
    }

    private function featureColor($color)
    {
        return $color ?? '#4d1254';
    }

    private function backgroundColor($color)
    {
        return $color ?? '#f1f5ff';
    }

    private function footerBackgroundColor($color)
    {
        return $color ?? '#16191e';
    }

    private function footerTextColor($color)
    {
        return $color ?? '#8b8c8f';
    }

    private function links($links)
    {
        return $links ?? false;
    }

    private function message($message)
    {
        return $message ?? false;
    }

    private function siteSocialMedias($color)
    {
        $medias = get_acf_option_repeater_field('settings_general_social_medias', ['url']);

        if (!$medias) {
            return [];
        }

        $fill = $color ?? '#8b8c8f';

        return convertSocialMediasToArray($medias, $fill);

    }

}
