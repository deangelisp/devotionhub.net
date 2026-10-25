@if ($cards)
    <div id="block-pos-{!! $id !!}"
        class="section-page block-card-grid relative @if ($tinted) block-card-grid--tinted @endif">
        <div class="container">
            @if ($title || $content)
                <div class="max-w-3xl mb-12">
                    <x-heading :uppertitle="$uppertitle">{{ $title }}</x-heading>
                    @if ($content)
                        <div class="entry-content mt-6">
                            {!! $content !!}
                        </div>
                    @endif
                </div>
            @endif

            <ol class="grid grid-cols-1 {!! $gridClassName !!} gap-6">
                @foreach ($cards as $index => $card)
                    <li class="block-card-grid__card">
                        @if ($numbered)
                            <span class="block-card-grid__number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        @endif
                        @if ($card['label'])
                            <span class="block-card-grid__label">{!! $card['label'] !!}</span>
                        @endif
                        <h3 class="text-xl font-bold mt-2">{!! $card['title'] !!}</h3>
                        @if ($card['text'])
                            <p class="mt-3">{!! $card['text'] !!}</p>
                        @endif
                    </li>
                @endforeach
            </ol>

            @if ($buttons)
                <x-buttons-list :buttons="$buttons" className="mt-12" />
            @endif
        </div>
    </div>
@endif
