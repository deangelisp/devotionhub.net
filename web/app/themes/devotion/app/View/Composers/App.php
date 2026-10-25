<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class App extends Composer
{
    // The 90-Day Journey landing page, and sign-up in the course app.
    public const JOURNEY_URL = '/bible-study/90-day-journey-through-the-bible-from-genesis-to-revelation/';
    public const APP_REGISTER_URL = 'https://app.devotionhub.net/register';

    protected static $views = [
        'layouts.app',
        'sections.header',
        'sections.footer',
    ];

    public function with()
    {
        return [
            //General
            'siteLogo' => $this->siteLogo(),
            'siteName' => $this->siteName(),
            'sitePhoneNumber' => $this->sitePhoneNumber(),
            'siteSocialMedias' => $this->siteSocialMedias(),
            'globalMessage' => $this->globalMessage(),

            //Header
            'headerSpotilight' => $this->headerSpotilight(),
            'navbar' => $this->navbar(),
            'primaryNavigation' => $this->primaryNavigation(),
            'headerCTA' => $this->headerCTA(),

            // Link
            'postsLink' => $this->postsLink(),

            //Footer
            'footer' => $this->footer(),
            'address' => $this->address(),
            'phone' => $this->phone(),
            'email' => $this->email(),
            'footerLogo' => $this->footerLogo(),
            'copyright' => $this->copyright(),
        ];
    }

    private function siteLogo()
    {
        $logo = get_field('settings_general_logo', 'option');

        if (!$logo) {
            return false;
        }

        return wp_get_attachment_image($logo, 'medium', false, ['class' => 'brand w-32 md:w-64 h-12 object-contain']);
    }

    private function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    private function sitePhoneNumber()
    {
        return get_field('settings_general_phone_number', 'option');
    }

    private function primaryNavigation()
    {
        return get_menu_items_by_location('primary_navigation');
    }

    private function headerCTA()
    {
        $cta = get_field('settings_header_cta', 'option');

        // On the page it links to, send people on to sign up rather than reloading the page.
        if (isset($cta['url']) && self::isCurrentPage($cta['url'])) {
            $cta = ['url' => self::APP_REGISTER_URL, 'title' => 'Join the 90-Day Journey', 'target' => ''];
        }

        return $cta;
    }

    /** The journey link for the footer: the landing page, or sign-up when already on it. */
    public static function journeyLink()
    {
        return self::isCurrentPage(self::JOURNEY_URL) ? self::APP_REGISTER_URL : self::JOURNEY_URL;
    }

    public static function isCurrentPage($url)
    {
        $path = fn ($u) => untrailingslashit((string) parse_url($u, PHP_URL_PATH));

        return is_singular() && $path($url) === $path(get_permalink(get_queried_object_id()));
    }

    public static function postsLink()
    {
        return get_permalink(get_option('page_for_posts'));
    }

    private function copyright()
    {
        $year = date("Y");
        $siteName = $this->siteName();

        return "<span>© {$year} {$siteName}</span>";
    }

    // Header

    private function headerSpotilight()
    {
        $spotlight = get_field('settings_header_spotlight', 'option');

        if (!$spotlight) {
            return false;
        }

        return $spotlight;
    }

    private function navbar()
    {
        $navbar = get_field('settings_header_navbar', 'option');

        if (!$navbar) {
            return false;
        }

        return $navbar;
    }

    // Footer
    private function footer()
    {
        $footer = get_field('settings_footer', 'option');

        if (!$footer) {
            return 'Footer3';
        }

        return $footer;
    }

    private function footerLogo()
    {
        $logo = get_field('settings_footer_logo', 'option');

        if (!$logo) {
            return false;
        }

        return wp_get_attachment_image($logo, 'medium', false);
    }

    private function address()
    {
        return get_field('settings_general_address', 'option');
    }

    private function phone()
    {
        return get_field('settings_general_phone_number', 'option');
    }

    private function email()
    {
        return get_field('settings_general_email', 'option');
    }

    //
    public static function getLinksFortheFooterPostType($post_type)
    {
        $args = [
            'post_type' => $post_type,
            'posts_per_page' => -1,
        ];

        $query = new WP_Query($args);

        $links = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $links[] = [
                    'title' => get_the_title(),
                    'url' => get_the_permalink(),
                    'target' => '',
                ];
            }
        }

        wp_reset_postdata();

        return $links;

    }

    public static function siteSocialMedias()
    {
        return get_field('settings_general_social_medias', 'options');

    }

    public static function noPostsFoundTitle($postType = 'posts')
    {

        return sprintf(
            __('No %s found', 'sage'),
            $postType
        );
    }

    public static function noPostsFoundMessage()
    {

        $content = "<p>We couldn't find any content matching your criteria. But don't worry! Here's what you can do</p>";
        $content .= '<ul>';
        $content .= '<li>Try adjusting your search or filter options to broaden your search.</li>';
        $content .= '<li>Visit our Homepage for the latest articles and insights.</li>';
        $content .= "<li>If you're looking for something specific, please contact us and we'll be happy to assist.</li>";
        $content .= '</ul>';
        $content .= "<p>We're constantly updating our content, so be sure to check back soon for new posts and updates. Thank you for visiting!</p>";

        return $content;
    }

    private function globalMessage()
    {
        $message = get_session_message();

        if (!$message) {
            return false;
        }

        return $message;
    }
}
