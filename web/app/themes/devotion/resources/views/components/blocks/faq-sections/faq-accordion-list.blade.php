<div id="block-pos-{!! $id !!}" class="section-page container block-faq-accordion-list">
    <div class="max-w-4xl mx-auto">
        <x-heading :uppertitle="$uppertitle" className="text-center">{!! $title !!}</x-heading>
        @if ($content)
            <div class="entry-content mt-6">
                {!! $content !!}
            </div>
        @endif
        @if ($faqList)
            <div class="mt-12">
                <x-accordion-list :items="$faqList" />
            </div>
        @endif
        @if ($footer)
            <div class="mt-12 lg:mt-20 entry-content ">
                {!! $footer !!}
            </div>
        @endif
    </div>
</div>
