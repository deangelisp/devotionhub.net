<div id="block-pos-{!! $id !!}"
    class="py-12 @if ($block['background_element'] != 'none')  @endif {!! $textColor !!} block-full-screen-header relative mb-16  flex items-center">
    <x-background-block :block="$block" />
    <div class="relative container w-full">
        <div class="lg:w-6/12">
            <x-heading :uppertitle="$uppertitle" tag="h1">{!! $title !!}</x-heading>
            @if ($content)
                <div class="entry-content mt-4">
                    {!! $content !!}
                </div>
            @endif
        </div>
        <x-buttons-list :buttons="$buttons" className="mt-6" />

    </div>
</div>
