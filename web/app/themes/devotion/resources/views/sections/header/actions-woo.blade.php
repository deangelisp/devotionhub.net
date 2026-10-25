<div>
    <div class="flex items-center">
        {{-- My Account --}}
        <div class="mr-7">
            <span class="block font-bold text-sm">My Account
                @svg('images.svg.icons.arrow-down', ['inline-block w-2.5 ml-1 transition-all'])</span>
            <span class="text-dark-tone block text-xs mb-0.5">Hello, Sign In</span>
        </div>

        {{-- Wishlist --}}
        <div class="relative  mr-7">
            @svg('images.svg.icons.wishlist', ['w-7 flex-shirink-0'])
            <span
                class="bg-primary absolute flex items-center justify-center -top-1 -right-2 w-4 h-4 text-white rounded-full text-2xs">
                <span class="leading-4">0</span>
            </span>
        </div>

        {{-- Shopping Cart --}}
        <div class="relative  mr-4">
            @svg('images.svg.icons.shopping-cart', ['w-7 flex-shirink-0'])
            <span
                class="bg-primary absolute flex items-center justify-center -top-1 -right-2 w-4 h-4 text-white rounded-full text-2xs">
                <span class="leading-4">0</span>
            </span>
        </div>

        <div>
            <span class="text-dark-tone block text-xs mb-0.5">0 items</span>
            <span class="block font-bold text-lg leading-4">$0.00</span>
        </div>
    </div>
</div>
