@if ($headerCTA)
    <span class="hidden md:inline-block">
        <a href="{!! $headerCTA['url'] !!}" target="{!! $headerCTA['target'] !!}"
            class="btn btn-primary  btn--highlight">{!! $headerCTA['title'] !!}</a>
    </span>
@endif
<button id="header-menu" class="header-menu block lg:hidden text-primary ml-4 " aria-label="Mobile Menu">
    @svg('images.svg.icons.menu', 'w-14 md:w-12 ham hamRotate ham1 stroke-current')
</button>
