<div id="block-pos-{!! $id !!}"
    class="mb-16  pt-20 md:pt-28 @if ($block['background_element'] != 'none') pb-20 md:pb-28 @endif {!! $textColor !!} block-simple-header relative">
    <x-background-block :block="$block" />
    <div class="relative container">
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
