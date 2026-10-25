@extends('layouts.app')

@section('content')
    <div class="lg:flex gap-20 container section-page pt-10 sm:pt-20">
        <div class="w-full">
            <div class="mb-10 md:mb-20 flex items-center justify-between gap-10">
                <div>
                    <h1 class="text-4xl ">
                        {!! $title !!}
                    </h1>
                    <p class="block text-base font-normal text-gray-400 mt-4 max-w-xl">{!! $excerpt !!}</p>
                </div>
                <figure class="hidden md:block">
                    {!! $thumbnail !!}
                </figure>
            </div>

            @if ($chapters)
                <h2 class="text-2xl font-bold mb-4">Chapters in {!! $title !!}</h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4 lg:gap-5 section-page">
                    @foreach ($chapters as $chapter)
                        <x-card-chapter :chapter="$chapter" :url="$url" />
                    @endforeach
                </div>
            @endif

            @if ($description)
                <h2 class="text-2xl font-bold mb-4">Summary of the {!! $title !!}</h2>
                <div class="entry-content">
                    {!! $description !!}
                </div>
            @endif

            {{-- Faq --}}
            @if ($faq)
                <div class="mt-16">
                    @include('components.blocks.faq-sections.faq-accordion-list', $faq)
                </div>
            @endif


        </div>

        <aside class="relative chapter-sidebar flex-shrink-0 pt-20 lg:pt-40">
            <div class="sticky top-28">
                <x-search-bar />
                <x-bible-books-cloud />
            </div>
        </aside>
    </div>
    @if (isset($extraData) && $extraData)
        @include('partials.blocks.init', ['blocks' => $extraData])
    @endif
@endsection
