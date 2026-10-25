@if ($globalMessage)
    <x-modal id="global-message" :title="$globalMessage['title']" display="true">
        {!! $globalMessage['message'] !!}
    </x-modal>
@endif
