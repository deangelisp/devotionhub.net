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
                <span class="block text-lg font-medium"><?php echo $uppertitle; ?></span>
                <?php echo $title; ?>

            </h1>
            <div class="entry-content">
                <?php echo $content; ?>

            </div>
            <form id="form-course-subscribe" class="md:flex gap-1 mt-8" method="post" action="">
                <input type="hidden" name="recaptcha_token" id="recaptchaToken">
                <input type="hidden" id="timezone" name="timezone" value="">
                <input type="hidden" name="nonce" value="<?php echo e(wp_create_nonce('subscribe')); ?>">
                <input type="hidden" name="action" value="subscribe">
                <input type="hidden" name="course_id" value="<?php echo $post_id; ?>">
                <input type="email" placeholder="Enter your email"
                    class="w-full md:w-1/2 py-3 px-4 bg-white text-black radius mb-2 md:mb-0" required="true"
                    name="email">
                <button class="g-recaptcha btn--highlight w-full md:w-auto" data-sitekey="<?php echo $_ENV['GOOGLE_RECAPTCHA_KEY']; ?>"
                    data-callback='onSubmit' data-action='submit'>Subscribe</button>
            </form>
        </div>
        <figure
            class=" <?php echo $aspect_ratio; ?> <?php if($aspect_ratio != 'auto'): ?> thumbnail-styled <?php endif; ?> radius shadow-2xl">
            <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $image,'className' => 'thumbnail'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Image::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd)): ?>
<?php $component = $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd; ?>
<?php unset($__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd); ?>
<?php endif; ?>
        </figure>
    </div>
</div>
<?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/components/blocks/header-sections/lading-page-header.blade.php ENDPATH**/ ?>