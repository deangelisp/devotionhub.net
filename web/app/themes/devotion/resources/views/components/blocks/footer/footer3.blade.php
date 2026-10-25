<footer id="main-footer" class="main-footer">
    <div class="container pt-6 pb-6 flex flex-col-reverse md:grid md:grid-cols-2 gap-12 md:gap-20">
        <x-bible-books-cloud />
        {{-- <div class="flex-shrink-0  lg:ml-10 lg:w-20">
            <span class="text-sm text-dark-tone font-semibold mb-3 block">Follow Us</span>
            <x-grid-social-medias :socials="$socials" className="flex lg:grid  lg:grid-cols-2 gap-4 "
                iconSize="w-8 h-auto" />
        </div> --}}
        {{-- @include('sections.footer.menu') --}}
        <div class="entry-content">
            <h2 class="text-2xl">Begin a New Journey Through the Bible</h2>
            <p class="mb-3 text-sm text-dark-tone ">Discover a deeper connection to your faith, one day at a time.</p>
            <p>Walk through the whole story of Scripture, from Genesis to Jesus, with our<br /><span
                    class="bg-sky-600 py-1 px-2 rounded-md text-sky-50 font-medium">FREE 90-Day Journey</span>.
                Each day takes about 12 minutes: read a passage, learn what it means, reflect and pray, with
                everything kept in your own private journal.</p>
            <p class="mt-4 md:mt-10"><a href="{{ \App\View\Composers\App::journeyLink() }}"
                    class="btn">Start Your Journey Today – <strong>It’s Free!</strong> </a></p>
        </div>
    </div>
    @include('sections.footer.copyright')
</footer>
