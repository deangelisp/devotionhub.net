<div class="text-sm">
    @if ($address)
        <p class="font-medium mt-6 ">Address:</p>
        <p>{!! $address !!}</p>
    @endif
    @if ($phone || $email)
        <p class="font-medium mt-6">Contact:</p>
        <p>
            <a class="inline-block py-2 md:py-0 link-on-hover"
                href="tel:{!! generate_tel_url($phone) !!}">{!! $phone !!}</a>
        </p>
        <p>
            <a class="inline-block py-2 md:py-0 link-on-hover"
                href="mailto:{!! $email !!}">{!! $email !!}</a>
        </p>
    @endif
</div>
