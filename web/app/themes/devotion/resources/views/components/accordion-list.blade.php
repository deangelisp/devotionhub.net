@if ($items)
    <div class="accordion-container {!! $className !!}">
        @foreach ($items as $item)
            <div class="accordion-item">
                <div class="accordion-heading cursor-pointer select-none py-5 flex items-center">
                    <h3 class="text-xl w-full ">
                        {!! $item['heading'] !!}
                    </h3>
                    <span class="block  flex-shrink-0 p-2">
                        @svg('images.svg.icons.arrow-down', 'w-4 h-4 fill-current accordion-icon -rotate-90 transition-all')
                    </span>
                </div>
                <div class="accordion-content ">
                    <div class="entry-content pb-5">
                        {!! $item['body'] !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {!! getFaqStructuredData($items) !!}
@endif
