<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */
defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
$pro_term =  get_the_terms(get_the_id(), 'product_cat');
?>

<div <?php wc_product_class('max-w-sm bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700', $product->get_id()); ?>>
	<a href="{!! get_the_permalink() !!}">
		<img class="w-auto m-auto" src="{!! wp_get_attachment_url( $product->get_image_id() ) !!}" alt="{!! get_the_title() !!}">
	</a>
	<div class="px-6 py-4">
		<a href="{!! get_the_permalink() !!}">
			<h5 class="font-bold text-xl mb-2">{!! get_the_title() !!}</h5>
		</a>
		<div class="text-gray-700 text-base py-2 mb-4">
			{!! $product->get_short_description(); !!}
		</div>
		<div class="flex justify-between items-center">
			<span class="text-4xl font-bold text-gray-900 dark:text-white">{!! get_woocommerce_currency_symbol(get_option('woocommerce_currency')) !!}{!! $product->get_price(); !!}</span>
			<a href="@if( $product->is_type( 'variable' ) ){!!get_the_permalink()!!}@else?add-to-cart={!!get_the_id()!!}@endif" data-quantity="1" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-product_id="{{get_the_id()}}">
				<span>Add To Cart</span>
			</a>
		</div>
		@if(!empty($pro_term))
			<div class="pt-4 pb-2">
				@foreach($pro_term as $term)
					<span class="inline-block bg-gray-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{!! $term->name !!}</span>
				@endforeach
			</div>
		@endif
	</div>
</div>