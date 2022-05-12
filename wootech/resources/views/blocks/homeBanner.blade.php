{{--
  Title: Home Banner
  Description: Banner with product boxes
  Category: wootech
  Icon: cover-image
  Keywords: banner home product hero
  Mode: edit
  Align: full
  PostTypes: page
  SupportsAlign: false
  SupportsMode: true
  SupportsMultiple: true
--}}

@if(!empty(get_field('background_image')))
  <section data-{{ $block['id'] }}  class="hero relative bg-white {{ $block['classes'] }} @if(!empty(get_field('product_box_title'))) md:mb-24 lg:mb-48 @endif" id="{{ $block['id'] }}">
    <div class="absolute top-0 left-0 w-full h-[330px] md:h-full">
      <img class="absolute top-0 left-0 h-full mx-auto object-cover w-full" src="{!! get_field('background_image')['url'] !!}" width="1920" height="673" alt="{!! get_field('background_image')['title'] !!}">
      <div class="absolute top-0 left-0 right-0 h-full bg-gradient-to-r from-[rgba(0,0,0,0.35)] md:from-[rgba(0,0,0,0.65)] to-[rgba(0,0,0,0)]"></div>
    </div>
    <div class="container relative">
      <div class="md:flex md:flex-col md:h-full pt-6 md:pt-14">
        <div class="xl:w-1/2 lg:w-2/3 md:w-3/4 md:max-w-none max-w-xs my-11 md:my-8 xl:my-12 2xl:my-28">
          <h1 class="text-white text-[28px] md:text-[40px] mb-10 leading-tight md:leading-snug" data-aos="fade-up" data-aos-duration="800">
            @if(!empty(get_field('heading')))
              {!! get_field('heading') !!}
            @else
              {!! get_the_title() !!}
            @endif
          </h1>
          </div>
        @if(!empty(get_field('product_box_title')))
          <p class="text-base font-light text-white mb-8 2xl:mt-4 uppercase" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">{!! get_field('product_box_title') !!}</p>
        @endif
        @if(!empty(get_field('select_product')))
          @php $selected_products = get_field('select_product') @endphp
          <div class="grid gap-10 sm:gap-20 md:gap-8 mb-8 md:-mb-[72px] md:grid-cols-2">
            @foreach($selected_products as $selected_product)
              @php $product = wc_get_product($selected_product); @endphp
              <a href="{!! $product->get_slug(); !!}" class="group flex flex-col relative bg-white bg-opacity-95 pt-4 md:pt-0 border-r-[10px] border-blue-100 shadow-xs" data-aos="fade-up" data-aos-delay="500" data-aos-duration="500">
                <img class="absolute -top-[23%] sm:-top-1/3 md:-top-1/4 right-1/2 sm:right-1/3 translate-x-1/2 md:translate-x-0 w-48 sm:w-2/4 px-2 md:px-0 md:w-auto md:right-14 md:ml-0" src="{!! wp_get_attachment_url( $product->get_image_id() ); !!}" width="212" height="173" alt="eyeview">
                <div class="py-6 px-5 md:py-6 md:px-8 pb-2 md:mb-4">
                  <h2 class="text-[32px] mt-4 md:mt-8 mb-4 group-hover:underline">{!! $product->get_name() !!}</h2>
                  <p class="text-gray-100 font-light md:mb-4">{!! $product->get_short_description(); !!}</p>
                </div>
                <div class="bg-white mt-auto">
                  <span class="flex items-center px-5 md:px-8 py-7 text-[13px] font-bold text-blue-200 group-hover:text-blue-100">
                    <svg class="text-red-50 mr-3 transition ease-out duration-100 group-hover:translate-x-1" aria-hidden="true" focusable="false" width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.962 1.412L12.851 6.374L7.962 11.412" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                      <path d="M12.74 6.414H1" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    </svg>
                    More
                  </span>
                </div>						
              </a>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section><!-- /.hero -->
@endif