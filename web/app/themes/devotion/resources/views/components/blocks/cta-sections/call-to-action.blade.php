<div id="block-pos-{!! $id !!}"
    class="section-page relative @if ($style != 'card') py-16 @endif block-call-to-action">
    <div class="container @if ($style == 'card') border border-black py-16 relative @endif">
        <x-background-block :block="$block" />
        <div class="max-w-3xl mx-auto relative {!! $textColor !!}">
            <x-heading :uppertitle="$uppertitle" className="text-center lg:px-5">{!! $title !!}</x-heading>
            @if ($content)
                <div class="entry-content mt-8">
                    {!! $content !!}
                </div>
            @endif

            @if ($buttons)
                <x-buttons-list :buttons="$buttons" className="mt-10 flex justify-center" />
            @endif
        </div>
    </div>
</div>
