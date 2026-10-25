@extends('layouts.app')

@section('content')
    @while (have_posts())
        @php(the_post())
        <article id="entry-post-content" class="max-w-2xl mx-auto px-4 md:px-0 mt-24 section-page ">
            <h1 class="text-5xl/snug font-semibold">{!! $title !!}</h1>
            @if ($summary)
                <p class="mt-4 text-lg text-gray-400 font-medium">{!! $summary !!}</p>
            @endif
            <div class="entry-content entry-post-content mt-7">
                {!! the_content() !!}
            </div>
        </article>

        <x-related-posts :taxonomies="$categories" :postid="$postID" />
    @endwhile
@endsection
