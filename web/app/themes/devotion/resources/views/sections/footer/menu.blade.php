<div class="flex items-start w-full lg:w-3/5 lg:justify-end flex-wrap gap-10 f">
    @if ($menu)
        @foreach ($menu as $menuList)
            <div class="text-sm  w-full md:w-1/4">
                @foreach ($menuList['menu_list'] as $menuItem)
                    @if (isset($menuItem['link']['url']))
                        <div>
                            <a class="link-on-hover inline-block py-1 
                            @if ($menuItem['is_title']) font-bold  @else mb-1 @endif
                            "
                                href="{{ $menuItem['link']['url'] }}" target="{{ $menuItem['link']['target'] }}">
                                {!! $menuItem['link']['title'] !!}
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    @endif
</div>
