{{--
The Template for displaying product archives, including the main shop page which is a post type archive

This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see https://docs.woocommerce.com/document/template-structure/
@package WooCommerce/Templates
@version 3.4.0
--}}

@extends('layouts.app')

@section('content')

    <x-breadcrumb />
    <div class="container section-page">

        {{-- Header --}}
        <div class="bg-light-tone px-4 py-5 radius grid grid-cols-3 text-sm items-center mb-12">
            <div>
                <h1 class="woocommerce-products-header__title page-title text-xl ">{!! $title !!}</h1>
                <p class="text-sm text-dark-tone">{!! do_action('woocommerce_archive_description') !!}</p>
            </div>
            <div>
                {!! woocommerce_result_count() !!}
            </div>
            <div>
                {!! woocommerce_catalog_ordering() !!}
            </div>
        </div>


        @if ($query->have_posts())
            @while ($query->have_posts())
                @php($query->the_post())
                @php(wc_get_template_part('content', 'product'))
            @endwhile
        @else
            <p class="text-center">{!! __('No products were found matching your selection.', 'woocommerce') !!}</p>
        @endif
    </div>


@endsection
