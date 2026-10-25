<?php

namespace App\View\Components\blocks\ArchivePosts;

use Illuminate\View\Component;

class Jobs extends Component
{

    public function __construct($id = null, $block = null)
    {
        $this->id = $id;
        $this->block = $block;
        $this->notPostsFoundMessage = $block['not_posts_found_message'];

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'jobs',
            'paged' => $paged,
        ];

        $this->query = new \WP_Query($args);

    }

    public function render()
    {
        return view('components.blocks.archive-posts.jobs', [
            'id' => $this->id,
            'query' => $this->query,
            'noPostsFoundMessage' => $this->notPostsFoundMessage,
        ]);
    }
}
