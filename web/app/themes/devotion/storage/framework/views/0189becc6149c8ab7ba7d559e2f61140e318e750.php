

<?php $__env->startSection('content'); ?>
    <?php while(have_posts()): ?>
        <?php (the_post()); ?>

        <div class="lg:flex gap-20 container section-page pt-10 sm:pt-20">
            <div class="w-full">
                <article class="w-full <?php if($blocks): ?> mb-24 <?php endif; ?>">
                    <div class="">
                        <h1 class="text-4xl mb-10 md:mb-20 text-center">
                            <span class="title"><?php echo $title; ?></span>
                            <span class="block text-base font-normal text-gray-400 mt-4"><?php echo $subtitle; ?></span>
                        </h1>
                    </div>
                    <?php if($verses): ?>
                        <div class="entry-verses text-xl mb-20">
                            <?php echo '<p>'; ?>

                            <?php $__currentLoopData = $verses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $verse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$verse['nobreak']): ?>
                                    <?php echo '</p><p>'; ?>

                                <?php endif; ?>
                                <?php if(!empty($verse['verse'])): ?>
                                    <?php if($verseFrom): ?>
                                        <span href="<?php echo "{$chapterUrl}/verse-{$verse['verse']}/"; ?>"
                                            class="verse-number text-xs align-super font-medium text-gray-400 inline-block ml-1 select-none">
                                            <?php echo $verse['verse']; ?>

                                        </span>
                                    <?php else: ?>
                                        <a href="<?php echo "{$chapterUrl}/verse-{$verse['verse']}/"; ?>"
                                            class="verse-number text-xs align-super font-medium text-gray-400 inline-block ml-1 select-none">
                                            <?php echo $verse['verse']; ?>

                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <span class="verse-text"><?php echo $verse['text']; ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo '</p>'; ?>

                        </div>
                    <?php endif; ?>
                    <?php if($verseFrom): ?>
                        <div class="text-center justify-center">
                            <?php if (isset($component)) { $__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4 = $component; } ?>
<?php $component = App\View\Components\ButtonPagination::resolve(['url' => $chapterUrl,'title' => 'Read the full chapter','subtitle' => ''."$bookTitle $chapter".'','side' => 'false'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button-pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ButtonPagination::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4)): ?>
<?php $component = $__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4; ?>
<?php unset($__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4); ?>
<?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="flex justify-between items-start">
                            <?php if($previousLink): ?>
                                <?php if (isset($component)) { $__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4 = $component; } ?>
<?php $component = App\View\Components\ButtonPagination::resolve(['url' => $previousLink['url'],'title' => $previousLink['title'],'subtitle' => $previousLink['subtitle'],'side' => 'left'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button-pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ButtonPagination::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4)): ?>
<?php $component = $__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4; ?>
<?php unset($__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4); ?>
<?php endif; ?>
                            <?php else: ?>
                                <span></span>
                            <?php endif; ?>
                            <?php if($nextLink): ?>
                                <?php if (isset($component)) { $__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4 = $component; } ?>
<?php $component = App\View\Components\ButtonPagination::resolve(['url' => $nextLink['url'],'title' => $nextLink['title'],'subtitle' => $nextLink['subtitle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button-pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ButtonPagination::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4)): ?>
<?php $component = $__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4; ?>
<?php unset($__componentOriginald9807c8269c89f237962bc10d8b81139ee633ff4); ?>
<?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </article>

                <div class="content-for-sidebar">
                    <?php if($blocks): ?>
                        <?php echo $__env->make('partials.blocks.init', ['blocks' => $blocks], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <?php if($paragraph || $notes): ?>
                        <div class=" mt-24 ">
                            <div class="entry-content">

                                <?php if($paragraph): ?>
                                    <h2 class="text-xl font-regular  mb-2">
                                        Understanding the Key Messages in
                                        <?php echo $bookTitle; ?>

                                        <?php echo $chapter; ?>: Insights
                                        and Explanation</h2>
                                    <p>
                                        <?php echo $paragraph; ?>

                                    </p>
                                    <?php if($notes): ?>
                                        <span class="mb-10 block"></span>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if($notes): ?>
                                    <h2 class="text-xl font-regular mb-2">Notes</h2>
                                    <p><?php echo $notes; ?></p>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <aside class="relative chapter-sidebar flex-shrink-0 pt-20 lg:pt-40 text-sm">
                <div class="sticky top-28">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <div id="table-of-contents" class="table-of-contents flex flex-col gap-4"></div>
                    <?php if (isset($component)) { $__componentOriginala90e939f52135931b0b2e055aa46418a4ecbf944 = $component; } ?>
<?php $component = App\View\Components\VerseMediaContainer::resolve(['media' => $youtubeMedia,'displaytitle' => !$verseFrom] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('verse-media-container'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\VerseMediaContainer::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala90e939f52135931b0b2e055aa46418a4ecbf944)): ?>
<?php $component = $__componentOriginala90e939f52135931b0b2e055aa46418a4ecbf944; ?>
<?php unset($__componentOriginala90e939f52135931b0b2e055aa46418a4ecbf944); ?>
<?php endif; ?>
                    
                </div>
            </aside>
        </div>
        <?php if (isset($component)) { $__componentOriginale1fc860c3d3764b75405d397dd2f76be110f4b31 = $component; } ?>
<?php $component = App\View\Components\CrossReferences::resolve(['crossReferences' => $crossReferences,'title' => $title] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cross-references'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\CrossReferences::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1fc860c3d3764b75405d397dd2f76be110f4b31)): ?>
<?php $component = $__componentOriginale1fc860c3d3764b75405d397dd2f76be110f4b31; ?>
<?php unset($__componentOriginale1fc860c3d3764b75405d397dd2f76be110f4b31); ?>
<?php endif; ?>
    <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /container/application/public/web/app/themes/devotion/resources/views/single-bible_chapter.blade.php ENDPATH**/ ?>