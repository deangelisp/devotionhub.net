<?php

use App\Fields\Blocks\BaseBlock;
use App\Fields\TemplatedFields\ButtonsRepeater;
use App\Fields\TemplatedFields\Content;
use App\Fields\TemplatedFields\Heading2;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Testimonials extends BaseBlock
{
    protected $name = 'testimonials';
    protected $category = 'testimonial_sections';

    public function defineFields()
    {
        $block = new FieldsBuilder($this->name, [
            'title' => 'Testimonials',
            'display' => 'block',
        ]);

        // DON'T REMOVE THIS
        $block->addText('block_category_name', [
            'default_value' => 'TestimonialSections',
            'readonly' => 1,
            'wrapper' => ['class' => 'hidden'],
        ]);

        $block
            ->addTab('content');

        (new Heading2())->build($block);
        (new Content())->build($block);
        (new ButtonsRepeater())->build($block);

        $block
            ->addTab('options');

        $block
            ->addSelect('testimonial_order', [
                'label' => 'Testimonials Order',
                'choices' => [
                    'latest_testimonial' => 'Latest Testimonials',
                    'order_testimonial' => 'Order from settings',
                    'selected_testimonial' => 'Selected Testimonials',
                    'category_testimonial' => 'Testimonials matching a category',
                    'tag_testimonial' => 'Testimonials matching a tag',
                    'random_testimonial' => 'Random Testimonials',
                ],
                'default_value' => 'latest_testimonial',
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ])
            ->addTaxonomy('category', [
                'label' => 'Category',
                'taxonomy' => 'category',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 0,
                'required' => 1,
                'return_format' => 'id',
                'multiple' => 0,
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ])
            ->conditional('testimonial_order', '==', 'category_testimonial')

            ->addTaxonomy('tag', [
                'label' => 'Tag',
                'taxonomy' => 'post_tag',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 0,
                'required' => 1,
                'return_format' => 'id',
                'multiple' => 0,
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ])
            ->conditional('testimonial_order', '==', 'tag_testimonial')

            ->addNumber('number_of_testimonials', [
                'label' => 'Number of Testimonials',
                'default_value' => 2,
                'wrapper' => [
                    'width' => '25',
                    'class' => 'field-horizontal',
                ],
            ])
            ->conditional('testimonial_order', '!=', 'selected_testimonial')

            ->addPostObject('selected_testimonials', [
                'label' => 'Selected Testimonials',
                'post_type' => ['testimonial'],
                'multiple' => 1,
                'return_format' => 'id',
                'ui' => 1,
                'ajax' => 1,
                'wrapper' => [
                    'width' => '75',
                    'class' => 'field-horizontal',
                ],
            ])
            ->conditional('testimonial_order', '==', 'selected_testimonial');

        return $block;
    }
}
