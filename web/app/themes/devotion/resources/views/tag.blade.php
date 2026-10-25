@extends('layouts.app')

@section('content')
    @include('components.blocks.header-sections.simple-header', [
        'id' => 0,
        'uppertitle' => 'Resource Tag',
        'title' => $termTitle,
        'content' => $termContent,
        'buttons' => false,
        'textColor' => '',
        'block' => [
            'background_element' => 'none',
            'image' => '',
            'parallax' => false,
        ],
    ])

    @include('partials.post.loop')

    @if ($description)
        <div class="entry-content section-page container max-w-2xl">
            {!! $description !!}
        </div>
    @endif
@endsection
