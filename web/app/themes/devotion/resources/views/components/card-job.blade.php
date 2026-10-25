<div class="border py-6 pl-7 pr-3 rounded">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-bold">
            <a href="{!! $link['url'] !!}" class="hover:underline">{!! $title !!}</a>
        </h2>
        <x-button :link="$link" :label="'View job'" style="tertiary" />
    </div>
    <div class="pr-4">
        <p class="text-sm text-dark-tone">{!! $excerpt !!}</p>

        <div class="flex items-center mt-4 gap-8 text-dark-tone">
            @if ($location)
                <p>
                    @svg('images.svg.icons.box', 'h-5 w-5 fill-current inline-block mr-1')
                    <span class="text-sm ">{!! $location !!}</span>
                </p>
            @endif
            @if ($jobtype)
                <p>
                    @svg('images.svg.icons.box', 'h-5 w-5 fill-current inline-block mr-1')
                    <span class="text-sm ">{!! $jobtype !!}</span>
                </p>
            @endif
        </div>
    </div>
</div>
