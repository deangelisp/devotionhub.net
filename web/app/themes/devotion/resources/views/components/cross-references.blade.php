@if ($crossReferences)
    <div class="container section-page">
        <h2 class="mb-8">Cross References for {!! $title !!}</h2>
        <div class="">
            @foreach ($crossReferences as $crossReference)
                <div>
                    @if (isset($crossReference['verse']))
                        <h3 class="mb-4">{!! $title !!}:{!! $crossReference['verse'] !!}</h3>
                    @endif
                    <div class="grid grid-cols-4 gap-x-6 gap-y-5 mb-12">
                        @foreach ($crossReference['references'] as $ref)
                            <p class="cross-reference-loop-item text-sm  pb-5 relative">
                                <span class="relative block">
                                    <span class="font-semibold">{!! $ref['verse'] !!}</span> -
                                    <span>{!! $ref['text'] !!}</span>
                                </span>
                                <span
                                    class="block text-xs absolute bottom-0 left-0 w-full text-center text-dark-tone opacity-0 transition-all duration-300">Click
                                    to read the verse {!! $ref['verse'] !!}</span>
                                <a href="{!! $ref['url'] !!}" class="cross-reference-loop-item-link"><span
                                        class="sr-only">Click
                                        to read the verse {!! $ref['verse'] !!}</span></a>
                            </p>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
