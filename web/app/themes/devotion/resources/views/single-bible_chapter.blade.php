@extends('layouts.app')

@section('content')
    @while (have_posts())
        @php(the_post())

        <div class="lg:flex gap-20 container section-page pt-10 sm:pt-20">
            <div class="w-full">
                <article class="w-full @if ($blocks) mb-24 @endif">
                    <div class="">
                        <h1 class="text-4xl mb-10 md:mb-20 text-center">
                            <span class="title">{!! $title !!}</span>
                            <span class="block text-base font-normal text-gray-400 mt-4">{!! $subtitle !!}</span>
                        </h1>
                    </div>
                    @if ($verses)
                        <div class="entry-verses text-xl mb-20">
                            {!! '<p>' !!}
                            @foreach ($verses as $verse)
                                @if (!$verse['nobreak'])
                                    {!! '</p><p>' !!}
                                @endif
                                @if (!empty($verse['verse']))
                                    @if ($verseFrom)
                                        <span href="{!! "{$chapterUrl}/verse-{$verse['verse']}/" !!}"
                                            class="verse-number text-xs align-super font-medium text-gray-400 inline-block ml-1 select-none">
                                            {!! $verse['verse'] !!}
                                        </span>
                                    @else
                                        <a href="{!! "{$chapterUrl}/verse-{$verse['verse']}/" !!}"
                                            class="verse-number text-xs align-super font-medium text-gray-400 inline-block ml-1 select-none">
                                            {!! $verse['verse'] !!}
                                        </a>
                                    @endif
                                @endif
                                <span class="verse-text">{!! $verse['text'] !!}</span>
                            @endforeach
                            {!! '</p>' !!}
                        </div>
                    @endif
                    @if ($verseFrom)
                        <div class="text-center justify-center">
                            <x-button-pagination :url="$chapterUrl" title="Read the full chapter"
                                subtitle='{!! "$bookTitle $chapter" !!}' side="false" />
                        </div>
                    @else
                        <div class="flex justify-between items-start">
                            @if ($previousLink)
                                <x-button-pagination :url="$previousLink['url']" :title="$previousLink['title']" :subtitle="$previousLink['subtitle']" side="left" />
                            @else
                                <span></span>
                            @endif
                            @if ($nextLink)
                                <x-button-pagination :url="$nextLink['url']" :title="$nextLink['title']" :subtitle="$nextLink['subtitle']" />
                            @endif
                        </div>
                    @endif
                </article>

                <div class="content-for-sidebar">
                    @if ($blocks)
                        @include('partials.blocks.init', ['blocks' => $blocks])
                    @endif

                    @if ($paragraph || $notes)
                        <div class=" mt-24 ">
                            <div class="entry-content">

                                @if ($paragraph)
                                    <h2 class="text-xl font-regular  mb-2">
                                        Understanding the Key Messages in
                                        {!! $bookTitle !!}
                                        {!! $chapter !!}: Insights
                                        and Explanation</h2>
                                    <p>
                                        {!! $paragraph !!}
                                    </p>
                                    @if ($notes)
                                        <span class="mb-10 block"></span>
                                    @endif
                                @endif

                                @if ($notes)
                                    <h2 class="text-xl font-regular mb-2">Notes</h2>
                                    <p>{!! $notes !!}</p>
                                @endif

                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <aside class="relative chapter-sidebar flex-shrink-0 pt-20 lg:pt-40 text-sm">
                <div class="sticky top-28">
                    <x-search-bar />
                    <div id="table-of-contents" class="table-of-contents flex flex-col gap-4"></div>
                    <x-verse-media-container :media="$youtubeMedia" :displaytitle="!$verseFrom" />
                    {{-- 
                    @if ($verseFrom)
                        @if ($verseShortDescription)
                            <div class="entry-content  text-gray-600">
                                @if (!$blocks)
                                    <h2 class="text-lg text-slate-500 font-medium">Meaning of {!! $title !!}</h2>
                                @endif
                                <p>
                                    {!! $verseShortDescription !!}
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="entry-content  text-gray-600">
                            @if ($paragraph)
                                <h2 class="text-lg text-slate-500 font-medium ">
                                    Understanding the Key Messages in<br />
                                    {!! $bookTitle !!}
                                    {!! $chapter !!}: Insights
                                    and Explanation</h2>
                                <p>
                                    {!! $paragraph !!}
                                </p>
                                @if ($notes)
                                    <span class="mb-10 block"></span>
                                @endif
                            @endif
                            @if ($notes)
                                <h2 class="text-lg  text-slate-500 font-medium">Notes</h2>
                                <p>{!! $notes !!}</p>
                            @endif
                        </div>
                        {!! $thumbnail !!}
                    @endif --}}
                </div>
            </aside>
        </div>
        <x-cross-references :crossReferences="$crossReferences" :title="$title" />
    @endwhile
@endsection
