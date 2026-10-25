<div id="mobile-menu" class="mobile-menu z-50 transition-3s lg:hidden">
    <div class="container pt-8 max-w-lg">
        <div class="mt-10 md:mt-16">
            @if ($primaryNavigation)
                <nav id="mobile-menu-nav" class="mobile-menu-nav transition-all relative block ">
                    <ul>
                        @foreach ($primaryNavigation as $item)
                            <li
                                class="mobile-menu-loop-item  first-nav mb-0 @if ($item['children']) has-children @endif">

                                @if ($item['children'])
                                    <button
                                        class="flex justify-between items-center px-3 py-2 w-full mobile-menu-open-submenu ">
                                        {!! $item['title'] !!}

                                        <span class="flex items-center gap-2 text-sm md:text-lg">
                                            <span>View Submenu</span>
                                            @svg('images.svg.icons.arrow-right', 'inline-block w-2 ml-1 transition-all')
                                        </span>
                                    </button>
                                    <ul class="mobile-menu-submenu ">
                                        <button class="mobile-menu-close-submenu flex items-center px-3 py-2 w-full ">
                                            @svg('images.svg.icons.arrow-left', 'inline-block w-2 mr-2 transition-all')
                                            <span class="text-sm md:text-lg">Close Submenu</span>
                                        </button>
                                        <a href="{!! $item['url'] !!}" target="{!! $item['target'] !!}"
                                            class="{!! $item['classes'] ?? '' !!} inline-block px-3 py-2 w-full ">
                                            {!! $item['title'] !!}
                                        </a>

                                        @foreach ($item['children'] as $child)
                                            <li class="mobile-menu-submenu-item ">
                                                <a href="{!! $child['url'] !!}" target="{!! $child['target'] !!}"
                                                    class="{!! $child['classes'] ?? '' !!} inline-block px-3 py-2 w-full ">
                                                    {!! $child['title'] !!}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{!! $item['url'] !!}" target="{!! $item['target'] !!}"
                                        class="{!! $item['classes'] ?? '' !!} inline-block px-3 py-2 w-full ">
                                        {!! $item['title'] !!}
                                    </a>
                                @endif

                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endif
        </div>
    </div>

    @if (isset($headerCTA['url']))
        <a href="{!! $headerCTA['url'] !!}" target="{!! $headerCTA['target'] !!}"
            class="btn btn-primary absolute bottom-3 left-3 right-3">{!! $headerCTA['title'] !!}</a>
    @endif
</div>
