<div class="card-person flex items-center text-center flex-col pb-9 relative">
    <figure class="thumbnail-frame rounded-full w-20 h-20">
        {!! $thumbnail !!}
    </figure>
    <h3 class="mt-6 text-xl font-semibold mb-1 ">{!! $name !!}</h3>
    @if ($role)
        <p class="">{!! $role !!}</p>
    @endif
    @if ($department)
        <p class="">{!! $department !!}</p>
    @endif
    @if ($description)
        <p class=" text-sm mt-4 text-dark-tone">{!! $description !!}</p>
    @endif
    @if ($socialMedias)
        <div class="absolute bottom-0 left-0 w-full">
            <x-grid-social-medias :socials="$socialMedias" className="flex items-center justify-center gap-4"
                iconSize="h-4 w-4" />
        </div>
    @endif
</div>
