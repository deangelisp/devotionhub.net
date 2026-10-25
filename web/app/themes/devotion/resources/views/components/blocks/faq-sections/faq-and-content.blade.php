<div id="block-pos-{!! $id !!}"
    class="section-page container block-faq-and-content grid md:grid-cols-2 gap-10 md:gap-20">
    <div class="@if ($listPositioning == 'list-left') lg:order-2 @endif">
        <x-heading :uppertitle="$uppertitle">{!! $title !!}</x-heading>
        @if ($content)
            <div class="entry-content mt-6">
                {!! $content !!}
            </div>
        @endif
    </div>
    @if ($faqList)
        <x-accordion-list :items="$faqList" className="@if ($listPositioning == 'list-left') lg:order-1 @endif" />
    @endif
</div>
