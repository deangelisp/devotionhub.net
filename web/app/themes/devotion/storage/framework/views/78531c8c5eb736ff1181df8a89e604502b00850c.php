<form role="search" method="get" id="searchform" action="<?php echo home_url('/bible-search'); ?>" class="relative mb-5">
    <label for="default-search" class="sr-only">Bible
        Search</label>
    <input type="text" name="s" id="s" placeholder="Search for Book, Chapter, and Verses..."
        class="w-full pl-2 py-4 md:text-sm relative border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all
            pb-16 md:pb-4
        " />

    <button type="submit"
        class="btn small flex-shrink-0 rounded-md absolute bottom-2 md:bottom-auto left-2 md:left-auto md:top-1/2 md:-translate-y-1/2 right-2 ">Search</button>
</form>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/search-bar.blade.php ENDPATH**/ ?>