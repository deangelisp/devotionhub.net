@if ($buttons)
    <div class="flex flex-wrap lg:flex-nowrap gap-4 {!! $className !!}">
        @foreach ($buttons as $button)
            <x-button :link="$button['link']" :style="$button['style']" />
        @endforeach
    </div>
@endif
