<div id="{!! $id !!}"
    class="w-svw h-svh bg-light-tone flex justify-center items-center top-0 left-0 component-modal component-modal__close fixed
    
        @if ($display) is-active @endif
    ">
    <div class=" max-w-md">
        <div class="bg-white shadow-md shadow-gray-600 component-modal-stage rounded-2xl component-modal__content"
            style="">
            <div class="border border-medium-light-tone w-full h-full rounded-xl relative p-8">
                <button
                    class="close-modal btn-close-cross absolute top-2 right-2 text-xl text-medium-tone w-6 h-6 component-modal__close">&#10005;</button>

                @if ($title)
                    <span class="block text-xl font-semibold leading-5 mb-5 text-center">{!! $title !!}</span>
                @endif

                <div class="text-center">
                    {!! $slot !!}
                </div>
            </div>
        </div>
    </div>
</div>
