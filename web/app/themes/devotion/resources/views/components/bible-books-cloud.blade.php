<div class="{!! $className !!}">
    <h2 class="text-base font-bold mb-3">The Bible Books</h2>
    <ul class="flex flex-wrap gap-1">
        @foreach ($books as $book)
            <li class="">
                <a class="block py-0.5 px-2 bg-gray-100 rounded hover:bg-gray-200 transition-all text-sm"
                    href="{!! $book['url'] !!}" class="">{!! $book['title'] !!}</a>
            </li>
        @endforeach
    </ul>
</div>
