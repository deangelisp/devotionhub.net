<div
    class="{!! $bgColor !!} radius flex items-center gap-10 px-6 md:px-12 py-8 justify-center md:justify-between mb-8 mt-8 flex-wrap md:flex-nowrap ">

    <div>
        @if ($label)
            <span class="block mb-6">
                <x-chip>{{ $label }}</x-chip>
            </span>
        @endif

        <div class="entry-content">

            {!! $content !!}
        </div>
    </div>

    @if ($image)
        <figure class="max-w-[200px] flex-shrink-0">
            {!! $image !!}
        </figure>
    @endif
</div>
