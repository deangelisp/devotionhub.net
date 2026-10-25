<?php

namespace App\View\Components\blocks\LogoSections;

use Illuminate\View\Component;

class Logos extends Component
{
    public function __construct(
        $id = false,
        $block = false
    ) {
        $this->id = $id;

        $this->uppertitle = $block['uppertitle'];
        $this->title = $block['title'];
        $this->content = $block['content'];
        $this->buttons = $block['buttons'];
        $this->logos = $this->getLogos($block, $block['logo_cloud_order']);
    }

    public function render()
    {
        return view('components.blocks.logo-sections.logos', [
            'id' => $this->id,
            'uppertitle' => $this->uppertitle,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => $this->buttons,
            'logos' => $this->logos,
        ]);
    }

    private function getLogos($block, $order = false)
    {
        $args = [
            'post_type' => 'logo_cloud',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        if ($order == 'category' && isset($block['logo_cloud_cat']) && !empty($block['logo_cloud_cat'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'logo_cloud_cat',
                    'field' => 'slug',
                    'terms' => $block['logo_cloud_cat'],
                ],
            ];
        }

        if ($order == 'selected') {
            $args['post__in'] = $block['logo_cloud_selected'];
        }

        if ($order == 'random') {
            $args['orderby'] = 'rand';
        }

        $logos = [];

        $query = new \WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                if (has_post_thumbnail()) {
                    $logos[] = [
                        'title' => get_the_title(),
                        'image' => get_post_thumbnail_id(),
                    ];
                }
            }
        }

        wp_reset_postdata();

        return $logos;

    }
}
