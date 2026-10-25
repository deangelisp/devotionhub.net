@if ($query)
    @include('components.blocks.feature-sections.dynamic-post-grid', [
        'id' => 0,
        'title' => $title,
        'query' => $query,
        'block_content' => $posttype,
        'post_order' => 'manual',
        'uppertitle' => '',
        'content' => '',
        'buttons' => '',
    ])
@endif
