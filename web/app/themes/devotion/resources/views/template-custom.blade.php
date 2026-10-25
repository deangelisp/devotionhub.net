{{--
  Template Name: Base - Simple Template
--}}

@extends('layouts.app')

@section('content')
    @while (have_posts())
        @php(the_post())

        @include('components.blocks.header-sections.simple-header', [
            'id' => 0,
            'uppertitle' => '',
            'title' => get_the_title(),
            'content' => has_excerpt() ? get_the_excerpt() : '',
            'buttons' => false,
            'textColor' => has_post_thumbnail() ? 'text-white' : 'none',
            'block' => [
                'background_element' => has_post_thumbnail() ? 'image' : 'none',
                'image' => has_post_thumbnail() ? get_post_thumbnail_id() : '',
                'parallax' => false,
            ],
        ])

        @include('partials.blocks.init')
    @endwhile
@endsection
