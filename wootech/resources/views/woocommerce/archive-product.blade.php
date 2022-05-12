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
  <section class="breadcrumbs py-4 mb-10 lg:mb-20 text-xs font-light text-gray-300 border-b border-gray-400">
      <div class="container">
          <ul class="list-none flex">
              <li><a href="#" class="text-gray-300 hover:text-blue-100 hover:underline">Home</a></li>
              <li><span class="mx-4">/</span></li>
              <li class="text-gray-300">Shop</li>
          </ul>
      </div>
  </section><!-- /.breadcrumbs -->
  @php
    do_action('get_header', 'shop');    
  @endphp


  @if (woocommerce_product_loop())
    @php      
      woocommerce_product_loop_start();
    @endphp
    @if (wc_get_loop_prop('total'))
      <div class="container lg:pb-10 pb-5">
        <div class="product-container flex space-x-5 lg:py-10 py-5">
          @while (have_posts())
            @php
              the_post();
              do_action('woocommerce_shop_loop');
              wc_get_template_part('content', 'product');
            @endphp
          @endwhile
        </div>
      </div>
    @endif

    @php
      woocommerce_product_loop_end();
      do_action('woocommerce_after_shop_loop');
    @endphp
  @else
    @php
      do_action('woocommerce_no_products_found')
    @endphp
  @endif

  @php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection
