<div class="section-page container block-bible-books pt-10 sm:pt-20 md:pt-28">
    <x-heading tag="h1" className="text-center lg:px-5 mb-4">{!! $title !!}</x-heading>
    <div class="max-w-3xl text-center mb-14 mx-auto text-sm">{!! $content !!}</div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($books as $book)
            <div
                class="flex gap-2 items-center border border-gray-100 p-2 rounded-sm relative hover:bg-gray-50 transition-all">
                <div>

                    <h3 class="text-lg">{!! $book['title'] !!}</h3>
                    <p class="text-xs text-gray-500">{!! $book['description'] !!}</p>
                </div>
                <img src="{!! $book['image'] !!}" alt="{!! $book['title'] !!}" width="150" height="150"
                    class="aspect-square object-cover flex-shrink-0 w-20 rounded overflow-hidden">

                <a href="{!! $book['url'] !!}" class="absolute top-0 left-0 w-full h-full">
                    <span class="sr-only">Read the Bible Book of {!! $book['title'] !!}</span>
                </a>
            </div>
        @endforeach
    </div>

</div>
