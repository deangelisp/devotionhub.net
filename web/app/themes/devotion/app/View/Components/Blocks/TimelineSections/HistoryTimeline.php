<?php

namespace App\View\Components\blocks\TimelineSections;

use Illuminate\View\Component;

class HistoryTimeline extends Component
{

    public $history;

    public function __construct()
    {
        $this->history = $this->getHistoryTimeline();

    }

    public function render()
    {
        return view('components.blocks.timeline-sections.history-timeline', [
            'history' => $this->history,

        ]);
    }

    private function getHistoryTimeline()
    {

        $history = [];

        $args = [
            'post_type' => 'history',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
        ];

        $query = new \WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $date = get_field('date');
                $uppertitle = get_field('uppertitle');
                $title = get_field('title');
                $content = get_field('content');
                $buttons = get_field('buttons');

                $image = false;

                if (has_post_thumbnail()) {
                    $image = get_post_thumbnail_id();
                }

                $history[] = [
                    'date' => $date,
                    'uppertitle' => $uppertitle,
                    'title' => $title,
                    'content' => $content,
                    'buttons' => $buttons,
                    'image' => $image,
                ];
            }
        }

        wp_reset_postdata();
        $history = collect($history)
            ->groupBy('date')
            ->map(function ($item) {
                return $item->first(); // This assumes each date group always has exactly one item
            })
            ->toArray();

        return $history;
    }
}
