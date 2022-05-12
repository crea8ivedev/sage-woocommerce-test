{{--
The Template for displaying all single products

This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see         https://docs.woocommerce.com/document/template-structure/
@package     WooCommerce\Templates
@version     1.6.4
--}}

@extends('layouts.app')

@section('content')
  @php
    do_action('get_header', 'shop');
    //  do_action('woocommerce_before_main_content');
  @endphp
  <section class="breadcrumbs py-4 mb-10 lg:mb-20 text-xs font-light text-gray-300 border-b border-gray-400">
      <div class="container">
          <ul class="list-none flex">
              <li><a href="#" class="text-gray-300 hover:text-blue-100 hover:underline">Home</a></li>
              <li><span class="mx-4">/</span></li>
              <li class="text-gray-300">{!! get_the_title() !!}</li>
          </ul>
      </div>
  </section><!-- /.breadcrumbs -->  
  <div class="container lg:pb-10 pb-5">  

    @while(have_posts())
      @php
        the_post();
        wc_get_template_part('content', 'single-product');
      @endphp
    @endwhile
  </div>

  @php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection
