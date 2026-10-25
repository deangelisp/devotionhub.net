@if ($logos)
    <div id="block-pos-{!! $id !!}" class=" section-page">
        <div class="container">
            <x-heading :uppertitle="$uppertitle" className="text-center">{{ $title }}</x-heading>
            @if ($content)
                <div class="entry-content mt-6 ">
                    {!! $content !!}
                </div>
            @endif
        </div>

        <div class="mt-12 md:mt-20 relative">
            <div id="logo-cloud-loop" class="logo-cloud flex items-center relative ">
                @foreach ($logos as $logo)
                    <x-image :id="$logo['image']" className="logo-cloud-item-image " />
                    <span class="block pl-14 logo-cloud-item-image"></span>
                @endforeach
            </div>
            <div class="scroll-disabler absolute top-0 left-0 w-full h-full"></div>
        </div>

        <div class="container">
            @if ($buttons)
                <x-buttons-list :buttons="$buttons" className="mt-12 md:mt-20 justify-center" />
            @endif
        </div>
    </div>
@endif
