@if ($assistant)
    <div class="product-assistant flex items-center mb-8">
        <figure class="mr-4 rounded-full overflow-hidden flex-shrink-0">
            {!! $assistant['avatar'] !!}
        </figure>
        <div>
            <p class="text-sm text-dark-tone mb-0.5">Have a Question? Ask {{ $assistant['name'] }}</p>
            <p>
                <a class="text-xl" href="{!! generate_tel_url($sitePhoneNumber) !!}">
                    {!! $sitePhoneNumber !!}
                </a>
            </p>
        </div>
    </div>
@endif
