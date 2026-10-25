<footer id="main-footer" class="main-footer">
    <div class="container pt-20 pb-10 md:pb-16 ">
        <figure class="flex justify-center">
            {!! $logo !!}
        </figure>

        @if ($menu)
            <div class="flex items-center justify-center mt-8 gap-4 md:gap-8 flex-col md:flex-row flex-wrap">
                @foreach ($menu as $item)
                    <a href="{!! $item['url'] !!}" target="{!! $item['target'] !!}"
                        class="link-on-hover py-2 md:py-0">{!! $item['title'] !!}</a>
                @endforeach
            </div>
        @endif

    </div>
    @include('sections.footer.copyright')
</footer>
