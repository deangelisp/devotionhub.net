<div class="container grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-20 block-contact-info-and-form section-page">
    <div>
        <x-heading :uppertitle="$uppertitle">{!! $title !!}</x-heading>
        @if ($content)
            <div class="entry-content mt-4 ">
                {!! $content !!}
            </div>
        @endif
        <div class="mt-8 md:mt-12">
            @if ($email)
                <p>
                    <a class="inline-flex items-center link-on-hover" href="mailto:{!! $email !!}">
                        @svg('images.svg.icons.email', 'h-5 w-5 inline-block mr-4 flex-shrink-0')
                        <span>{!! $email !!}</span>
                    </a>
                </p>
            @endif
            @if ($phone)
                <p class="mt-6">
                    <a class="inline-flex items-center link-on-hover" href="tel:{!! generate_tel_url($phone) !!}">
                        @svg('images.svg.icons.phone', 'h-5 w-5 inline-block mr-4 flex-shrink-0')
                        <span>{!! $phone !!}</span>
                    </a>
                </p>
            @endif
            @if ($address)
                <p class="mt-6">
                    @svg('images.svg.icons.location', 'h-5 w-5 inline-block mr-4 flex-shrink-0')
                    <span>{!! $address !!}</span>
                </p>
            @endif
        </div>
    </div>
    <div>
        @if ($forminatorFormId)
            {!! do_shortcode('[forminator_form id="' . $forminatorFormId . '"]') !!}
        @endif
    </div>
</div>
