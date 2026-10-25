@if ($background)
    <div class="absolute inset-0 thumbnail-frame @if ($parallax) bg-fixed @endif bg-cover bg-center
        @if ($type == 'color') {!! $background !!} @endif
        "
        @if ($type == 'image') style="background-image: url('{!! $background !!}');" @endif>
        @if ($type == 'video')
            <video class="thumbnail" autoplay loop muted playsinline>
                <source src="{{ $background }}" type="video/mp4">
            </video>
        @endif
    </div>

    {{-- Overlay --}}
    @if ($type != 'color')
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    @endif
@endif
