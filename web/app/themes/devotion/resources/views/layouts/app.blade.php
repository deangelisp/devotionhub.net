<a class="sr-only focus:not-sr-only" href="#main">
    {{ __('Skip to content') }}
</a>

<x-header-spotlight-bar :message="$headerSpotilight" />
@include('sections.header')

<main id="main" class="main flex-grow">
    @yield('content')
</main>


@include('sections.global')

@include('sections.footer')
