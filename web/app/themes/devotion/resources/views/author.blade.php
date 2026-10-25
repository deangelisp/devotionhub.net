@extends('layouts.app')

@section('content')
    @include('components.blocks.header-sections.simple-header', [
        'id' => 0,
        'uppertitle' => 'Author',
        'title' => $title,
        'content' => $description,
        'buttons' => false,
        'textColor' => '',
        'block' => [
            'background_element' => 'none',
            'image' => '',
            'parallax' => false,
        ],
    ])
    @include('partials.post.loop')
@endsection
