@if ($tabs)
    <div id="block-pos-{!! $id !!}" class="container section-page block-content-tabber">
        <div class="max-w-3xl mx-auto mb-24">
            <x-heading :uppertitle="$uppertitle" className="text-center">{!! $title !!}</x-heading>
            @if ($content)
                <div class="entry-content mt-8">
                    {!! $content !!}
                </div>
            @endif
        </div>
        <div class="tabber  {!! $tabLayout !!}">
            <div
                class="tabber-nav hidden md:flex @if ($tabLayout == 'extended') items-end  @else justify-center items-start @endif gap-10 mb-14">
                @foreach ($tabs as $key => $tab)
                    <div class="tabber-nav-item text-center
                        @if ($tabLayout == 'extended') flex-1 @endif cursor-pointer"
                        id="tab-{!! $key !!}">
                        @if ($tab['icon'])
                            <div class="mb-2">
                                @if ($tabLayout == 'extended')
                                    <figure class="flex-shrink-0 w-14 h-14  mb-4 thumbnail-frame mx-auto ">
                                        <x-image :id="$tab['icon']" className="thumbnail object-bottom object-contain"
                                            aspect="auto" />
                                    </figure>
                                @else
                                    <figure class="tabber-nav-item-icon mx-auto">
                                        <span class="thumbnail-frame w-8 h-8 block">
                                            <x-image :id="$tab['icon']"
                                                className="thumbnail object-bottom object-contain" aspect="auto" />
                                        </span>
                                    </figure>
                                @endif
                            </div>
                        @endif
                        <p
                            class="font-semibold mb-2 @if ($tabLayout == 'centralized') overflow-hidden text-sm whitespace-nowrap text-ellipsis @endif">
                            {!! $tab['title'] !!}</p>
                        @if ($tabLayout == 'extended' && $tab['short_tab_description'])
                            <p class="text-dark-tone ">{!! $tab['short_tab_description'] !!}</p>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="tabber-content relative">
                @foreach ($tabs as $key => $tab)
                    <div class="tabber-content-item" id="tab-content-{!! $key !!}">
                        <div class="block md:hidden">
                            <h3 class="font-semibold mb-2">{!! $tab['title'] !!}</h3>
                            @if ($tab['short_tab_description'])
                                <p class="text-dark-tone mb-4">{!! $tab['short_tab_description'] !!}</p>
                            @endif
                        </div>
                        @if ($tab['content_type'] == 'image')
                            <figure
                                class="thumbnail-styled @if (wp_is_mobile()) aspect-portrait @else aspect-video @endif">

                                @if (wp_is_mobile())
                                    <x-image :id="$tab['content_image']"
                                        className="thumbnail object-bottom object-cover md:object-contain"
                                        aspect="auto" />
                                @else
                                    <x-image :id="$tab['content_image']" className="thumbnail object-bottom object-cover"
                                        aspect="auto" />
                                @endif
                            </figure>
                        @elseif ($tab['content_type'] == 'video')
                            <div class="video-container">
                                <x-video :id="$tab['content_video']" :settings="$tab['content_video_settings']" />
                            </div>
                        @elseif ($tab['content_type'] == 'text')
                            <div class="entry-content">{!! $tab['content_text'] !!}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
