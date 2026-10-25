<?php

namespace App\View\Components\blocks\ArchivePosts;

use App\View\Composers\App as AppComposer;
use Illuminate\View\Component;

class CaseStudies extends Component
{
    public function __construct($id = null, $block = null)
    {
        $this->id = $id;
        $this->block = $block;
        $this->content = $block['content'] ?? '';

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = [
            'post_type' => 'case_study',
            'paged' => $paged,
        ];

        $this->query = new \WP_Query($args);

    }

    public function render()
    {
        return view('components.blocks.archive-posts.case-studies', [
            'id' => $this->id,
            'content' => $this->content,
            'query' => $this->query,
            'noPostsFoundTitle' => AppComposer::noPostsFoundTitle('case studies'),
            'noPostsFoundMessage' => AppComposer::noPostsFoundMessage(),
        ]);
    }
}
