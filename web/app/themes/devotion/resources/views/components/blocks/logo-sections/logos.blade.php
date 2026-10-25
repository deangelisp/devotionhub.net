@if ($logos)
    <div id="block-pos-{!! $id !!}" class=" section-page">
        <div class="container flex items-center flex-wrap md:flex-nowrap">
            <div class="w-full md:w-60 xl:w-80 flex-shrink-0 mr-10 lg:mr-20">
                <x-heading :uppertitle="$uppertitle">{{ $title }}</x-heading>
                @if ($content)
                    <div class="entry-content mt-6 ">
                        {!! $content !!}
                    </div>
                @endif
                @if ($buttons)
                    <x-buttons-list :buttons="$buttons" className="md:mt-6 justify-center" />
                @endif
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-8 lg:gap-10 mt-10 md:mt-0">
                @foreach ($logos as $logo)
                    <x-image :id="$logo['image']" className="w-full h-20 object-contain " aspect="auto" />
                @endforeach
            </div>
        </div>

        {{-- <div class="container">
            @if ($buttons)
                <x-buttons-list :buttons="$buttons" className="mt-12 md:mt-20 justify-center" />
            @endif
        </div> --}}
    </div>
@endif
