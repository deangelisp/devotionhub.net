{{-- <div {{ $attributes->merge(['class' => $type]) }}>
    {!! $message ?? $slot !!}
</div> --}}


<div class="p-4 mb-4  border radius {!! $className !!}" role="alert">
    @if ($title)
        <div class="flex items-center">
            @svg('images.svg.icons.info', 'h-4 w-4 fill-current mr-2')
            <span class="text-lg font-medium">{!! $title !!}</span>
        </div>
    @endif
    @if ($slot)
        <div class="@if ($title) mt-2 @endif text-sm entry-content">
            <p>{!! $slot !!}</p>
        </div>
    @endif
    <div class="flex gap-2">
        @if ($buttons)
            @foreach ($buttons as $button)
                <a href="{{ $button['url'] }}"
                    class="btn-alert btn-alert--{!! $button['type'] ?? '' !!} {!! $type !!} small">
                    {!! $button['label'] !!}
                </a>
            @endforeach
        @endif
        {{-- <button type="button"
            class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="me-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 14">
                <path
                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z">
                </path>
            </svg>
            View more
        </button>
        <button type="button"
            class="text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800"
            data-dismiss-target="#alert-additional-content-1" aria-label="Close">
            Dismiss
        </button> --}}
    </div>
</div>
