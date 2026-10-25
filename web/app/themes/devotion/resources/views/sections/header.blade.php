@if ($navbar)
    <header id="main-header"
        class="main-header-navbar flex justify-center flex-col sticky top-0  navbar-{!! $navbar !!}">
        @include('sections.header.blocks.' . $navbar)
        @include('sections.header.progress-bar')
    </header>
    @include('sections.header.mobile-menu')
@endif
