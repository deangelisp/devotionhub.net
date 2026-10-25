@if ($primaryNavigation)
    <nav id="nav-primary" class="nav-primary transition-all relative block" aria-label="{!! wp_get_nav_menu_name('primary_navigation') !!}">
        <ul class="nav-primary-loop max-w-none mx-0 flex flex-row items-center  font-medium">
            @foreach ($primaryNavigation as $item)
                <li
                    class="nav-primary-loop-item menu-item relative first-nav mb-0 @if ($item['children']) has-children @endif">
                    <a href="{!! $item['url'] !!}" target="{!! $item['target'] !!}"
                        class="{!! $item['classes'] ?? '' !!} inline-block px-3 py-2 w-full ">
                        {!! $item['title'] !!}
                        @if ($item['children'])
                            <span class="arrow-down ">
                                @svg('images.svg.icons.arrow-down', 'inline-block w-2.5 ml-1 transition-all')
                            </span>
                        @endif
                    </a>

                    @if ($item['children'])
                        <ul class="submenu absolute w-60 radius p-2 left-0 bg-white top-full border border-primary">
                            @foreach ($item['children'] as $child)
                                <li class="menu-item">
                                    <a href="{!! $child['url'] !!}" target="{!! $item['target'] !!}"
                                        class="block py-2 px-4 menu-item-link radius {!! $child['classes'] ?? '' !!} ">
                                        {!! $child['title'] !!}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </li>
            @endforeach
        </ul>
    </nav>
@endif
