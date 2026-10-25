<?php

namespace App\Shortcodes;

class CallToAction
{
    public $shortcode = 'call_to_action';

    public function render($atts, $content = null)
    {

        $post_id = $atts['id'];

        $label = get_field('label', $post_id);
        $content = get_field('content', $post_id);
        $image = get_field('image', $post_id);
        $bgColor = get_field('background_color', $post_id);

        switch ($bgColor) {
            case 'primary':
                $bgColor = 'bg-primary text-white';
                break;

            case 'secondary':
                $bgColor = 'bg-secondary text-white';
                break;

            default:
                $bgColor = 'bg-light-tone';
                break;
        }

        if ($image) {
            $image = wp_get_attachment_image($image, 'medium');
        } else {
            $image = false;
        }

        return view('shortcodes.call-to-action', ['label' => $label, 'content' => $content, 'image' => $image, 'bgColor' => $bgColor]);
    }
}

return new CallToAction();
