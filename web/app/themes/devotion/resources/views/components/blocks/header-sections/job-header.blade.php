<div class="mb-16 py-12 header-section-job-header">
    <div class="container grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-20 items-center">
        <div class="lg:col-span-2">
            @if (isset($jobType))
                <span class="block mb-1 text-primary text-sm font-semibold">
                    {!! $jobType !!}
                </span>
            @endif
            <x-heading tag="h1" className="text-3xl font-medium">{!! $title !!}</x-heading>
            <span class="text-medium-dark-tone mt-4 block">Posted on {!! $posted !!}</span>
        </div>
        <div>
            @if ($form)
                <x-button :link="$formLinkButton" className="w-full">
                    @svg('images.svg.icons.up-right-arrow', 'h-3 w-3 fill-current')
                </x-button>
                <span class="block text-center text-sm mt-3 text-primary">Aplication ends:
                    <span class="font-semibold">{!! $deadline !!}</span>
            @endif
        </div>
    </div>
</div>
