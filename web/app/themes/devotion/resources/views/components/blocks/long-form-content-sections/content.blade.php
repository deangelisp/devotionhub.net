<div id="block-pos-{!! $id !!}" class=" section-page block-content">
    <div class="{!! $className !!} container ">
        @if ($title)
            <x-heading :uppertitle="$uppertitle">{!! $title !!}</x-heading>
        @endif
        <div class="entry-content mt-8">{!! $content !!}</div>
    </div>
</div>
