<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        const form = document.getElementById("form-course-subscribe");
        if (form.checkValidity()) {
            // If the form is valid, submit it
            form.submit();
        } else {
            // Otherwise, show validation errors
            form.reportValidity();
        }
    }
</script>

<div class="block-landing-page-header mb-20 py-10 md:py-20">
    <div class=" container grid md:grid-cols-2 gap-20 items-center text-white">
        <div>
            <h1 class="md:text-5xl font-bold mb-4">
                <span class="block text-lg font-medium">{!! $uppertitle !!}</span>
                {!! $title !!}
            </h1>
            <div class="entry-content">
                {!! $content !!}
            </div>
            <form id="form-course-subscribe" class="md:flex gap-1 mt-8" method="post" action="">
                <input type="hidden" name="recaptcha_token" id="recaptchaToken">
                <input type="hidden" id="timezone" name="timezone" value="">
                <input type="hidden" name="nonce" value="{{ wp_create_nonce('subscribe') }}">
                <input type="hidden" name="action" value="subscribe">
                <input type="hidden" name="course_id" value="{!! $post_id !!}">
                <input type="email" placeholder="Enter your email"
                    class="w-full md:w-1/2 py-3 px-4 bg-white text-black radius mb-2 md:mb-0" required="true"
                    name="email">
                <button class="g-recaptcha btn--highlight w-full md:w-auto" data-sitekey="{!! $_ENV['GOOGLE_RECAPTCHA_KEY'] !!}"
                    data-callback='onSubmit' data-action='submit'>Subscribe</button>
            </form>
        </div>
        <figure
            class=" {!! $aspect_ratio !!} @if ($aspect_ratio != 'auto') thumbnail-styled @endif radius shadow-2xl">
            <x-image :id="$image" className="thumbnail" />
        </figure>
    </div>
</div>
