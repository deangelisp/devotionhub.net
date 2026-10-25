<?php

namespace App\View\Components\blocks\ArchivePosts;

use App\View\Composers\App as AppComposer;
use Illuminate\View\Component;

class Posts extends Component
{

    public function __construct($id = null, $block = null)
    {
        $this->id = $id;
        $this->block = $block;
        $this->content = $block['content'] ?? '';

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'post',
            'paged' => $paged,
        ];

        $this->query = new \WP_Query($args);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.archive-posts.posts', [
            'id' => $this->id,
            'content' => $this->content,
            'query' => $this->query,
            'noPostsFoundTitle' => AppComposer::noPostsFoundTitle('posts'),
            'noPostsFoundMessage' => AppComposer::noPostsFoundMessage(),
        ]);
    }
}
