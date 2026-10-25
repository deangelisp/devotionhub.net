<?php
// function my_mce_buttons_2($buttons)
// {
//     array_unshift($buttons, 'styleselect', 'styleselect2', 'styleselect3');
//     return $buttons;
// }
// add_filter('mce_buttons_2', 'my_mce_buttons_2', 9999);

function my_mce_before_init_insert_formats($init_array)
{
    $style_formats = array(
        array(
            'title' => 'Button Styles',
            'items' => array(
                array(
                    'title' => 'Button',
                    'selector' => 'a',
                    'classes' => 'btn',
                ),
                array(
                    'title' => 'Button (Outline)',
                    'selector' => 'a',
                    'classes' => 'btn btn--outline',
                ),
                array(
                    'title' => 'Button Secondary',
                    'selector' => 'a',
                    'classes' => 'btn--secondary',
                ),
                array(
                    'title' => 'Button Secondary',
                    'selector' => 'a',
                    'classes' => 'btn--secondary btn--outline',
                ),
            ),
        ),
        array(
            'title' => 'Link Styles',
            'items' => array(
                array(
                    'title' => 'Link (High Contrast)',
                    'selector' => 'a',
                    'classes' => 'link--high-contrast',
                ),
                array(
                    'title' => 'Link (Low Contrast)',
                    'selector' => 'a',
                    'classes' => 'link--low-contrast',
                ),
            ),
        ),
        array(
            'title' => 'Text Styles',
            'items' => array(
                array(
                    'title' => 'Text XS (12px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-xs',
                ),
                array(
                    'title' => 'Text SM (14px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-sm',
                ),
                array(
                    'title' => 'Text Base (16px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-md',
                ),
                array(
                    'title' => 'Text LG (18px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-lg',
                ),
                array(
                    'title' => 'Text XL (20px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-xl',
                ),
                array(
                    'title' => 'Text 2XL (24px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-2xl',
                ),
                array(
                    'title' => 'Text 3XL (30px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-3xl',
                ),
                array(
                    'title' => 'Text 4XL (36px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-4xl',
                ),
                array(
                    'title' => 'Text 5XL (48px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-5xl',
                ),
                array(
                    'title' => 'Text 6XL (60px)',
                    'selector' => 'p, a, li, span, h1, h2, h3, h4, h5, h6',
                    'classes' => 'text-6xl',
                ),
            ),
        ),
    );

    $init_array['style_formats'] = json_encode($style_formats);
    $init_array['preview_styles'] = 'font-family';

    return $init_array;
}
add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');

function my_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2', 9999);
