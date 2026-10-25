@extends('layouts.app')

@section('content')
    @include('components.blocks.header-sections.simple-header', [
        'id' => 0,
        'uppertitle' => '',
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
        <div class="entry-content section-page container">
            {!! $description !!}
        </div>
    @endif
@endsection
